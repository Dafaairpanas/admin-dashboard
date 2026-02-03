<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOptionTranslation extends Model
{
    use HasFactory;
    protected $table = 'question_option_translations';
    protected $fillable = [
        'question_option_id',
        'language_code',
        'option_text',
    ];

    public function refQuestionOption()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id', 'id');
    }
}
