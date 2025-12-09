<?php

namespace Tests\Feature\Api\V1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginV1Test extends TestCase
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
    public function test_with_no_data()
    {
        $response = $this->postJson('/api/v1/auth/login', []);
        $response->assertStatus(422);
    }
    public function test_with_invalid_data()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'phone' => 'invalid-phone',
            'password' => 'short',
        ]);
        $response->assertStatus(422);
    }
    public function test_with_password_not_registered()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'phone' => $this->user->phone,
            'password' => 'ValidPass123!',
        ]);
        $response->assertStatus(401);
    }
    public function test_with_valid_data()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'phone' => $this->user->phone,
            'password' => 'Password123!',
        ]);
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
}
