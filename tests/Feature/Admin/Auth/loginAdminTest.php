<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\DomCrawler\Crawler;

class loginAdminTest extends TestCase
{
    use RefreshDatabase;
        protected $user;

     protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
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
        $errors = session('errors')->getMessages();

        $this->assertArrayHasKey('email', $errors);
        $this->assertArrayHasKey('password', $errors);
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
        $response->assertSessionHas('fail', "اسم المستخدم او البريد الالكترونى غير صحيح");
    }
    public function test_admin_cannot_login_with_incorrect_password(): void
    {
            $response = $this->post(route('admin.login'), [
            'email' => $this->user->email,
            'password' => 'WrongPassword!',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('fail', "كلمة المرور غير صحيحة");
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
        $response->assertSessionHas('fail', "هذا الحساب معطل");
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
