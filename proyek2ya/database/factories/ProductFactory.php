<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'point' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence,
            'kode_barang' => $this->faker->unique()->word,
            'nama_product' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 50),
            'quantity_out' => $this->faker->numberBetween(0, 50),
            'foto' => $this->faker->imageUrl(),
            'user_id' => \App\Models\User::factory(), // Assuming user factory exists
        ];
    }
}
