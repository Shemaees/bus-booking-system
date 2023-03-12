<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'status',
        'name',
    ];
    /**
     * Returns the bus of the trip.
     *
     * @return BelongsTo
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    /**
     * Returns the bus of the trip.
     *
     * @return BelongsTo
     */
    public function source_station()
    {
        return $this->belongsTo(Station::class, 'source_station_id');
    }

    /**
     * Returns the bus of the trip.
     *
     * @return BelongsTo
     */
    public function destination_station()
    {
        return $this->belongsTo(Station::class, 'destination_station_id');
    }

    /**
     * Returns all the line of a trip
     *
     * @return HasMany
     */
    public function tripLine()
    {
        return $this->hasMany(TripLine::class)->orderBy('order', 'asc');
    }

    /**
     * Returns trip line in a string
     *
     * @return string
     */
    public function getTripLineTextAttribute(): string
    {
        $stations_line = $this->tripLine->map(function($line) {
            return $line->station->name;
        })->toArray();

        return implode(', ', $stations_line);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
