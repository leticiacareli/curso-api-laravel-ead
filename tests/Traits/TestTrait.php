<?php

namespace Tests\Traits;

use App\Models\User;

trait TestTrait
{
    public function createTokenUser(){
        $user = User::factory()->create();
        $token = $user->createToken('createToken')->plainTextToken;

        return $token;
    }

    public function defaultHeader(){
        $token = $this->createTokenUser();
        
        return ['Authorization' => "Bearer {$token}"];
    }
}
