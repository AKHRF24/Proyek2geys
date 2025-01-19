<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the home page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function testHomeRedirectsToLoginWhenNotAuthenticated()
    {
        // Act: Attempt to access the home page without authentication
        $response = $this->get('/');

        // Assert: Check redirection to the login page
        $response->assertRedirect('/login');
    }

    /**
     * Test that the home page is accessible for authenticated users.
     *
     * @return void
     */
    public function testHomeIsAccessibleForAuthenticatedUsers()
    {
        // Arrange: Create an authenticated user
        $user = User::factory()->create();

        // Act: Simulate login and access the home page
        $this->actingAs($user);
        $response = $this->get('/');

        // Assert: Check if the home page loads successfully
        $response->assertStatus(200);
        $response->assertViewIs('user.page.market');
    }

    /**
     * Test middleware ensures authentication is required.
     *
     * @return void
     */
    public function testMiddlewareEnsuresAuthentication()
    {
        // Arrange: Simulate an instance of the HomeController
        $controller = new \App\Http\Controllers\HomeController();

        // Assert: Check if the 'auth' middleware is applied
        $this->assertTrue(
            collect($controller->getMiddleware())->contains(function ($middleware) {
                return $middleware['middleware'] === 'auth';
            })
        );
    }
}
