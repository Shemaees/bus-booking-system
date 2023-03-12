<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreTripRequest;
use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Returns all the trips.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $trips = Trip::with('bus.seats', 'tripLine')->get();

        return view('dashboard.trips.index', compact('trips'));
    }

    /**
     * Returns a page to create new trip
     *
     * @return void
     */
    public function create()
    {
        $buses = Bus::whereDoesntHave('trips')->get()->pluck('plate_number', 'id');
        $stations = Station::orderBy('name')->get();

        return view('dashboard.trips.create', compact('buses', 'stations'));
    }

    /**
     * Stores new trip
     *
     * @param StoreTripRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTripRequest $request)
    {
        try {
            dd($request->line);
            $bus = Bus::findOrFail($request->validated('bus_id'));
            $trip = $bus->trips()->create();
            foreach ($request->validated('line') as $key => $station) {
                $trip->tripLine()->create(['station_id' => $station, 'order' => $key + 1]);
            }

            toastr()->success('Trip was added successfully');
            return redirect()->route('trips.index');
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            toastr()->error('Trip was not added');
            return redirect()->route('trips.create');
        }
    }
}
