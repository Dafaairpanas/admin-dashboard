<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyTranslation extends Model
{
    use HasFactory;
    protected $table = 'survey_translations';
    protected $fillable = [
        'survey_id',
        'language_code',
        'name',
    ];

    public function refSurvey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }
}
