<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $table = 'question_options';
    protected $fillable = [
        'question_id',
        'urutan',
        'has_followup'
    ];

    public function refQuestion()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function refQuestionOptionTranslations()
    {
        return $this->hasMany(QuestionOptionTranslation::class, 'question_option_id', 'id');
    }
}
