<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class logoutAdminTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
    }

    public function test_admin_cannot_logout_when_not_authenticated(): void
    {
        // send logout request without being authenticated
        $response = $this->get(route('admin_logout'));

        // check response status
        $response->assertStatus(302);

        // check redirection to login page
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_logout_success(): void
    {
        // connect as admin admin
        $response = $this->post(route('admin.login'), [
            'email' => $this->admin->email,
            'password' => 'Password123!',
        ]);

        // send logout request
        $response = $this->get(route('admin_logout'));

        // check response status
        $response->assertStatus(302);

        // check redirection to login page
        $response->assertRedirect(route('login'));
        $this->assertFalse(Auth::guard('admin')->check());

        // check that the admin admin is no longer authenticated
        $this->assertGuest('admin');
    }
}
