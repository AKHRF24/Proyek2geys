<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_registration_form()
    {
        // Akses halaman registrasi
        $response = $this->get(route('register'));

        // Pastikan halaman dapat diakses
        $response->assertStatus(200);
        $response->assertViewIs('auth.register'); // Pastikan view ini sesuai dengan implementasi Anda
    }

    /** @test */
    public function it_registers_a_new_user_and_redirects_to_their_dashboard()
    {
        // Data input untuk registrasi
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user', // Peran pengguna
        ];

        // Kirim permintaan POST ke endpoint registrasi
        $response = $this->post(route('register'), $data);

        // Pastikan pengguna diarahkan ke dashboard sesuai peran
        $response->assertRedirect('/user/page/market');

        // Pastikan data pengguna tersimpan di database
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'role' => 'user',
        ]);

        // Pastikan pengguna terautentikasi
        $this->assertAuthenticated();
    }

    /** @test */
    public function it_registers_an_admin_and_redirects_to_admin_dashboard()
    {
        // Data input untuk registrasi admin
        $data = [
            'name' => 'Admin User',
            'email' => 'adminuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin', // Peran admin
        ];

        // Kirim permintaan POST ke endpoint registrasi
        $response = $this->post(route('register'), $data);

        // Pastikan pengguna diarahkan ke dashboard admin
        $response->assertRedirect('/admin/page/market');

        // Pastikan data admin tersimpan di database
        $this->assertDatabaseHas('users', [
            'name' => 'Admin User',
            'email' => 'adminuser@example.com',
            'role' => 'admin',
        ]);

        // Pastikan admin terautentikasi
        $this->assertAuthenticated();
    }

    /** @test */
    public function it_fails_registration_with_invalid_data()
    {
        // Data registrasi tidak valid
        $data = [
            'name' => '', // Kosong
            'email' => 'invalid-email', // Email tidak valid
            'password' => 'short', // Password terlalu pendek
            'password_confirmation' => 'different', // Konfirmasi password tidak cocok
            'role' => 'invalid-role', // Role tidak valid
        ];

        // Kirim permintaan POST ke endpoint registrasi
        $response = $this->post(route('register'), $data);

        // Pastikan validasi gagal dan ada error di session
        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
            'role',
        ]);

        // Pastikan pengguna tidak terdaftar di database
        $this->assertDatabaseMissing('users', ['email' => 'invalid-email']);
    }

    /** @test */
    public function it_assigns_default_points_to_a_new_user()
    {
        // Data registrasi pengguna
        $data = [
            'name' => 'Point User',
            'email' => 'pointuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ];

        // Kirim permintaan POST ke endpoint registrasi
        $this->post(route('register'), $data);

        // Ambil pengguna dari database
        $user = User::where('email', 'pointuser@example.com')->first();

        // Pastikan pengguna memiliki default points 0
        $this->assertEquals(0, $user->points);
    }
}
