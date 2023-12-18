<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model){
        $this->entity = $model;
    }

    private function getUserAuth(){
        return User::first();
    }

    public function findByUserId(array $filters = []){
        return $this->getUserAuth()
                    ->supports()
                    ->where(function($query) use ($filters) {
                        if(isset($filters['lesson'])){
                            $query->where('lesson_id', $filters['lesson']);
                        }

                        if(isset($filters['status'])){
                            $query->where('status', $filters['status']);
                        }

                        if(isset($filters['filter'])){
                            $filter = $filters['filter'];
                            $query->where('description', 'LIKE', "%{$filter}%");
                        }
                    })->get();

    }
}