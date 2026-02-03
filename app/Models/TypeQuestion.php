<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeQuestion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'type_questions';
    protected $fillable = [
        'code',
        'name',
        'has_options'
    ];

    public function refQuestions()
    {
        return $this->hasMany(Question::class);
    }
}
