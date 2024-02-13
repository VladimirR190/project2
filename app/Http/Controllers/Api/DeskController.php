<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskStoreRequest;
use App\Http\Resources\DeskResource;
use App\Models\Desk;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return DeskResource::collection(Desk::with('lists')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeskStoreRequest $request)
    {
        $created_desk = Desk::create($request->validated());

        return new DeskResource($created_desk);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new DeskResource(Desk::with('lists')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeskStoreRequest $request, Desk $desk)
    {
        $desk->update($request->validate());
        return new DeskResource($desk);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desk $desk)
    {
        $desk->delete();
        
        return response(null,Response::CONTENT_ENCODING_NONe);
    }
}
