<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\QVisitorCategory;
use App\Models\VisitorCategoryTranslation;
use App\Models\Languages;
use App\Models\Question;
use App\Models\Submission;
use App\Models\SubmissionAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\MasterVisitorCategory;
use App\Jobs\SendVerificationEmail;

class FormController extends Controller
{
    /**
     * Display the multi-step form
     */
    public function index(Request $request)
    {
        // Ambil bahasa dari berbagai sumber dengan prioritas
        $lang = $request->input('lang')
            ?? $request->cookie('selected_language')
            ?? session('selected_language')
            ?? 'en';

        $params = (object) [
            'search_value' => $request->search_value ?? null,
            'show_data' => $request->show_data ?? 15,
            'lang' => $lang,
        ];

        $visitors = QVisitorCategory::getAll($params);
        $languages = Languages::where('is_active', 1)->get();

        // Ambil semua translations untuk kategori visitor
        $master_visitor_category_translations = collect();
        foreach ($visitors['items'] as $visitor) {
            $translations = VisitorCategoryTranslation::where('visitor_category_id', $visitor['id'])->get();
            $master_visitor_category_translations = $master_visitor_category_translations->merge($translations);
        }

        // Load questions yang aktif untuk Step 2
        $questions = Question::where('is_active', true)
            ->with([
                'refTypeQuestion',
                'refQuestionTranslations',
                'refQuestionOptions.refQuestionOptionTranslations'
            ])
            ->orderBy('urutan')
            ->get();

        return view('form.index', [
            'visitors' => $visitors['items'],
            'languages' => $languages,
            'current_lang' => $lang,
            'master_visitor_category_translations' => $master_visitor_category_translations,
            'questions' => $questions,
        ]);
    }
    public function saveStep1(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'visitor_category_id' => 'required|exists:master_visitor_categories,id',
                'company_name' => 'nullable|string|max:255',
                'job_title' => 'nullable|string|max:255',
                'business_type' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            $visitorCategory = MasterVisitorCategory::find($request->visitor_category_id);
            if ($visitorCategory && $visitorCategory->has_additional_fields) {
                $b2bValidator = Validator::make($request->all(), [
                    'company_name' => 'required|string|max:255',
                    'job_title' => 'required|string|max:255',
                ]);

                if ($b2bValidator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $b2bValidator->errors()->first(),
                    ], 400);
                }
            }

            $businessType = $request->input('business_type');
            if (is_array($businessType)) {
                $lainnyaInput = $request->input('jenis_bisnis_lainnya');
                if (in_array('lainnya', $businessType) && !empty($lainnyaInput)) {
                    $key = array_search('lainnya', $businessType);
                    $businessType[$key] = $lainnyaInput;
                }
                $businessType = json_encode($businessType);
            }

            $submissionId = $request->session()->get('temp_submission_id');
            $isNewSubmission = false;

            if ($submissionId) {
                $submission = Submission::find($submissionId);
                if ($submission) {
                    $submission->update([
                        'full_name' => $request->input('full_name'),
                        'phone_number' => $request->input('phone_number'),
                        'email' => $request->input('email'),
                        'visitor_category_id' => $request->input('visitor_category_id'),
                        'company_name' => $request->input('company_name'),
                        'job_title' => $request->input('job_title'),
                        'business_type' => $businessType,
                    ]);
                }
            } else {
                $verificationToken = bin2hex(random_bytes(32));

                $submission = Submission::create([
                    'survey_id' => 1,
                    'full_name' => $request->input('full_name'),
                    'phone_number' => $request->input('phone_number'),
                    'email' => $request->input('email'),
                    'visitor_category_id' => $request->input('visitor_category_id'),
                    'company_name' => $request->input('company_name'),
                    'job_title' => $request->input('job_title'),
                    'business_type' => $businessType,
                    'verification_token' => $verificationToken,
                ]);

                $request->session()->put('temp_submission_id', $submission->id);
                $isNewSubmission = true;
            }

            if ($isNewSubmission) {
                SendVerificationEmail::dispatch($submission)->delay(now()->addSeconds(30));
            }

            return response()->json([
                'success' => true,
                'message' => 'Data step 1 berhasil disimpan.',
                'submission_id' => $submission->id,
                'verification_email_sent' => $isNewSubmission,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }

    }
    public function submit(Request $request)
    {
        DB::beginTransaction();
        try {
            // Get submission ID from session
            $submissionId = $request->session()->get('temp_submission_id');

            if (!$submissionId) {
                throw new \Exception('Data Step 1 tidak ditemukan. Silakan mulai dari awal.');
            }

            $submission = Submission::find($submissionId);

            if (!$submission) {
                throw new \Exception('Data submission tidak valid.');
            }

            // Validation for Dynamic Questions
            $activeQuestions = Question::where('is_active', true)->where('is_required', true)->get();
            foreach ($activeQuestions as $question) {
                $key = 'question_' . $question->id;
                $value = $request->input($key);

                if (empty($value)) {
                    throw new \Exception('Pertanyaan "' . ($question->refQuestionTranslations->first()->question_text ?? 'Required Question') . '" wajib diisi.');
                }
            }

            // Delete existing answers (in case user goes back and changes answers)
            $submission->submissionAnswers()->delete();

            // Save dynamic question answers
            $questionInputs = $request->all();

            foreach ($questionInputs as $key => $value) {
                if (strpos($key, 'question_') === 0 && !empty($value)) {
                    $questionId = str_replace('question_', '', $key);

                    if (!is_numeric($questionId)) {
                        continue;
                    }

                    $question = Question::find($questionId);
                    if (!$question) {
                        continue;
                    }

                    // Handle different answer types
                    if (is_array($value)) {
                        foreach ($value as $optionId) {
                            SubmissionAnswer::create([
                                'submission_id' => $submission->id,
                                'question_id' => $questionId,
                                'question_option_id' => $optionId,
                                'answer_text' => null,
                            ]);
                        }
                    } elseif (in_array($question->refTypeQuestion->code, ['radio', 'dropdown', 'checkbox_card'])) {
                        SubmissionAnswer::create([
                            'submission_id' => $submission->id,
                            'question_id' => $questionId,
                            'question_option_id' => $value,
                            'answer_text' => null,
                        ]);
                    } else {
                        SubmissionAnswer::create([
                            'submission_id' => $submission->id,
                            'question_id' => $questionId,
                            'question_option_id' => null,
                            'answer_text' => $value,
                        ]);
                    }
                }
            }

            DB::commit();

            // Clear session after successful submission
            $request->session()->forget('temp_submission_id');

            return redirect()
                ->back()
                ->with('success', 'Data berhasil dikirim! Terima kasih telah mengisi form.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function verifyEmail($token)
    {
        try {
            // Find submission by token
            $submission = Submission::where('verification_token', $token)->first();

            if (!$submission) {
                return view('form.verification-result', [
                    'success' => false,
                    'message' => 'Your link has expired.',
                    'title' => 'Verification Failed'
                ]);
            }

            // Check if already verified
            if ($submission->wa_verified_at) {
                return view('form.verification-result', [
                    'success' => true,
                    'message' => 'Your email has already been verified.',
                    'title' => 'Email Already Verified',
                    'submission' => $submission
                ]);
            }

            // Check if token expired (24 hours)
            if ($submission->verification_sent_at && $submission->verification_sent_at->addHours(24) < now()) {
                return view('form.verification-result', [
                    'success' => false,
                    'message' => 'Your link has expired. Please request a new link to administrator.',
                    'title' => 'Verification Failed'
                ]);
            }

            // Update verification status
            $submission->update([
                'wa_verified_at' => now()
            ]);

            return view('form.verification-result', [
                'success' => true,
                'message' => 'Your email has been successfully verified.',
                'title' => 'Email Verified',
                'submission' => $submission
            ]);

        } catch (\Exception $e) {
            return view('form.verification-result', [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'title' => 'Error'
            ]);
        }
    }
    // public function submit(Request $request)
    // {
    //     // dd($request->all());
    //     DB::beginTransaction();
    //     try {
    //         // Validation for Dynamic Questions
    //         $activeQuestions = Question::where('is_active', true)->where('is_required', true)->get();
    //         foreach ($activeQuestions as $question) {

    //             $key = 'question_' . $question->id;

    //             $value = $request->input($key);

    //             if (empty($value)) {
    //                 // Fail validation
    //                 throw new \Exception('Pertanyaan "' . ($question->refQuestionTranslations->first()->question_text ?? 'Required Question') . '" wajib diisi.');
    //             }
    //         }

    //         // Step 1: Save main submission data
    //         $businessType = $request->input('business_type');
    //         if (is_array($businessType)) {
    //             $lainnyaInput = $request->input('jenis_bisnis_lainnya');
    //             if (in_array('lainnya', $businessType) && !empty($lainnyaInput)) {
    //                 $key = array_search('lainnya', $businessType);
    //                 $businessType[$key] = $lainnyaInput;
    //             }
    //             $businessType = json_encode($businessType);
    //         }

    //         $submission = Submission::create([
    //             'survey_id' => 1,
    //             'full_name' => $request->input('full_name'),
    //             'phone_number' => $request->input('phone_number'),
    //             'email' => $request->input('email'),
    //             'visitor_category_id' => $request->input('visitor_category_id'),
    //             'company_name' => $request->input('company_name'),
    //             'job_title' => $request->input('job_title'),
    //             'business_type' => $businessType,
    //         ]);

    //         // Step 2: Save dynamic question answers
    //         $questionInputs = $request->all();

    //         foreach ($questionInputs as $key => $value) {
    //             if (strpos($key, 'question_') === 0 && !empty($value)) {
    //                 $questionId = str_replace('question_', '', $key);

    //                 if (!is_numeric($questionId)) {
    //                     continue;
    //                 }

    //                 $question = Question::find($questionId);
    //                 if (!$question) {
    //                     continue;
    //                 }

    //                 // Handle different answer types
    //                 if (is_array($value)) {
    //                     foreach ($value as $optionId) {
    //                         SubmissionAnswer::create([
    //                             'submission_id' => $submission->id,
    //                             'question_id' => $questionId,
    //                             'question_option_id' => $optionId,
    //                             'answer_text' => null,
    //                         ]);
    //                     }
    //                 } elseif (in_array($question->refTypeQuestion->code, ['radio', 'dropdown', 'checkbox_card'])) {
    //                     // Single option answer
    //                     SubmissionAnswer::create([
    //                         'submission_id' => $submission->id,
    //                         'question_id' => $questionId,
    //                         'question_option_id' => $value,
    //                         'answer_text' => null,
    //                     ]);
    //                 } else {
    //                     // Text/textarea/number answer
    //                     SubmissionAnswer::create([
    //                         'submission_id' => $submission->id,
    //                         'question_id' => $questionId,
    //                         'question_option_id' => null,
    //                         'answer_text' => $value,
    //                     ]);
    //                 }
    //             }
    //         }

    //         DB::commit();

    //         return redirect()
    //             ->back()
    //             ->with('success', 'Data berhasil dikirim! Terima kasih telah mengisi form.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }
}
