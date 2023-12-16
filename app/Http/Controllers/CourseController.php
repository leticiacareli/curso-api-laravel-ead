<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Repositories\CourseRepository;

class CourseController extends Controller
{
    protected $repository;

    public function __construct(CourseRepository $courseRepository){
        $this->repository = $courseRepository;
    }

    public function index(){
        return CourseResource::collection($this->repository->all());
    }

    public function show($id){
        return new CourseResource($this->repository->find($id));
    }
}
