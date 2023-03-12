<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Returns all the trips.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->returnJsonResponse('all trips', TripResource::collection(Trip::all()));
    }

    public function show(Trip $trip): JsonResponse
    {
        $trip->load(['bus', 'source_station', 'destination_station', 'tripLine' => function ($q) {
            $q->with('station')->orderBy('order');
        }]);

        return $this->returnJsonResponse(new TripResource($trip), 'Trip Details');
    }


}
