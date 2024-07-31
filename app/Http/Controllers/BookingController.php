<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Classroom;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'user_name' => 'required|string',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time'
        ]);

        $start_time = Carbon::parse($request->start_time);
        $end_time = Carbon::parse($request->end_time);

        // Verificar superposición de reservas en el mismo aula
        $overlappingBookings = Booking::where('classroom_id', $request->classroom_id)
            ->where(function($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                      ->orWhereBetween('end_time', [$start_time, $end_time]);
            })
            ->count();

        if ($overlappingBookings > 0) {
            return response()->json(['error' => 'Time slot is already booked'], 409);
        }

        // Verificar superposición de reservas del mismo usuario en diferentes aulas
        $userOverlappingBookings = Booking::where('user_name', $request->user_name)
            ->where(function($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                      ->orWhereBetween('end_time', [$start_time, $end_time]);
            })
            ->count();

        if ($userOverlappingBookings > 0) {
            return response()->json(['error' => 'User already has a booking in this time slot'], 409);
        }

        // Verificar capacidad del aula
        $classroom = Classroom::find($request->classroom_id);
        $totalHours = $end_time->diffInHours($start_time);
        $slotsNeeded = ceil($totalHours / $classroom->interval);

        if ($slotsNeeded > $classroom->capacity) {
            return response()->json(['error' => 'Not enough capacity'], 409);
        }

        // Crear la reserva
        $booking = Booking::create($request->all());
        return response()->json($booking, 201);
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        // Verificar si la reserva se puede cancelar
        if (Carbon::now()->diffInHours(Carbon::parse($booking->start_time), false) < 24) {
            return response()->json(['error' => 'Cannot cancel less than 24 hours in advance'], 409);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking cancelled'], 200);
    }
}
