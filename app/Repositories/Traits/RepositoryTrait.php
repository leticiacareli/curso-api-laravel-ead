<?php

namespace App\Repositories\Traits;

use App\Models\User;

trait RepositoryTrait
{
    private function getUserAuth(){
        return User::first();
    }
}