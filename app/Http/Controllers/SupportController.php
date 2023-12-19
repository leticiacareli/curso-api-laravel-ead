<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\ReplySupportResource;
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
        return SupportResource::collection($this->repository->findByUserId($request->all()));
    }

    public function store(StoreSupportRequest $request){
        $support = $this->repository->store($request->validated());

        return new SupportResource($support);
    }

    public function storeReply($supportId, StoreReplySupportRequest $request){
        $reply = $this->repository->storeReply($supportId, $request->validated());

        return new ReplySupportResource($reply);
    }
}
