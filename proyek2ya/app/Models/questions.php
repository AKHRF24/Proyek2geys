<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'points',
        'is_validated',
        'user_id',
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke jawaban pengguna
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'question_id');
    }
}


