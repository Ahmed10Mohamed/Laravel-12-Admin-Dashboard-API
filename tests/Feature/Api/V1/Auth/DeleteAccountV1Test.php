<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteAccountV1Test extends TestCase
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

   public function test_not_authenticated_user_cannot_delete_account(): void
   {
       $response = $this->postJson('/api/v1/auth/profile/destroy');

       $response->assertStatus(401);
   }
   public function test_authenticated_user_can_delete_account(): void
   {
       // Create a user and authenticate
       $user = $this->user;
       $this->actingAs($user, 'api');

       $response = $this->postJson('/api/v1/auth/profile/destroy');

       $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => []
        ]);
   }    
}
