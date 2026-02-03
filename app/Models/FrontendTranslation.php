<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontendTranslation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'frontend_translations';
    protected $fillable = [
        'frontend_menu_id',
        'language_code',
        'label',
    ];

    public function refFrontendMenu()
    {
        return $this->belongsTo(FrontendMenu::class, 'frontend_menu_id', 'id');
    }
}
