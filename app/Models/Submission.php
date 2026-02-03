<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'submissions';
    protected $fillable = [
        'survey_id',
        'full_name',
        'phone_number',
        'email',
        'visitor_category_id',
        'company_name',
        'job_title',
        'business_type',
        'wa_verified_at',
    ];

    public function refSurvey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function refMasterVisitorCategory()
    {
        return $this->belongsTo(MasterVisitorCategory::class, 'visitor_category_id', 'id');
    }
}
