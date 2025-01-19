<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Tests\TestCase;

class VerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_verification_routes()
    {
        $response = $this->get(route('verification.notice'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_see_verification_notice()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $this->actingAs($user);

        $response = $this->get(route('verification.notice'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.verify');
    }

    /** @test */
    public function email_can_be_verified()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $this->actingAs($user);

        $this->assertFalse($user->hasVerifiedEmail());

        $verificationUrl = $this->getVerificationUrl($user);

        $response = $this->get($verificationUrl);

        $response->assertRedirect($user->role === 'admin' ? '/admin/page/market' : '/user/page/market');
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    /** @test */
    public function resend_verification_email_works()
    {
        Notification::fake();

        $user = User::factory()->create(['email_verified_at' => null]);
        $this->actingAs($user);

        $this->post(route('verification.resend'));

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /**
     * Generate a signed verification URL for the user.
     *
     * @param User $user
     * @return string
     */
    private function getVerificationUrl(User $user)
    {
        return URL::signedRoute('verification.verify', [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]);
    }
}
