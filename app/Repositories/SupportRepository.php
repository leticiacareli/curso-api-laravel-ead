<?php

namespace App\Repositories;

use App\Models\Support;

class SupportRepository
{
    protected $entity;

    public function __construct(Support $model){
        $this->entity = $model;
    }

    public function all(){
        return $this->entity->all();
    }
}