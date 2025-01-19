<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Questions;
use App\Models\UserAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAnswerFactory extends Factory
{
    protected $model = UserAnswer::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Menggunakan factory untuk User
            'question_id' => Questions::factory(), // Menggunakan factory untuk Questions
            'answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']), // Jawaban acak
            'is_correct' => $this->faker->boolean(50), // Setiap jawaban memiliki 50% kemungkinan benar
            'status_question' => $this->faker->randomElement(['pending', 'approved', 'rejected']), // Status acak
        ];
    }
}
