<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'users', 'middleware'=>'api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login'])
        ->name('api.auth.login');

        Route::group(['middleware'=>['jwt.verify']], function ($router) {
            Route::post('logout', [\App\Http\Controllers\Api\AuthController::class,'logout']);
            Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class,'refresh']);
        });
    });
    Route::group(['middleware' => ['auth:api', 'jwt.verify']], function () {
        Route::group(['prefix' => 'trips'], function () {
            Route::get('/', [\App\Http\Controllers\Api\TripController::class, 'index'])->name('api.trips.index');
            Route::get('/{trip}', [\App\Http\Controllers\Api\TripController::class, 'show'])->name('api.trips.show');

            Route::post('/available/seats', [\App\Http\Controllers\Api\BookingController::class, 'showAvailableSeats'])->name('api.trips.show.available.seats');
            Route::post('/book/seat', [\App\Http\Controllers\Api\BookingController::class, 'bookSeat'])->name('book.available.seat');
        });

        Route::group(['prefix' => 'buses'], function () {
            Route::get('/{bus}', [\App\Http\Controllers\Api\BusController::class, 'show'])->name('api.bus.show');
        });

    });
});
