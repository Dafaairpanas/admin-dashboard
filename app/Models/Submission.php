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
        'kategori_pengunjung',
        'nama_perusahaan',
        'posisi_jabatan',
        'jenis_bisnis',
        'company_name',
        'job_title',
        'business_type',
        'verification_token',
        'verification_sent_at',
        'wa_verified_at',
    ];

    protected $casts = [
        'verification_sent_at' => 'datetime',
        'wa_verified_at' => 'datetime',
    ];

    public function refSurvey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function refMasterVisitorCategory()
    {
        return $this->belongsTo(MasterVisitorCategory::class, 'visitor_category_id', 'id');
    }

    public function refSubmissionAnswers()
    {
        return $this->hasMany(SubmissionAnswer::class, 'submission_id', 'id');
    }
}
