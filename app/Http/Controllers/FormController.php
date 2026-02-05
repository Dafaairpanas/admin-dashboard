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
    /**
     * Handle form submission
     */
    public function submit(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            // Validation for Dynamic Questions
            $activeQuestions = Question::where('is_active', true)->where('is_required', true)->get();
            foreach ($activeQuestions as $question) {
                // Check if question exists in request
                // For checkboxes, it might be an array or individual keys if not grouped properly, 
                // but our JS consolidates them into hidden inputs. 
                // Text/Radio/Select usually 'question_{id}'.
                // Checkbox group 'question_{id}' (array).

                $key = 'question_' . $question->id;

                // If it's a file input (future proofing), check hasFile. 
                // For now, assume text/choice.

                $value = $request->input($key);

                if (empty($value)) {
                    // Fail validation
                    throw new \Exception('Pertanyaan "' . ($question->refQuestionTranslations->first()->question_text ?? 'Required Question') . '" wajib diisi.');
                }
            }

            // Step 1: Save main submission data
            // Handle business_type with 'lainnya' replacement
            $businessType = $request->input('business_type');
            if (is_array($businessType)) {
                // If user selected 'lainnya', replace it with the actual input
                $lainnyaInput = $request->input('jenis_bisnis_lainnya');
                if (in_array('lainnya', $businessType) && !empty($lainnyaInput)) {
                    $key = array_search('lainnya', $businessType);
                    $businessType[$key] = $lainnyaInput;
                }
                $businessType = json_encode($businessType);
            }

            $submission = Submission::create([
                'survey_id' => 1,
                'full_name' => $request->input('full_name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'visitor_category_id' => $request->input('visitor_category_id'),
                'company_name' => $request->input('company_name'),
                'job_title' => $request->input('job_title'),
                'business_type' => $businessType,
                // 'business_type' => $request->input('jenis_bisnis_lainnya'),
                // 'consent' => $request->input('consent', 0),
            ]);

            // Step 2: Save dynamic question answers
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
                        // Multiple answers (checkbox)
                        foreach ($value as $optionId) {
                            SubmissionAnswer::create([
                                'submission_id' => $submission->id,
                                'question_id' => $questionId,
                                'question_option_id' => $optionId,
                                'answer_text' => null,
                            ]);
                        }
                    } elseif (in_array($question->refTypeQuestion->code, ['radio', 'dropdown', 'checkbox_card'])) {
                        // Single option answer
                        SubmissionAnswer::create([
                            'submission_id' => $submission->id,
                            'question_id' => $questionId,
                            'question_option_id' => $value,
                            'answer_text' => null,
                        ]);
                    } else {
                        // Text/textarea/number answer
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
}
