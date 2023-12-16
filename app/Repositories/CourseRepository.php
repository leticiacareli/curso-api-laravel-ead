<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $model){
        $this->entity = $model;
    }

    public function all(){
        return $this->entity->get();
    }

    public function find(string $id){
        return $this->entity->findOrFail($id);
    }
}