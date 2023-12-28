<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\TestTrait;

class AuthTest extends TestCase
{
    use TestTrait;

    public function test_fail_auth(){
        $response = $this->postJson('/api/auth');
        $response->assertStatus(422);
    }

    public function test_auth(){
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'desktop'
        ]);

        $response->assertStatus(200);
    }

    public function test_fail_logout(){
        $response = $this->postJson('/api/logout');
        $response->assertStatus(401);
    }

    public function test_logout(){
        $response = $this->postJson('/api/logout', [], $this->defaultHeader());
        $response->assertStatus(200);
    }

    public function test_fail_get_me(){
        $response = $this->getJson('/api/me');
        $response->assertStatus(401);
    }

    public function test_get_me(){
        $response = $this->getJson('/api/me', $this->defaultHeader());
        $response->assertStatus(200);
    }
}
