<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test displaying all transactions for the user
    public function test_user_can_view_own_transactions()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $transactions = Transaction::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('user.page.transaction.index'));
        $response->assertStatus(200);
        $response->assertViewHas('transactions');
    }

    // Test displaying the transaction form
    public function test_user_can_view_transaction_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->get(route('user.page.transaction.redeem', ['product_id' => $product->id, 'quantity' => 1]));
        $response->assertStatus(200);
        $response->assertViewHas('product');
    }

    // Test creating a transaction successfully
    public function test_user_can_create_transaction()
    {
        $user = User::factory()->create(['points' => 100]);
        $this->actingAs($user);

        $product = Product::factory()->create(['point' => 20, 'quantity' => 100, 'quantity_out' => 0]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 3,
            'alamat' => 'Test Address',
            'no_tlp' => '1234567890',
            'ekspedisi' => 'Test Expedisi'
        ];

        $response = $this->post(route('transaction.create'), $data);
        $response->assertRedirect(route('user.page.transaction.index'));
        $response->assertSessionHas('success', 'Transaction created successfully!');

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_qty' => 3,
            'total_harga' => 60,
            'status_transaction' => 'Paid'
        ]);

        $user->refresh();
        $this->assertEquals(40, $user->points); // Points should decrease
    }

    // Test insufficient points when creating a transaction
    public function test_user_cannot_create_transaction_due_to_insufficient_points()
    {
        $user = User::factory()->create(['points' => 10]);
        $this->actingAs($user);

        $product = Product::factory()->create(['point' => 20, 'quantity' => 100, 'quantity_out' => 0]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 1,
            'alamat' => 'Test Address',
            'no_tlp' => '1234567890',
            'ekspedisi' => 'Test Expedisi'
        ];

        $response = $this->post(route('transaction.create'), $data);
        $response->assertStatus(400);
        $response->assertSee('Insufficient points for this transaction.');
    }

    // Test insufficient product stock when creating a transaction
    public function test_user_cannot_create_transaction_due_to_insufficient_stock()
    {
        $user = User::factory()->create(['points' => 100]);
        $this->actingAs($user);

        $product = Product::factory()->create(['point' => 20, 'quantity' => 2, 'quantity_out' => 1]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 2,
            'alamat' => 'Test Address',
            'no_tlp' => '1234567890',
            'ekspedisi' => 'Test Expedisi'
        ];

        $response = $this->post(route('transaction.create'), $data);
        $response->assertStatus(400);
        $response->assertSee('The requested quantity is not available.');
    }

    // Test admin viewing all transactions
    public function test_admin_can_view_all_transactions()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $transactions = Transaction::factory()->create();

        $response = $this->get(route('admin.page.transactions'));
        $response->assertStatus(200);
        $response->assertViewHas('transactions');
    }

    // Test updating transaction status by admin
    public function test_admin_can_update_transaction_status()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $transaction = Transaction::factory()->create(['status_transaction' => 'Unpaid']);

        $data = [
            'status_transaction' => 'Paid',
        ];

        $response = $this->post(route('admin.transaction.update', $transaction->id), $data);
        $response->assertRedirect(route('admin.page.transactions'));
        $response->assertSessionHas('success', 'Transaction status updated successfully.');

        $transaction->refresh();
        $this->assertEquals('Paid', $transaction->status_transaction);
    }

    // Test invalid transaction status update by admin
    public function test_admin_cannot_update_transaction_status_to_invalid_value()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $transaction = Transaction::factory()->create();

        $data = [
            'status_transaction' => 'InvalidStatus',
        ];

        $response = $this->post(route('admin.transaction.update', $transaction->id), $data);
        $response->assertSessionHasErrors(['status_transaction']);
    }
}
