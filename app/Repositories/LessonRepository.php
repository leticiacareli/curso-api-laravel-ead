<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;

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

    public function markLessonViewed(string $id){
        $user = $this->getUserAuth();
        $view = $user->views()->where('lesson_id', $id)->first();

        if($view){
            return $view->update([
                'qty_views' => $view->qty_views + 1,
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $id
        ]);
    }
}