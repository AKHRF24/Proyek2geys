<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'product_id' => \App\Models\Product::factory(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
