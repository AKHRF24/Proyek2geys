<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin dashboard.
     *
     * @return void
     */
    public function test_admin_dashboard()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
        ]);

        // Create sample products and questions
        Product::factory()->count(5)->create();
        Questions::factory()->count(5)->create();

        // Act as admin and access the admin dashboard
        $response = $this->actingAs($admin)->get(route('admin.page.dashboard'));

        // Assert the response contains the product, question, and transaction counts
        $response->assertStatus(200)
                 ->assertViewIs('admin.page.dashboard')
                 ->assertSee('5') // productCount
                 ->assertSee('5') // questionCount
                 ->assertSee('0'); // transactionCount
    }

    /**
     * Test user dashboard.
     *
     * @return void
     */
    public function test_user_dashboard()
    {
        // Create a normal user
        $user = User::factory()->create([
            'role' => 'user',
            'is_admin' => false,
            'points' => 100,
        ]);

        // Create sample products and questions
        Product::factory()->count(5)->create();
        Questions::factory()->count(5)->create();

        // Act as user and access the user dashboard
        $response = $this->actingAs($user)->get(route('user.page.dashboard'));
 
        // Assert the response contains the user's available points and the latest products/questions
        $response->assertStatus(200)
                 ->assertViewIs('user.page.dashboard')
                 ->assertSee('100') // availablePoints
                 ->assertSee('product') // Showcase of products
                 ->assertSee('question'); // Latest questions
    }

    /**
     * Test redirect based on user role.
     *
     * @return void
     */
    public function test_role_based_redirect()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
        ]);

        // Create a normal user
        $user = User::factory()->create([
            'role' => 'user',
            'is_admin' => false,
        ]);

        // Act as admin and test redirection
        $response = $this->actingAs($admin)->get(route('home'));
        $response->assertRedirect(route('admin.page.dashboard'));

        // Act as user and test redirection
        $response = $this->actingAs($user)->get(route('home'));
        $response->assertRedirect(route('user.page.dashboard'));
    }
}
