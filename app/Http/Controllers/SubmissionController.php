<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\QSubmission;
use App\Models\Submission;
use App\Models\SubmissionAnswer;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $params = (object) [
            'search_value' => $request->search_value ?? null,
            'show_data' => $request->show_data ?? 15,
        ];

        $data = QSubmission::getAllData($params);

        return view('pages.submission.index', [
            'submissions' => $data['items'],
            'attributes' => $data['attributes'],
        ]);
    }

    /**
     * Display the specified submission
     */
    public function show($id)
    {
        $submission = Submission::with([
            'refSubmissionAnswers.refQuestion.refQuestionTranslations',
            'refSubmissionAnswers.refQuestionOption.refQuestionOptionTranslations'
        ])->findOrFail($id);

        return view('pages.submission.show', [
            'submission' => $submission,
        ]);
    }

    /**
     * Remove the specified submission
     */
    public function destroy($id)
    {
        try {
            $submission = Submission::findOrFail($id);
            $submission->delete();

            return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
