<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    use HasFactory;
    protected $table = 'question_translations';
    protected $fillable = [
        'question_id',
        'language_code',
        'question_text',
    ];

    public function refQuestion()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
