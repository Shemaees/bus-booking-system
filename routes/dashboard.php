<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:dashboard'], function (){
    Route::get('login', [\App\Http\Controllers\Dashboard\LoginController::class, 'getLogin'])->name('dashboard.login.get');
    Route::post('login', [\App\Http\Controllers\Dashboard\LoginController::class, 'login'])->name('dashboard.login');
});

Route::group(['middleware' => 'auth:dashboard'], function (){
    Route::post('logout', [\App\Http\Controllers\Dashboard\LoginController::class, 'logout'])->name('dashboard.logout');

    Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard.index');

    Route::resources([
        'trips' => \App\Http\Controllers\Dashboard\TripController::class
    ]);
});
