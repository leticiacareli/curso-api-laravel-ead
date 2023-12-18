<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository){
        $this->repository = $supportRepository;
    }

    public function index(Request $request){
        return SupportResource::collection($this->repository->all());
    }
}
