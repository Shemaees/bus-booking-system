<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
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
            $this->mergeWhen(collect($this->resource)->has('seats'), [
                'seats' => SeatResource::collection($this->resource->seats)
            ]),
        ];
    }
}
