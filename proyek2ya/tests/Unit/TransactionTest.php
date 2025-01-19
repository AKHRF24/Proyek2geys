<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function transaction_can_be_created()
    {
        // Create a user and a product
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'point' => 10,
            'quantity' => 100,
            'quantity_out' => 0,
        ]);

        // Create a transaction
        $transactionData = [
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 2,
            'total_harga' => $product->point * 2,
            'nama_user' => $user->name,
            'alamat' => '123 Street Name',
            'no_tlp' => '1234567890',
            'status_transaction' => 'Paid',
        ];

        $transaction = Transaction::create($transactionData);

        // Assert the transaction is created and the database contains it
        $this->assertDatabaseHas('transactions', [
            'code_transaksi' => $transactionData['code_transaksi'],
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 2,
            'total_harga' => $product->point * 2,
            'status_transaction' => 'Paid',
        ]);
    }

    /** @test */
    public function transaction_belongs_to_user_and_product()
    {
        // Create a user and a product
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Create a transaction
        $transaction = Transaction::create([
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 1,
            'total_harga' => $product->point,
            'nama_user' => $user->name,
            'alamat' => '123 Street Name',
            'no_tlp' => '1234567890',
            'status_transaction' => 'Paid',
        ]);

        // Check if the transaction belongs to the user
        $this->assertEquals($user->id, $transaction->user->id);

        // Check if the transaction belongs to the product
        $this->assertEquals($product->id, $transaction->product->id);
    }

    /** @test */
    public function total_points_are_deducted_from_user_when_transaction_is_created()
    {
        // Create a user with points
        $user = User::factory()->create(['points' => 50]);

        // Create a product with points
        $product = Product::factory()->create([
            'point' => 10,
            'quantity' => 100,
            'quantity_out' => 0,
        ]);

        // Create a transaction
        $transactionData = [
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 2,
            'total_harga' => $product->point * 2,
            'nama_user' => $user->name,
            'alamat' => '123 Street Name',
            'no_tlp' => '1234567890',
            'status_transaction' => 'Paid',
        ];

        $transaction = Transaction::create($transactionData);

        // Assert that the user's points have been deducted
        $user->refresh();
        $this->assertEquals(50 - ($product->point * 2), $user->points);
    }

    /** @test */
    public function transaction_updates_product_stock_on_creation()
    {
        // Create a product with a stock quantity
        $product = Product::factory()->create([
            'quantity' => 100,
            'quantity_out' => 0,
        ]);

        // Create a transaction
        $transactionData = [
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => User::factory()->create()->id,
            'product_id' => $product->id,
            'total_qty' => 3,
            'total_harga' => $product->point * 3,
            'nama_user' => 'Test User',
            'alamat' => '123 Street Name',
            'no_tlp' => '1234567890',
            'status_transaction' => 'Paid',
        ];

        $transaction = Transaction::create($transactionData);

        // Assert that the product's quantity_out has been updated
        $product->refresh();
        $this->assertEquals(3, $product->quantity_out);
    }

    /** @test */
    public function transaction_fails_if_user_has_insufficient_points()
    {
        // Create a user with insufficient points
        $user = User::factory()->create(['points' => 5]);

        // Create a product with more points required
        $product = Product::factory()->create([
            'point' => 10,
            'quantity' => 100,
            'quantity_out' => 0,
        ]);

        // Attempt to create a transaction with insufficient points
        $this->expectException(\Illuminate\Database\QueryException::class);

        Transaction::create([
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 1,
            'total_harga' => $product->point,
            'nama_user' => $user->name,
            'alamat' => '123 Street Name',
            'no_tlp' => '1234567890',
            'status_transaction' => 'Paid',
        ]);
    }

    /** @test */
    public function transaction_fails_if_product_is_out_of_stock()
    {
        // Create a user
        $user = User::factory()->create(['points' => 50]);

        // Create a product with zero stock
        $product = Product::factory()->create([
            'point' => 10,
            'quantity' => 0,
            'quantity_out' => 0,
        ]);

        // Attempt to create a transaction with out-of-stock product
        $this->expectException(\Illuminate\Database\QueryException::class);

        Transaction::create([
            'code_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 1,
            'total_harga' => $product->point,
            'nama_user' => $user->name,
            'alamat' => '123 Street Name',
            'no_tlp' => '1234567890',
            'status_transaction' => 'Paid',
        ]);
    }
}
