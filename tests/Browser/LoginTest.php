<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'password' => bcrypt('Password123!'),
        ]);
    }

    public function test_user_can_login()
    {
        $user = $this->user;

        $this->browse(function (Browser $browser) use ($user) {

            $browser->visit(route('login'))
                ->waitForText('احمد راغب', 15)

                ->typeSlowly('email', $user->email)
                ->type('password', 'Password123!')

                // Use button[type=submit] instead of dusk selector
                ->click('button[type=submit]')

                // Allow redirect time
                ->waitForText('© 2025', 20)

                ->assertSee($user->userName);
        });
    }
}
