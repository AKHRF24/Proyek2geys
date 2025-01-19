<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test that the application returns a successful response for the home page.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /**
     * Test that a non-existent route returns a 404 response.
     *
     * @return void
     */
    public function test_non_existent_route_returns_404()
    {
        $response = $this->get('/non-existent-route');

        $response->assertStatus(404);
    }

    /**
     * Test that the login page returns a successful response.
     *
     * @return void
     */
    public function test_login_page_returns_successful_response()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test that the register page returns a successful response.
     *
     * @return void
     */
    public function test_register_page_returns_successful_response()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Test that the admin dashboard page redirects to login when not authenticated.
     *
     * @return void
     */
    public function test_admin_dashboard_page_redirects_to_login_when_not_authenticated()
    {
        $response = $this->get('/admin/page/dashboard');

        $response->assertRedirect('/login');
    }
}
