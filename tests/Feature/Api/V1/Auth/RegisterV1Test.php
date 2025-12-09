<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegisterV1Test extends TestCase
{
    use WithFaker,DatabaseMigrations;
     protected function setUp(): void
    {
        parent::setUp();

        DB::table('user_types')->insert([
            ['id' => 1, 'name' => 'ادمن'],
            ['id' => 2, 'name' => 'مستخدم'],
        ]);
    }
          
   public function test_without_data(): void
   {
       $response = $this->postJson('/api/v1/auth/register', []);

       $response->assertStatus(422);

         $response->assertJsonValidationErrors([
              'userName',
              'fullName',
              'password',
              'phone',
         ]);
   }
  public function test_with_invalid_data(): void
   {
       $response = $this->postJson('/api/v1/auth/register', [
           'userName' => 'ab',
           'fullName' => 'a',
           'password' => '',
           'phone' => '',
       ]);

       $response->assertStatus(422);

         $response->assertJsonValidationErrors([
              'phone','password'
                ]);
        }       
   public function test_with_valid_data(): void{
    $data = [
        'userName' => $this->faker->userName,
        'fullName' => $this->faker->name,
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'phone' => '+2010' . rand(10000000, 99999999), // متوافق مع الـ regex
    ];

    $response = $this->postJson('/api/v1/auth/register', $data);

    $response->assertStatus(201);

    $response->assertJsonStructure([
        'success',
        'message',
        'data' => [
            'id',
            'userName',
            'fullName',
            'phone',
            'userType',
            'access_token',
        ],
    ]);

    $this->assertDatabaseHas('users', [
        'userName' => $data['userName'],
        'fullName' => $data['fullName'],
        'phone' => $data['phone'],
    ]);
}
  
        
    
}   