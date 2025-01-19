<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder menggunakan factory
        Questions::create([
            'question' => 'What is the capital of France?',
            'option_a' => 'Paris',
            'option_b' => 'London',
            'option_c' => 'Berlin',
            'option_d' => 'Madrid',
            'correct_answer' => 'A',
            'points' => 10,
            'user_id' => 1, // Pastikan user dengan ID 1 ada di tabel users
            'is_validated' => true,
        ]);

        Questions::create([
            'question' => 'Which planet is known as the Red Planet?',
            'option_a' => 'Earth',
            'option_b' => 'Mars',
            'option_c' => 'Venus',
            'option_d' => 'Jupiter',
            'correct_answer' => 'B',
            'points' => 15,
            'user_id' => 1, // Pastikan user dengan ID 1 ada di tabel users
            'is_validated' => true,
        ]);

        // Tambahkan lebih banyak data contoh sesuai kebutuhan
    }
}
