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
            'nama_product' => $this->faker->word,
            'point' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->sentence,
            'kode_barang' => 'PRD-' . $this->faker->unique()->numberBetween(100, 999),
            'quantity' => $this->faker->numberBetween(1, 100),
            'quantity_out' => $this->faker->numberBetween(0, 50),
            'foto' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
        ];
    }
}
