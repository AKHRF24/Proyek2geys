<?php

namespace Database\Factories;

use App\Models\Questions;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionsFactory extends Factory
{
    protected $model = Questions::class;

    public function definition()
    {
        return [
            'question' => $this->faker->sentence,
            'option_a' => $this->faker->word,
            'option_b' => $this->faker->word,
            'option_c' => $this->faker->word,
            'option_d' => $this->faker->word,
            'correct_answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'points' => $this->faker->numberBetween(1, 10),
            'is_validated' => $this->faker->boolean,
            'user_id' => \App\Models\User::factory(), // Assuming user factory exists
        ];
    }
}
