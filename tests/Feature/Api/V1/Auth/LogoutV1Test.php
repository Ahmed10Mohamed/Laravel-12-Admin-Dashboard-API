<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutV1Test extends TestCase
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

   public function test_not_authenticated_user_cannot_access_logout(): void
   {
       $response = $this->postJson('/api/v1/auth/profile/logout');

       $response->assertStatus(401);
   }
     public function test_authenticated_user_can_logout(): void
     {
         // Create a user and authenticate
         $this->actingAs($this->user, 'api');
            $response = $this->postJson('/api/v1/auth/profile/logout');
            $response->assertStatus(200);
            
            $response->assertJsonStructure([
                'success',
                'message',
                'data' => []
                ]);
     }   
}

