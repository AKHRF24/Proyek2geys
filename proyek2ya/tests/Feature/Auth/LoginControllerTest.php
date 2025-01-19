<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_admin_to_admin_dashboard_after_login()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/page/market');
    }

    /** @test */
    public function it_redirects_user_to_user_dashboard_after_login()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/user/page/market');
    }

    /** @test */
    public function it_logs_out_a_user_and_redirects_to_login()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    /** @test */
    public function guest_cannot_access_logout_route()
    {
        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
    }
}

