<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('events', [EventController::class, 'index']);
Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('events/{event}/attendees', [AttendeeController::class, 'index']);
Route::get('events/{event}/attendees/{attendee}', [AttendeeController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    // Events
    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{event}', [EventController::class, 'update']);
    Route::delete('events/{event}', [EventController::class, 'destroy']);

    // Event Attendees
    Route::delete('events/{event}/attendees/{attendee}', [AttendeeController::class, 'destroy']);
    Route::post('events/{event}/attendees', [AttendeeController::class, 'store']);
});


Route::fallback(function () {
    return response()->json(['message' => 'This endpoint was not found!'], 404);
});
