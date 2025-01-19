<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // atau gunakan Hash::make
            'points' => 0,
            'role' => 'user', // Default role
        ];
    }

    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }
}
