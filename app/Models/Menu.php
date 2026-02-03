<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menus';
    protected  $fillable = [
        'name',
        'url',
        'icon',
        'parent_id',
        'urutan',
        'code'
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id')->where('parent_id', 0)->with('parent');
    }
    public function manyChild()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('manyChild');
    }
    public function refRoleMenu()
    {
        return $this->hasMany(RoleMenu::class, 'menu_id', 'id');
    }
}
