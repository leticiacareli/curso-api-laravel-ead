<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $model){
        $this->entity = $model;
    }

    public function findByModuleId(string $moduleId){
        return $this->entity->where('module_id', $moduleId)->get();
    }

    public function find(string $id){
        return $this->entity->findOrFail($id);
    }
}