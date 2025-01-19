<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_an_admin_and_redirects_to_admin_page()
    {
        $response = $this->post('/register', [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',
        ]);

        $response->assertRedirect('/admin/page/market');
        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
    }

    /** @test */
    public function it_registers_a_user_and_redirects_to_user_page()
    {
        $response = $this->post('/register', [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);

        $response->assertRedirect('/user/page/market');
        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
            'role' => 'user',
        ]);
    }

    /** @test */
    public function it_validates_registration_data()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'not-matching',
            'role' => 'invalid-role',
        ]);

        $response->assertSessionHasErrors([
            'name', 'email', 'password', 'role',
        ]);
    }

    /** @test */
    public function it_defaults_points_to_zero_when_not_provided()
    {
        $response = $this->post('/register', [
            'name' => 'User With No Points',
            'email' => 'nopoints@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'nopoints@example.com',
            'points' => 0,
        ]);
    }
}
