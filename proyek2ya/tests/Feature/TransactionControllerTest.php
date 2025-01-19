<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_all_transactions_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Transaction::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('transactions.index'));

        $response->assertStatus(200);
        $response->assertViewHas('transactions');
    }

    /** @test */
    public function it_creates_a_new_transaction_successfully()
    {
        $user = User::factory()->create(['points' => 1000]);
        $this->actingAs($user);

        $product = Product::factory()->create(['quantity' => 10, 'point' => 50]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 2,
        ];

        $response = $this->post(route('transactions.store'), $data);

        $response->assertRedirect(route('transactions.index'));
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'total_point' => 100,
        ]);
        $this->assertEquals(8, $product->fresh()->quantity);
        $this->assertEquals(900, $user->fresh()->points);
    }

    /** @test */
    public function it_displays_error_if_product_quantity_is_insufficient()
    {
        $user = User::factory()->create(['points' => 1000]);
        $this->actingAs($user);

        $product = Product::factory()->create(['quantity' => 1, 'point' => 50]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 2,
        ];

        $response = $this->post(route('transactions.store'), $data);

        $response->assertSessionHasErrors(['quantity']);
        $this->assertEquals(1, $product->fresh()->quantity); // Quantity remains unchanged
    }

    /** @test */
    public function it_displays_error_if_user_points_are_insufficient()
    {
        $user = User::factory()->create(['points' => 50]);
        $this->actingAs($user);

        $product = Product::factory()->create(['quantity' => 10, 'point' => 100]);

        $data = [
            'product_id' => $product->id,
            'quantity' => 1,
        ];

        $response = $this->post(route('transactions.store'), $data);

        $response->assertSessionHasErrors(['points']);
        $this->assertEquals(10, $product->fresh()->quantity); // Quantity remains unchanged
    }

    /** @test */
    public function it_displays_transaction_details()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $transaction = Transaction::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('transactions.show', $transaction));

        $response->assertStatus(200);
        $response->assertViewHas('transaction', $transaction);
    }

    /** @test */
    public function it_updates_transaction_status()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $transaction = Transaction::factory()->create(['status' => 'pending']);

        $data = [
            'status' => 'completed',
        ];

        $response = $this->put(route('transactions.updateStatus', $transaction), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => 'completed',
        ]);
    }

    /** @test */
    public function it_displays_error_for_invalid_status_update()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $transaction = Transaction::factory()->create(['status' => 'pending']);

        $data = [
            'status' => 'invalid-status',
        ];

        $response = $this->put(route('transactions.updateStatus', $transaction), $data);

        $response->assertSessionHasErrors(['status']);
        $this->assertEquals('pending', $transaction->fresh()->status); // Status remains unchanged
    }
}
