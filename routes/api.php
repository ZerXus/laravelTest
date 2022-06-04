<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'booking'
], function () {
    Route::post('', [BookingController::class, 'createBooking']);
    Route::get('', [BookingController::class, 'getAllBookings']);
    Route::get('user/{user}', [BookingController::class, 'getUserBookings']);
    Route::get('{booking}', [BookingController::class, 'getBooking']);
    Route::delete('{booking}', [BookingController::class, 'deleteBooking']);
    Route::patch('{booking}', [BookingController::class, 'updateBooking']);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
