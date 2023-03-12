<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seat_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('bus_id')->constrained();
            $table->foreignId('trip_id')->constrained();
            $table->foreignId('source_station_id')->constrained('stations');
            $table->foreignId('destination_station_id')->constrained('stations');
            $table->timestamps();
            $table->unique(['seat_id', 'source_station_id', 'destination_station_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
