<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_market_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        Product::factory()->count(5)->create();

        $response = $this->get(route('admin.page.market'));

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    /** @test */
    public function admin_can_create_a_new_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        Storage::fake('public');
        $data = [
            'nama_product' => 'Test Product',
            'point' => 100,
            'description' => 'This is a test product',
            'quantity' => 10,
            'foto' => UploadedFile::fake()->image('product.jpg'),
        ];

        $response = $this->post(route('admin.page.items.store'), $data);

        $response->assertRedirect(route('admin.page.market'));
        $this->assertDatabaseHas('products', ['nama_product' => 'Test Product']);
    }

    /** @test */
    public function admin_can_edit_a_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $product = Product::factory()->create();

        $response = $this->get(route('admin.page.items.edit', $product));

        $response->assertStatus(200);
        $response->assertViewHas('product', $product);
    }

    /** @test */
    public function admin_can_update_a_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $product = Product::factory()->create();

        $data = [
            'nama_product' => 'Updated Product',
            'point' => 200,
            'description' => 'Updated description',
            'quantity' => 20,
        ];

        $response = $this->put(route('admin.page.items.update', $product), $data);

        $response->assertRedirect(route('admin.page.market'));
        $this->assertDatabaseHas('products', ['nama_product' => 'Updated Product']);
    }

    /** @test */
    public function admin_can_delete_a_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $product = Product::factory()->create();

        $response = $this->delete(route('admin.page.items.destroy', $product));

        $response->assertRedirect(route('admin.page.market'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /** @test */
    public function user_can_view_market_page()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        Product::factory()->count(5)->create();

        $response = $this->get(route('user.page.market'));

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    /** @test */
    public function user_can_redeem_a_product()
    {
        $user = User::factory()->create(['points' => 1000]);
        $this->actingAs($user);

        $product = Product::factory()->create(['point' => 50, 'quantity' => 10, 'quantity_out' => 0]);

        $data = [
            'product_id' => $product->id,
            'kode_barang' => 'PRD-TEST-123',
            'quantity' => 2,
        ];

        $response = $this->post(route('user.page.market.redeem'), $data);

        $response->assertRedirect(route('user.page.market'));
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $this->assertEquals(8, $product->fresh()->quantity);
        $this->assertEquals(900, $user->fresh()->points);
    }

    /** @test */
    public function user_cannot_redeem_a_product_with_insufficient_points()
    {
        $user = User::factory()->create(['points' => 50]);
        $this->actingAs($user);

        $product = Product::factory()->create(['point' => 100, 'quantity' => 10]);

        $data = [
            'product_id' => $product->id,
            'kode_barang' => 'PRD-TEST-123',
            'quantity' => 1,
        ];

        $response = $this->post(route('user.page.market.redeem'), $data);

        $response->assertSessionHasErrors(['points']);
        $this->assertDatabaseMissing('transactions', ['user_id' => $user->id]);
    }

    /** @test */
    public function user_cannot_redeem_a_product_with_insufficient_quantity()
    {
        $user = User::factory()->create(['points' => 1000]);
        $this->actingAs($user);

        $product = Product::factory()->create(['point' => 50, 'quantity' => 1]);

        $data = [
            'product_id' => $product->id,
            'kode_barang' => 'PRD-TEST-123',
            'quantity' => 2,
        ];

        $response = $this->post(route('user.page.market.redeem'), $data);

        $response->assertSessionHasErrors(['quantity']);
        $this->assertDatabaseMissing('transactions', ['user_id' => $user->id]);
    }
}
