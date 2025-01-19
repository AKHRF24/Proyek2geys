<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questions;

class QuestionsSeeder extends Seeder
{
    public function run()
    {
        Questions::create([
            'question' => 'What is the capital of France?',
            'correct_answer' => 'Paris',
            'points' => 10,
            'user_id' => 1, // Assuming user with ID 1 exists
        ]);

        Questions::create([
            'question' => 'What is 2 + 2?',
            'correct_answer' => '4',
            'points' => 5,
            'user_id' => 1, // Assuming user with ID 1 exists
        ]);
    }
}
