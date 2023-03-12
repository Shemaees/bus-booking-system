<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'order'
    ];

    /**
     * Returns the nus of the seat.
     *
     * @return BelongsTo
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
