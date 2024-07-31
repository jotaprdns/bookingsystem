<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\BookingController;

Route::get('/classrooms', [ClassroomController::class, 'index']);
Route::post('/book', [BookingController::class, 'book']);
Route::delete('/cancel/{id}', [BookingController::class, 'cancel']);
