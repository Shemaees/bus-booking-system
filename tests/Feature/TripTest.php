<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\CreatesApplication;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::orderByDesc('id')->first(), 'api');
    }

    public function test_list_trips()
    {
        $this->getJson(route('api.trips.index'))
            ->assertJsonCount(Trip::count(), 'data')
            ->assertSuccessful()
            ->assertJsonStructure(['data' => [
                '*' => [
                    'id',
                    'name',
                ]
            ]]);
    }

    public function test_show_trip()
    {
        $trip= Trip::first();
        $this->getJson(route('api.trips.show',$trip->id))
            ->assertSuccessful()
            ->assertJson(['data' => [
                'id' =>$trip->id,
                'name' =>$trip->trip_name,
            ]])
            ->assertJsonStructure(['data' => [
                'id',
                'name',
                'source_station',
                'destination_station',
                'line',
                'bus',
            ]]);
    }

    public function test_show_not_existing_trip()
    {
        $this->getJson(route('api.trips.show', 404))
            ->assertNotFound();
    }
}
