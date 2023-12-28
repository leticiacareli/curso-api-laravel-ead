<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Support $model){
        $this->entity = $model;
    }

    private function find(string $id){
        return $this->entity->findOrFail($id);
    }

    public function getMySupports(array $filters = []){
        $filters['user'] = true;

        return $this->findByUserId($filters);
    }

    public function findByUserId(array $filters = []){
        return $this->entity
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

                        if(isset($filters['user'])){
                            $user = $this->getUserAuth();
                            $query->where('user_id', $user->id);
                        }
                    })
                    ->with('replies')
                    ->orderBy('updated_at', 'DESC')
                    ->get();

    }

    public function store(array $data){
        $created = $this->getUserAuth()
                        ->supports()
                        ->create([
                            'lesson_id'     => $data['lesson'],
                            'description'   => $data['description'],
                            'status'        => $data['status'],
                        ]);

        return $created;
    }

    
}