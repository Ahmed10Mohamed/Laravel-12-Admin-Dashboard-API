<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class loginAdminTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
    }

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_admin_login_validation_errors_on_empty_submission(): void
    {
        $response = $this->post(route('admin.login'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'password']);

        // check specific error messages
    }

    public function test_admin_cannot_login_with_incorrect_email(): void
    {

        $response = $this->post(route('admin.login'), [
            'email' => 'admin@example.com',
            'password' => 'Password123!',
        ], [
            'X-CSRF-TOKEN' => csrf_token(),
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('fail', translate('this user name or email not found'));
    }

    public function test_admin_cannot_login_with_incorrect_password(): void
    {
        $response = $this->post(route('admin.login'), [
            'email' => $this->user->email,
            'password' => 'WrongPassword!',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('fail', translate('this passoword not correct'));
    }

    public function test_admin_not_active_cannot_login(): void
    {
        $this->user->isActive = false;
        $this->user->save();
        $response = $this->post(route('admin.login'), [
            'email' => $this->user->email,
            'password' => 'Password123!',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('fail', translate('this account not active'));
    }

    public function test_admin_can_login_with_correct_credentials(): void
    {
        // Create an admin user
        $response = $this->post(route('admin.login'), [
            'email' => $this->user->email,
            'password' => 'Password123!',
        ]);
        $this->assertAuthenticatedAs($this->user, 'admin');
        $response->assertRedirect(route('Admin-Dashboard'));
    }
}
