<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use App\Models\TripLine;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $source = Station::whereName('Cairo')->first();
        $destination = Station::whereName('Asyut')->first();
        $bus = Bus::whereDoesntHave('trips')->first();
        if (!$bus) {
            return;
        }
        $trip = $bus->trips()->create([
            'name' => fake()->name(),
            'source_station_id' => $source->id,
            'destination_station_id' => $destination->id,
        ]);
        $trip->tripLine()->delete();
        $stations = ['cairo', 'faiyum', 'minya', 'asyut'];
        foreach ($stations as $key => $station) {
            $trip->tripLine()->create([
                'station_id' => Station::where('code',$station)->first()->id,
                'order' => $key++,
            ]);
        }
    }
}
