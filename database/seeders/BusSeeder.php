<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bus::factory(10)->create();
        foreach (Bus::all() as $bus) {
            for ($i = 1; $i < 13; $i++) {
                Seat::factory()->create([
                    'bus_id' => $bus->id,
                    'order' => $i,
                ]);
            }
        }
    }
}
