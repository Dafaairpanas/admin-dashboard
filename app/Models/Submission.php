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
        'full_name', // Mapping from nama_lengkap
        'phone_number', // Mapping from whatsapp
        'email',
        'visitor_category_id', // keeping this, but maybe not used if we use string column?
        // Added columns
        'kategori_pengunjung',
        'nama_perusahaan',
        'posisi_jabatan',
        'jenis_bisnis',
        'jenis_bisnis_lainnya',
        'kebutuhan_furniture',
        'detail_kebutuhan',
        'estimasi_budget',
        'estimasi_waktu',
        'estimasi_jumlah',
        'preferensi_brand',
        'consent',
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

    public function refSubmissionAnswers()
    {
        return $this->hasMany(SubmissionAnswer::class, 'submission_id', 'id');
    }
}
