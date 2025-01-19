<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfirmPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_admin_user_to_admin_page()
    {
        // Buat user dengan role admin
        $admin = User::factory()->create(['role' => 'admin']);

        // Login sebagai admin
        $this->actingAs($admin);

        // Panggil route yang menggunakan ConfirmPasswordController
        $response = $this->post('/password/confirm', [
            'password' => 'password',
        ]);

        // Pastikan redirect ke halaman admin
        $response->assertRedirect('/admin/page/market');
    }

    /** @test */
    public function it_redirects_user_to_user_page()
    {
        // Buat user biasa
        $user = User::factory()->create(['role' => 'user']);

        // Login sebagai user
        $this->actingAs($user);

        // Panggil route yang menggunakan ConfirmPasswordController
        $response = $this->post('/password/confirm', [
            'password' => 'password',
        ]);

        // Pastikan redirect ke halaman user
        $response->assertRedirect('/user/page/market');
    }

    /** @test */
    public function it_requires_authentication_to_access_confirm_password()
    {
        // Panggil route tanpa login
        $response = $this->post('/password/confirm', [
            'password' => 'password',
        ]);

        // Pastikan redirect ke halaman login
        $response->assertRedirect('/login');
    }
}
