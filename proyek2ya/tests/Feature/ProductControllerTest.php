<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can view market page with products and transactions.
     *
     * @return void
     */
    public function test_admin_can_view_market_page()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
        ]);

        // Create sample products and transactions
        Product::factory()->count(5)->create();
        Transaction::factory()->count(10)->create();

        // Act as admin and visit the market page
        $response = $this->actingAs($admin)->get(route('admin.page.market'));

        // Assert the response contains product and transaction data
        $response->assertStatus(200)
                 ->assertViewIs('admin.page.market')
                 ->assertSee('5') // Product count
                 ->assertSee('10'); // Transaction count
    }

    /**
     * Test admin can create a new product.
     *
     * @return void
     */
    public function test_admin_can_create_product()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
        ]);

        // Simulate a file upload
        $file = UploadedFile::fake()->image('product.jpg');

        // Act as admin and create a product
        $response = $this->actingAs($admin)->post(route('admin.page.items.store'), [
            'nama_product' => 'Test Product',
            'point' => 100,
            'description' => 'Test Description',
            'quantity' => 10,
            'foto' => $file,
        ]);

        // Assert the product was created and redirected to market page
        $response->assertRedirect(route('admin.page.market'));
        $this->assertDatabaseHas('products', [
            'nama_product' => 'Test Product',
            'point' => 100,
            'quantity' => 10,
        ]);

        // Assert the file is uploaded to the correct location
        Storage::disk('public')->assertExists('products/' . $file->hashName());
    }

    /**
     * Test admin can update a product.
     *
     * @return void
     */
    public function test_admin_can_update_product()
    {
        // Create an admin user and a product
        $admin = User::factory()->create(['role' => 'admin', 'is_admin' => true]);
        $product = Product::factory()->create();

        // Simulate a file upload for updated image
        $file = UploadedFile::fake()->image('updated_product.jpg');

        // Act as admin and update the product
        $response = $this->actingAs($admin)->put(route('admin.page.items.update', $product), [
            'nama_product' => 'Updated Product',
            'point' => 150,
            'description' => 'Updated Description',
            'quantity' => 20,
            'foto' => $file,
        ]);

        // Assert the product was updated in the database
        $response->assertRedirect(route('admin.page.market'));
        $this->assertDatabaseHas('products', [
            'nama_product' => 'Updated Product',
            'point' => 150,
            'quantity' => 20,
        ]);

        // Assert the old photo is deleted and the new file is uploaded
        Storage::disk('public')->assertExists('products/' . $file->hashName());
    }

    /**
     * Test admin can delete a product.
     *
     * @return void
     */
    public function test_admin_can_delete_product()
    {
        // Create an admin user and a product
        $admin = User::factory()->create(['role' => 'admin', 'is_admin' => true]);
        $product = Product::factory()->create();

        // Act as admin and delete the product
        $response = $this->actingAs($admin)->delete(route('admin.page.items.destroy', $product));

        // Assert the product was deleted from the database
        $response->assertRedirect(route('admin.page.market'));
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test user can view market page.
     *
     * @return void
     */
    public function test_user_can_view_market_page()
    {
        // Create a user
        $user = User::factory()->create(['role' => 'user']);

        // Create sample products and transactions
        Product::factory()->count(5)->create();
        Transaction::factory()->count(5)->create(['user_id' => $user->id]);

        // Act as user and visit the market page
        $response = $this->actingAs($user)->get(route('user.page.market'));

        // Assert the response contains products and user transactions
        $response->assertStatus(200)
                 ->assertViewIs('user.page.market')
                 ->assertSee('5') // Product count
                 ->assertSee('5'); // User transaction count
    }
}
