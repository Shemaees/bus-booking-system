<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'seat_id' => $this->resource->seat_id,
            'user' => $this->resource->user,
            'trip' => new TripResource($this->resource->trip),
            'bus' => new BusResource($this->resource->bus),
            'source' => new StationResource($this->resource->source),
            'destination' => new StationResource($this->resource->destination),
        ];
    }
}
