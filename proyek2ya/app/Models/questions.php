<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\answers;

class questions extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'correct_answer'];

    // Relasi ke answers
    public function answers()
    {
        return $this->hasMany(Answers::class, 'question_id');
    }
}
