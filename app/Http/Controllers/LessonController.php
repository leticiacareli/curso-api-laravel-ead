<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $lessonRepository){
        $this->repository = $lessonRepository;
    }

    public function index($moduleId){
        $lessons = $this->repository->findByModuleId($moduleId);

        return LessonResource::collection($lessons);
    }
    
    public function show($id){
        return new LessonResource($this->repository->find($id));
    }
}
