<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookSeatRequest;
use App\Http\Requests\Api\ShowAvailableSeatsRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Trip;
use App\Services\AvailableSeatsForBookingService;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function showAvailableSeats(ShowAvailableSeatsRequest $request, AvailableSeatsForBookingService $service): \Illuminate\Http\JsonResponse
    {
        try {
            $seats = $service->all($request->validated('source_station_id'), $request->validated('destination_station_id'), $request->validated('trip_id'));
            return $this->returnJsonResponse('', ['available_seats_count' => count($seats) ,'seats_numbers'=> $seats]);
        }
        catch (\Exception $exception) {
            return $this->returnJsonResponse($exception->getMessage(), [], $exception->getCode(), Response::HTTP_BAD_REQUEST);        }
    }
    public function bookSeat(BookSeatRequest $request, AvailableSeatsForBookingService $service): \Illuminate\Http\JsonResponse
    {
        try {
            if (!$service->check($request->validated('source_station_id'), $request->validated('destination_station_id'), $request->trip_id,$request->seat_id)) {
                return $this->returnJsonResponse('Sorry, This seat is booked for this trip slot pick anther seat',[], 0, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $input = $request->validated();
            $input['user_id'] = $request->user()->id;
            $input['bus_id'] = Trip::find($request->validated('trip_id'))->bus_id;
            return  $this->returnJsonResponse(new BookingResource(Booking::create($input)) , 'Congratulations!, Your seat is booked');
        }
        catch (\Exception $exception) {
            return $this->returnJsonResponse($exception->getMessage(), [], $exception->getCode(), Response::HTTP_BAD_REQUEST);
        }
    }
}
