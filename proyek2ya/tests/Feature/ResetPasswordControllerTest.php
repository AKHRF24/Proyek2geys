<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_password_reset_form()
    {
        // Kirim permintaan ke halaman form reset password
        $response = $this->get(route('password.reset', ['token' => 'dummy-token']));

        // Pastikan halaman dapat diakses
        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.reset'); // Pastikan view sesuai implementasi Anda
    }

    /** @test */
    public function it_resets_password_and_redirects_based_on_role()
    {
        // Buat pengguna dengan role 'user'
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => bcrypt('oldpassword'),
        ]);

        // Simulasi token reset password
        $token = Password::createToken($user);

        // Data untuk reset password
        $data = [
            'email' => 'user@example.com',
            'token' => $token,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        // Kirim permintaan POST untuk reset password
        $response = $this->post(route('password.update'), $data);

        // Pastikan pengguna diarahkan ke halaman dashboard user
        $response->assertRedirect('/user/page/market');

        // Pastikan password diperbarui
        $this->assertTrue(auth()->attempt(['email' => 'user@example.com', 'password' => 'newpassword']));
    }

    /** @test */
    public function it_redirects_admin_to_admin_dashboard_after_reset_password()
    {
        // Buat pengguna dengan role 'admin'
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('oldpassword'),
        ]);

        // Simulasi token reset password
        $token = Password::createToken($admin);

        // Data untuk reset password
        $data = [
            'email' => 'admin@example.com',
            'token' => $token,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        // Kirim permintaan POST untuk reset password
        $response = $this->post(route('password.update'), $data);

        // Pastikan admin diarahkan ke dashboard admin
        $response->assertRedirect('/admin/page/market');

        // Pastikan password diperbarui
        $this->assertTrue(auth()->attempt(['email' => 'admin@example.com', 'password' => 'newpassword']));
    }

    /** @test */
    public function it_fails_reset_with_invalid_token()
    {
        // Buat pengguna
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('oldpassword'),
        ]);

        // Data untuk reset password dengan token tidak valid
        $data = [
            'email' => 'user@example.com',
            'token' => 'invalid-token',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        // Kirim permintaan POST untuk reset password
        $response = $this->post(route('password.update'), $data);

        // Pastikan reset gagal dan kembali ke halaman form reset
        $response->assertSessionHasErrors(['email']);
        $this->assertFalse(auth()->attempt(['email' => 'user@example.com', 'password' => 'newpassword']));
    }

    /** @test */
    public function it_fails_reset_with_mismatched_password_confirmation()
    {
        // Buat pengguna
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('oldpassword'),
        ]);

        // Simulasi token reset password
        $token = Password::createToken($user);

        // Data untuk reset password dengan konfirmasi tidak cocok
        $data = [
            'email' => 'user@example.com',
            'token' => $token,
            'password' => 'newpassword',
            'password_confirmation' => 'wrongconfirmation',
        ];

        // Kirim permintaan POST untuk reset password
        $response = $this->post(route('password.update'), $data);

        // Pastikan reset gagal dan kembali ke halaman form reset
        $response->assertSessionHasErrors(['password']);
        $this->assertFalse(auth()->attempt(['email' => 'user@example.com', 'password' => 'newpassword']));
    }
}
