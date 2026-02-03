<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'questions';
    protected $fillable = [
        'survey_id',
        'type_question_id',
        'key',
        'urutan',
        'is_required',
        'is_active',

        'parent_option_id',
    ];

    public function refTypeQuestion()
    {
        return $this->belongsTo(TypeQuestion::class, 'type_question_id', 'id');
    }

    public function refParentOption()
    {
        return $this->belongsTo(QuestionOption::class, 'parent_option_id', 'id');
    }

    public function refQuestionTranslations()
    {
        return $this->hasMany(QuestionTranslation::class, 'question_id', 'id');
    }

    public function refQuestionOptions()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id')->orderBy('urutan');
    }
}
