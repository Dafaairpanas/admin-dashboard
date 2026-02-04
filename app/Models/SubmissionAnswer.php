<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmissionAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'submission_answers';

    protected $fillable = [
        'submission_id',
        'question_id',
        'question_option_id',
        'answer_text',
    ];

    public function refSubmission()
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }

    public function refQuestion()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function refQuestionOption()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id', 'id');
    }
}
