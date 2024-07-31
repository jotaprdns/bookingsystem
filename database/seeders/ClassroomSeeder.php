<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        DB::table('classrooms')->insert([
            [
                'name' => 'Math Classroom',
                'days' => 'Monday,Tuesday,Wednesday',
                'start_time' => '09:00:00',
                'end_time' => '19:00:00',
                'capacity' => 10,
                'interval' => 2,
            ],
            [
                'name' => 'Art Classroom',
                'days' => 'Monday,Thursday,Saturday',
                'start_time' => '08:00:00',
                'end_time' => '18:00:00',
                'capacity' => 15,
                'interval' => 1,
            ],
            [
                'name' => 'Science Classroom',
                'days' => 'Tuesday,Friday,Saturday',
                'start_time' => '15:00:00',
                'end_time' => '22:00:00',
                'capacity' => 7,
                'interval' => 1,
            ],
            [
                'name' => 'Geography Classroom',
                'days' => 'Thursday,Friday',
                'start_time' => '08:00:00',
                'end_time' => '18:00:00',
                'capacity' => 15,
                'interval' => 2,
            ],
            [
                'name' => 'Computer Science Classroom',
                'days' => 'Monday,Friday',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'capacity' => 23,
                'interval' => 1,
            ],
            [
                'name' => 'History Classroom',
                'days' => 'Tuesday,Wednesday',
                'start_time' => '10:00:00',
                'end_time' => '19:00:00',
                'capacity' => 11,
                'interval' => 3,
            ],
        ]);
    }
}
