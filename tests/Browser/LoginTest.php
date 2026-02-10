<?php

namespace Tests\Browser;

use App\Models\Admin;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class LoginTest extends DuskTestCase
{
        use RefreshDatabase;
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create([
            'password' => bcrypt('Password123!'),
        ]);
    }

    public function test_admin_can_login()
    {
        $admin = $this->admin;

        $this->browse(function (Browser $browser) use ($admin) {

            $browser->visit(route('login'))
                ->typeSlowly('email', $admin->email)
                ->type('password', 'Password123!')

                // Use button[type=submit] instead of dusk selector
                ->click('button[type=submit]')

                // Allow redirect time
                ->waitForText('© 2025', 20)

                ->assertSee($admin->userName);
        });
    }
}
