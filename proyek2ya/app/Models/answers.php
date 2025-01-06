<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\questions;

class answers extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'answer', 'is_correct'];

    // Relasi ke questions
    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }
}
