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
            'code_transaksi' => $this->faker->unique()->word,
            'user_id' => \App\Models\User::factory(), // Assuming user factory exists
            'product_id' => \App\Models\Product::factory(), // Assuming product factory exists
            'total_qty' => $this->faker->numberBetween(1, 10),
            'total_harga' => $this->faker->numberBetween(1000, 10000),
            'nama_user' => $this->faker->name,
            'alamat' => $this->faker->address,
            'no_tlp' => $this->faker->phoneNumber,
            'status_transaction' => $this->faker->randomElement(['Unpaid', 'Paid']),
            'ekspedisi' => $this->faker->word,
            'bayar' => $this->faker->word,
        ];
    }
}
