<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Models\QuestionOption;
use App\Models\QuestionOptionTranslation;
use App\Models\TypeQuestion;
use App\Models\Languages;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search_value;
        $query = Question::query()->with(['refParentOption', 'refQuestionTranslations']);
        $questions = $query->orderBy('urutan')->paginate($request->show_data ?? 15);

        // Helper to get text for default language (or fallback)
        $defaultLang = Languages::where('is_default', 1)->first()->code ?? 'en';

        return view('pages.question.index', [
            'data' => $questions,
            'search' => $search,
            'defaultLang' => $defaultLang
        ]);
    }

    public function create()
    {
        $types = TypeQuestion::all();
        $languages = Languages::where('is_active', 1)->get();
        $surveyId = Survey::where('is_active', 1)->first()->id ?? 1;

        return view('pages.question.edit', [
            'question' => null,
            'types' => $types,
            'languages' => $languages,
            'surveyId' => $surveyId
        ]);
    }

    public function store(Request $request)
    {
        // Validation (Basic)
        $validator = Validator::make($request->all(), [
            'type_question_id' => 'required|exists:type_questions,id',
            'urutan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $question = Question::create([
                'survey_id' => $request->survey_id,
                'type_question_id' => $request->type_question_id,
                'urutan' => $request->urutan,
                'key' => $request->key,
                'is_required' => $request->has('is_required') ? 1 : 0,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'max_selections' => $request->max_selections,
                'grid_columns' => $request->grid_columns ?? 1,
            ]);

            if ($request->has('translations')) {
                foreach ($request->translations as $code => $trans) {
                    if (!empty($trans['question_text'])) {
                        QuestionTranslation::create([
                            'question_id' => $question->id,
                            'language_code' => $code,
                            'question_text' => $trans['question_text']
                        ]);
                    }
                }
            }

            // Save Options
            if ($request->has('options')) {
                foreach ($request->options as $optData) {
                    $option = QuestionOption::create([
                        'question_id' => $question->id,
                        'urutan' => $optData['urutan'] ?? 0,
                        'has_followup' => 0
                    ]);

                    if (isset($optData['translations'])) {
                        foreach ($optData['translations'] as $code => $trans) {
                            if (!empty($trans['option_text'])) {
                                QuestionOptionTranslation::create([
                                    'question_option_id' => $option->id,
                                    'language_code' => $code,
                                    'option_text' => $trans['option_text'],
                                    'description' => $trans['description'] ?? null
                                ]);
                            }
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('QUESTIONS.read')->with('success', 'Question created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $question = Question::with(['refQuestionTranslations', 'refQuestionOptions.refQuestionOptionTranslations'])->findOrFail($id);
        $types = TypeQuestion::all();
        $languages = Languages::where('is_active', 1)->get();

        return view('pages.question.edit', [
            'question' => $question,
            'types' => $types,
            'languages' => $languages,
            'surveyId' => $question->survey_id
        ]);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        DB::beginTransaction();
        try {
            $question->update([
                'type_question_id' => $request->type_question_id,
                'urutan' => $request->urutan,
                'key' => $request->key,
                'is_required' => $request->has('is_required') ? 1 : 0,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'max_selections' => $request->max_selections,
                'grid_columns' => $request->grid_columns ?? 1,
            ]);

            // Update/Create Translations
            if ($request->has('translations')) {
                foreach ($request->translations as $code => $trans) {
                    QuestionTranslation::updateOrCreate(
                        ['question_id' => $question->id, 'language_code' => $code],
                        ['question_text' => $trans['question_text']]
                    );
                }
            }

            // Update Options
            // Logic: Get existing option IDs. Matches from request (if has ID).
            // Delete missing? Or just update/create.
            // For MVP, simplifying:
            // If option has 'id', update. Else create.
            // If options are missing from request but exist in DB? -> Delete them. (Be careful).

            if ($request->has('options')) {
                $submittedIds = [];
                foreach ($request->options as $optData) {
                    if (isset($optData['id'])) {
                        $submittedIds[] = $optData['id'];
                        $option = QuestionOption::find($optData['id']);
                        if ($option) {
                            $option->update(['urutan' => $optData['urutan'] ?? $option->urutan]);
                        }
                    } else {
                        // Create
                        $option = QuestionOption::create([
                            'question_id' => $question->id,
                            'urutan' => $optData['urutan'] ?? 0,
                        ]);
                        $submittedIds[] = $option->id;
                    }

                    if (isset($optData['translations']) && isset($option)) {
                        foreach ($optData['translations'] as $code => $trans) {
                            QuestionOptionTranslation::updateOrCreate(
                                ['question_option_id' => $option->id, 'language_code' => $code],
                                [
                                    'option_text' => $trans['option_text'],
                                    'description' => $trans['description'] ?? null
                                ]
                            );
                        }
                    }
                }

                // Delete removed options
                QuestionOption::where('question_id', $question->id)->whereNotIn('id', $submittedIds)->delete();
            } else {
                // Loop if we want to delete all options if none sent?
                // If type has options, maybe.
            }

            DB::commit();
            return redirect()->route('QUESTIONS.read')->with('success', 'Question updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete(); // Soft delete
        return redirect()->route('QUESTIONS.read')->with('success', 'Question deleted successfully');
    }
}
