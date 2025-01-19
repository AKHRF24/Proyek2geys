<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_guest_users_to_login()
    {
        $response = $this->get(route('home')); // Ganti dengan route menuju HomeController@index

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function it_shows_dashboard_for_authenticated_users()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('home')); // Ganti dengan route menuju HomeController@index

        $response->assertStatus(200);
        $response->assertViewIs('user.page.market');
    }
}
