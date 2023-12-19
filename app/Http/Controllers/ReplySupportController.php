<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplySupportRepository;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepository $replySupportRepository){
        $this->repository = $replySupportRepository;
    }

    public function store(StoreReplySupportRequest $request){
        $reply = $this->repository->store($request->validated());

        return new ReplySupportResource($reply);
    }
}
