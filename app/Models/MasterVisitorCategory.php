<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterVisitorCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'master_visitor_categories';
    protected $fillable = [
        'name',
        'has_additional_fields',
    ];

    public function refVisitorCategoryTranslations()
    {
        return $this->hasMany(VisitorCategoryTranslation::class, 'visitor_category_id', 'id');
    }

    public function refVisitorCategoryTranslation($lang)
    {
        return $this->hasOne(VisitorCategoryTranslation::class, 'visitor_category_id', 'id')->where('language_code', $lang);
    }
}
