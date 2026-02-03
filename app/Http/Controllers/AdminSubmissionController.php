<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class AdminSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search_value;
        $query = Submission::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $submissions = $query->orderBy('created_at', 'desc')->paginate($request->show_data ?? 15);

        $questions = \App\Models\Question::with([
            'refQuestionTranslations',
            'refTypeQuestion',
            'refQuestionOptions' => function ($q) {
                $q->orderBy('urutan');
            },
            'refQuestionOptions.refQuestionOptionTranslations'
        ])
            ->where('is_active', 1)
            ->orderBy('urutan')
            ->get();

        return view('pages.submission.index', [
            'data' => $submissions,
            'search' => $search,
            'questions' => $questions
        ]);
    }

    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();
        return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully');
    }
}
