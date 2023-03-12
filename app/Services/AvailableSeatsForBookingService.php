<?php
namespace App\Services;
use App\Models\Trip;
use App\Models\TripLine;

class AvailableSeatsForBookingService
{
    /**
     * This Function Gets Bus Available Seats For The User Start and End Station
     * returns unbooked seats.
     * @param $start_station_id
     * @param $end_station_id
     * @param $trip_id
     * @return array
     */
    public function all($start_station_id, $end_station_id, $trip_id): array
    {
        $trip = Trip::with('bookings', 'tripLine', 'bus.seats')->find($trip_id);
        $line = TripLine::whereIn('station_id', [$start_station_id, $end_station_id])->get();
        $start = $line->where('station_id', $start_station_id)->first();
        $end = $line->where('station_id', $end_station_id)->first();
        $unAvailableSeats = [];

        // close booked seats
        foreach ($trip->bookings as $booking) {
            $booking_source_station = $trip->tripLine->where('station_id', $booking->source_station_id)->first();
            $booking_destination_station = $trip->tripLine->where('station_id', $booking->source_station_id)->first();
            $has_intersection = ($start->order >= $booking_source_station->order && $start->order < $booking_destination_station->order)
                ||
                ($end->order > $booking_source_station->order && $end->order <= $booking_destination_station->order)
                ||
                ($start->order <= $booking_source_station->order && $end->order >= $booking_destination_station->order);

            if ($has_intersection) {
                $unAvailableSeats[] = $booking->seat_id;
            }
        }
        return $trip->bus->seats->whereNotIn('id', $unAvailableSeats)->pluck('id')->toArray();
    }

    /**
     * Checks if User Given Seat ID is Free for the required trip or not
     * @param $start_station_id
     * @param $end_station_id
     * @param $trip_id
     * @param $seat_id
     * @return bool
     */
    public function check($start_station_id, $end_station_id, $trip_id , $seat_id): bool
    {
        return collect($this->all($start_station_id, $end_station_id, $trip_id))->contains($seat_id);
    }
}
