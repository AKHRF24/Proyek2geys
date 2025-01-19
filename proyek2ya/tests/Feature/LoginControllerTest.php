<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_login_page()
    {
        // Akses halaman login
        $response = $this->get(route('login'));

        // Memastikan halaman dapat diakses
        $response->assertStatus(200);
        $response->assertViewIs('auth.login'); // Pastikan sesuai dengan view login Anda
    }

    /** @test */
    public function it_allows_user_to_login_and_redirects_based_on_role()
    {
        // Membuat pengguna dengan peran 'admin'
        $admin = User::factory()->create(['role' => 'admin', 'password' => bcrypt('password')]);

        // Login dengan kredensial yang benar
        $response = $this->post(route('login'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        // Memastikan pengalihan ke halaman admin
        $response->assertRedirect('/admin/page/market');
        $this->assertAuthenticatedAs($admin);

        // Logout
        $this->post(route('logout'));
        $this->assertGuest();
    }

    /** @test */
    public function it_redirects_dosen_role_to_correct_page_after_login()
    {
        // Membuat pengguna dengan peran 'dosen'
        $dosen = User::factory()->create(['role' => 'dosen', 'password' => bcrypt('password')]);

        // Login dengan kredensial yang benar
        $response = $this->post(route('login'), [
            'email' => $dosen->email,
            'password' => 'password',
        ]);

        // Memastikan pengalihan ke halaman dosen
        $response->assertRedirect('/dosen/page/market');
        $this->assertAuthenticatedAs($dosen);
    }

    /** @test */
    public function it_redirects_user_role_to_correct_page_after_login()
    {
        // Membuat pengguna dengan peran 'user'
        $user = User::factory()->create(['role' => 'user', 'password' => bcrypt('password')]);

        // Login dengan kredensial yang benar
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Memastikan pengalihan ke halaman user
        $response->assertRedirect('/user/page/market');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_prevents_login_with_invalid_credentials()
    {
        // Membuat pengguna dengan email dan password
        User::factory()->create(['email' => 'valid@example.com', 'password' => bcrypt('password')]);

        // Mencoba login dengan kredensial yang salah
        $response = $this->post(route('login'), [
            'email' => 'valid@example.com',
            'password' => 'wrong-password',
        ]);

        // Memastikan login gagal
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /** @test */
    public function it_logs_out_the_user()
    {
        // Membuat pengguna
        $user = User::factory()->create();

        // Login pengguna
        $this->actingAs($user);

        // Logout
        $response = $this->post(route('logout'));

        // Memastikan pengalihan ke halaman login
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status', 'You have been logged out.');
        $this->assertGuest();
    }
}
