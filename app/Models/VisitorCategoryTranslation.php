<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCategoryTranslation extends Model
{
    use HasFactory;
    protected $table = 'master_visitor_category_translations';
    protected $fillable = [
        'visitor_category_id',
        'language_code',
        'name',
    ];

    public function refVisitorCategory()
    {
        return $this->belongsTo(VisitorCategory::class, 'visitor_category_id', 'id');
    }
}
