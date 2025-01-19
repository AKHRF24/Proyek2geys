<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can view their profile.
     *
     * @return void
     */
    public function test_user_can_view_profile()
    {
        // Create a user and authenticate
        $user = User::factory()->create();

        // Act as the authenticated user and visit the profile page
        $response = $this->actingAs($user)->get(route('user.page.profile.show'));

        // Assert the response is successful and shows the profile page
        $response->assertStatus(200)
                 ->assertViewIs('user.page.profile.show')
                 ->assertSee($user->name);
    }

    /**
     * Test user can view the edit profile page.
     *
     * @return void
     */
    public function test_user_can_view_edit_profile_page()
    {
        // Create a user and authenticate
        $user = User::factory()->create();

        // Act as the authenticated user and visit the edit profile page
        $response = $this->actingAs($user)->get(route('user.page.profile.edit'));

        // Assert the response is successful and shows the edit profile page
        $response->assertStatus(200)
                 ->assertViewIs('user.page.profile.edit')
                 ->assertSee($user->name);
    }

    /**
     * Test user can update their profile with valid data.
     *
     * @return void
     */
    public function test_user_can_update_profile()
    {
        // Create a user and authenticate
        $user = User::factory()->create();

        // Act as the authenticated user and update their profile
        $response = $this->actingAs($user)->put(route('user.page.profile.update'), [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        // Assert the user data was updated in the database
        $response->assertRedirect(route('user.page.profile.show'));
        $this->assertDatabaseHas('users', [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ]);
    }

    /**
     * Test user cannot update profile without being logged in.
     *
     * @return void
     */
    public function test_user_cannot_update_profile_if_not_logged_in()
    {
        // Try to update profile without being authenticated
        $response = $this->put(route('user.page.profile.update'), [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
        ]);

        // Assert the user is redirected to login
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'You must be logged in to update your profile.');
    }

    /**
     * Test user cannot update profile with invalid data.
     *
     * @return void
     */
    public function test_user_cannot_update_profile_with_invalid_data()
    {
        // Create a user and authenticate
        $user = User::factory()->create();

        // Act as the authenticated user and try to update with invalid data
        $response = $this->actingAs($user)->put(route('user.page.profile.update'), [
            'name' => '',
            'email' => 'invalidemail',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        // Assert the validation errors are returned
        $response->assertStatus(422);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
