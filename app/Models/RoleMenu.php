<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    protected $table = 'role_menu';
    protected $fillable = [
        'role_id',
        'menu_id',
        'create',
        'read',
        'update',
        'delete'
    ];
    public function refRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function refMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
