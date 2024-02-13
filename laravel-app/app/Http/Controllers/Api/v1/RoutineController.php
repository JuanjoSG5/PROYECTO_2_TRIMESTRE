<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Routine;
use App\Http\Requests\StoreRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\RoutineCollection;
use App\Http\Resources\RoutineResource;
use Illuminate\Http\Response;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new RoutineCollection(Routine::paginate()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Routine $routine)
    {
        return (new RoutineResource($routine))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoutineRequest $request)
    {
        $routine = Routine::create($request->validated());

        return (new RoutineResource($routine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoutineRequest $request, Routine $routine)
    {
        $routine->update($request->validated());

        return (new RoutineResource($routine))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routine $routine)
    {
        $routine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
