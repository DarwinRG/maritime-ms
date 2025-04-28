<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\ScheduleStudent;

class StudentScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = Schedule::all(); // Get all schedules
        $students = Student::all(); // Get all students

        if ($schedules->isEmpty() || $students->isEmpty()) {
            return;
        }

        foreach ($students as $student) {
            // Assign each student to a random schedule
            $schedule = $schedules->random();

            // Ensure no duplicate schedule-student entry
            ScheduleStudent::firstOrCreate([
                'schedule_id' => $schedule->id,
                'student_id' => $student->id,
            ]);
        }
    }
}
