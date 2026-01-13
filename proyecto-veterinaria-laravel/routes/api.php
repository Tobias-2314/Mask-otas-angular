<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AppointmentsController;
use App\Http\Controllers\Api\LocationController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/reviews', [App\Http\Controllers\Api\ReviewsController::class, 'index']);
Route::post('/reviews', [App\Http\Controllers\Api\ReviewsController::class, 'store']);
Route::get('/reviews/stats', [App\Http\Controllers\Api\ReviewsController::class, 'stats']);

Route::get('/appointments/time-slots', [App\Http\Controllers\Api\AppointmentsController::class, 'getTimeSlots']);
Route::get('/appointments', [App\Http\Controllers\Api\AppointmentsController::class, 'index']);
Route::post('/appointments', [App\Http\Controllers\Api\AppointmentsController::class, 'store']);

Route::get('/location/countries', [App\Http\Controllers\Api\LocationController::class, 'getCountries']);
Route::get('/location/cities/{countryCode}', [App\Http\Controllers\Api\LocationController::class, 'getCities']);

Route::post('/chat', [App\Http\Controllers\Api\AiChatController::class, 'chat']);
