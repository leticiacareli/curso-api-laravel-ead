<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $moduleRepository){
        $this->repository = $moduleRepository;
    }

    public function index($courseId){
        $modules = $this->repository->findByCourseId($courseId);
        
        return ModuleResource::collection($modules);
    }
}
