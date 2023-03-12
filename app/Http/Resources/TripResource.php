<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            'trip_name' => $this->resource->name,
            $this->mergeWhen(collect($this->resource)->has('source_station'), [
                'source_station' => new StationResource($this->resource->source_station)
            ]),
            $this->mergeWhen(collect($this->resource)->has('destination_station'), [
                'destination_station' => new StationResource($this->resource->destination_station)
            ]),
            $this->mergeWhen(collect($this->resource)->has('stops'), [
                'line' => StationResource::collection($this->resource->tripLine->pluck('station'))
            ]),
            $this->mergeWhen(collect($this->resource)->has('bus'), [
                'bus' => new BusResource($this->resource->bus)
            ]),
        ];
    }
}
