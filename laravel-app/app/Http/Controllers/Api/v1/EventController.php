<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new EventCollection(Event::paginate()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        Log::info("Request");
        Log::info($request);
        Log::info("Event");
        Log::info($event);
        
        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateEventRequest $request, Event $event)
        {
            $event->update($request->validated());

            return (new EventResource($event))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

