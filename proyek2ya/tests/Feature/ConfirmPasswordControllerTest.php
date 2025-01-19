<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\ConfirmPasswordController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ConfirmPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test redirection for admin user.
     *
     * @return void
     */
    public function testRedirectForAdmin()
    {
        $adminUser = User::factory()->create(['role' => 'admin']);
        $this->actingAs($adminUser);

        $controller = new ConfirmPasswordController();
        $redirectUrl = $controller->redirectTo();

        $this->assertEquals('/admin/page/market', $redirectUrl);
    }

    /**
     * Test redirection for regular user.
     *
     * @return void
     */
    public function testRedirectForRegularUser()
    {
        $regularUser = User::factory()->create(['role' => 'user']);
        $this->actingAs($regularUser);

        $controller = new ConfirmPasswordController();
        $redirectUrl = $controller->redirectTo();

        $this->assertEquals('/user/page/market', $redirectUrl);
    }

    /**
     * Test middleware application.
     *
     * @return void
     */
    public function testMiddleware()
    {
        $controller = new ConfirmPasswordController();

        $this->assertTrue(
            collect($controller->getMiddleware())->contains(function ($middleware) {
                return $middleware['middleware'] === 'auth';
            })
        );
    }
}
