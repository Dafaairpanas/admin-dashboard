<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'surveys';
    protected $fillable = [
        'is_active',
    ];

    public function refSurveysTranslations()
    {
        return $this->hasMany(SurveyTranslation::class, 'survey_id', 'id');
    }
    public function refQuestions()
    {
        return $this->hasMany(Question::class, 'survey_id', 'id');
    }
}
