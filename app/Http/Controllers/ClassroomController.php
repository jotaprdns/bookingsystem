<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Booking;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all()->map(function($classroom) {
            $now = Carbon::now();
            $currentBookings = Booking::where('classroom_id', $classroom->id)
                ->where('start_time', '>', $now)
                ->count();

            return [
                'name' => $classroom->name,
                'days' => $classroom->days,
                'start_time' => $classroom->start_time,
                'end_time' => $classroom->end_time,
                'capacity' => $classroom->capacity,
                'current_availability' => $classroom->capacity - $currentBookings,
            ];
        });

        return response()->json($classrooms);
    }
}
