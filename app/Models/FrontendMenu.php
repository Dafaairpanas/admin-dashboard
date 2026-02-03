<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontendMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'frontend_menus';
    protected $fillable =[
        'name',
        'url',
        'parent_id',
        'urutan',
        'is_active',
        'code'
    ];
    public function parent()
    {
        return $this->belongsTo(FrontendMenu::class, 'parent_id', 'id')->where('parent_id', 0)->with('parent');
    }
    public function manyChild()
    {
        return $this->hasMany(FrontendMenu::class, 'parent_id', 'id')->with('manyChild');
    }
    public function refFrontendTranslation()
    {
        return $this->hasMany(FrontendTranslation::class, 'frontend_menu_id', 'id');
    }
}
