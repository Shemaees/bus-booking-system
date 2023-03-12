<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::destroy(Station::all());
        $stations = [
            'Cairo',
            'Faiyum',
            'Minya',
            'Asyut',
        ];
        foreach ($stations as $station) {
            Station::create([
                'name' => $station,
                'code' => Str::slug(strtolower($station)),
                'status' => 1
            ]);
        }
    }
}
