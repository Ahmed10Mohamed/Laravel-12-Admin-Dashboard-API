<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileV1Test extends TestCase
{
       use RefreshDatabase , WithFaker;

     protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'phone' => '+201015891836',
        ]);
    }
   public function test_not_authenticated_user_cannot_access_profile(): void
   {
       $response = $this->getJson('/api/v1/auth/profile');

       $response->assertStatus(401);
   }
   public function test_authenticated_user_can_access_profile(): void
   {
       // Create a user and authenticate
       $this->actingAs($this->user, 'api');

       $response = $this->getJson('/api/v1/auth/profile');

       $response->assertStatus(200);
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
   }
   public function test_authenticated_user_can_update_profile(): void
   {
       // Create a user and authenticate
       $this->actingAs($this->user, 'api');
         $newFullName = $this->faker->name;
         $response = $this->postJson('/api/v1/auth/profile/update', [
              'fullName' => $newFullName,
                'phone' => $this->user->phone,
                'userName' => $this->user->userName,
            ]);

         $response->assertStatus(200); 
            $response->assertJsonFragment([
                'fullName' => $newFullName,
                'phone' => $this->user->phone,
                'userName' => $this->user->userName,

            ]);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [],
        ]);

   }


}
