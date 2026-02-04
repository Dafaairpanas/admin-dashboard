<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionAnswer;

class SubmissionController extends Controller
{
    /**
     * Display a listing of submissions
     */
    public function index(Request $request)
    {
        $search = $request->search_value;
        $query = Submission::query()->with(['refSubmissionAnswers.refQuestion', 'refSubmissionAnswers.refQuestionOption']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $submissions = $query->orderBy('created_at', 'desc')->paginate($request->show_data ?? 15);

        return view('pages.submission.index', [
            'data' => $submissions,
            'search' => $search,
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
