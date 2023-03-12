<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'station_id',
        'order',
        'arrive_at'
    ];

    /**
     * Returns The trip that passes by this stop.
     *
     * @return BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * Returns the city where the stop exists
     *
     * @return BelongsTo
     */
    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
