<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'status',
    ];

    /**
     * Returns all trip lines in a station
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripLines()
    {
        return $this->hasMany(TripLine::class);
    }
}
