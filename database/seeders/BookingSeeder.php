<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'classroom_id' => 1,
                'user_name' => 'John Doe',
                'start_time' => Carbon::now()->addDays(2)->setTime(9, 0),
                'end_time' => Carbon::now()->addDays(2)->setTime(11, 0),
            ],
            [
                'classroom_id' => 2,
                'user_name' => 'Jane Smith',
                'start_time' => Carbon::now()->addDays(3)->setTime(8, 0),
                'end_time' => Carbon::now()->addDays(3)->setTime(9, 0),
            ],
            // Agrega más datos de ejemplo si es necesario
        ]);
    }
}
