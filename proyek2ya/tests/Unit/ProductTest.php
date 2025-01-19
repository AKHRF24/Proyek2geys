<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'nama_product' => 'Product A',
            'point' => 1500,
            'description' => 'This is Product A.',
            'quantity' => 10,
            'quantity_out' => 0,
            'foto' => 'product_a.jpg',
            'kode_barang' => 'P001',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('products', [
            'nama_product' => 'Product A',
            'point' => 1500,
            'description' => 'This is Product A.',
            'quantity' => 10,
            'quantity_out' => 0,
            'foto' => 'product_a.jpg',
            'kode_barang' => 'P001',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_can_access_user_relationship()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $product->user);
        $this->assertEquals($user->id, $product->user->id);
    }

    /** @test */
    public function it_can_access_transaction_relationship()
    {
        $product = Product::factory()->create();
        $transactions = Transaction::factory()->count(3)->create(['product_id' => $product->id]);

        $this->assertCount(3, $product->transaction);
        $this->assertInstanceOf(Transaction::class, $product->transaction->first());
    }

    /** @test */
    public function it_formats_point_correctly()
    {
        $product = Product::factory()->create(['point' => 1500]);

        $this->assertEquals('1.500', $product->formatted_point);
    }

    /** @test */
    public function it_handles_empty_transaction_relationship()
    {
        $product = Product::factory()->create();

        $this->assertCount(0, $product->transaction);
    }

    /** @test */
    public function it_checks_quantity_and_quantity_out_values()
    {
        $product = Product::factory()->create(['quantity' => 20, 'quantity_out' => 5]);

        $this->assertEquals(20, $product->quantity);
        $this->assertEquals(5, $product->quantity_out);
    }
}
