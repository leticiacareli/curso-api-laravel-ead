<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(ReplySupport $model){
        $this->entity = $model;
    }
    
    public function store(array $data){
        $userAuth = $this->getUserAuth();
        
        return $this->entity
                    ->create([
                        'description'   => $data['description'],
                        'support_id'    => $data['support'],
                        'user_id'       => $userAuth->id,
                    ]);
    }
}