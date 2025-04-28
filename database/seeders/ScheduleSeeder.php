<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Generate 10 schedules with random teachers
        for ($i = 0; $i < 10; $i++) {
            $section = Section::inRandomOrder()->first();
            $teacher = Teacher::inRandomOrder()->first();
            $subject = Subject::inRandomOrder()->first();
            $year = Year::inRandomOrder()->first();
            $day = $days[array_rand($days)];

            // Generate random start and end times
            $start_at = now()->setHour(rand(7, 15))->setMinute(0)->format('H:i:s'); // Between 7 AM - 3 PM
            $end_at = now()->setHour(rand(16, 20))->setMinute(0)->format('H:i:s'); // Between 4 PM - 8 PM

            // Check for schedule conflicts
            $conflict = Schedule::where('day', $day)
                ->where(function ($query) use ($teacher, $section, $start_at, $end_at) {
                    $query->where('teacher_id', $teacher->id)
                        ->orWhere('section_id', $section->id);
                })
                ->where(function ($query) use ($start_at, $end_at) {
                    $query->whereBetween('start_at', [$start_at, $end_at])
                        ->orWhereBetween('end_at', [$start_at, $end_at])
                        ->orWhere(function ($q) use ($start_at, $end_at) {
                            $q->where('start_at', '<=', $start_at)
                                ->where('end_at', '>=', $end_at);
                        });
                })
                ->exists();

            // Insert only if no conflict
            if (!$conflict) {
                Schedule::create([
                    'section_id' => $section->id,
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'year_id' => $year->id,
                    'day' => $day,
                    'start_at' => $start_at,
                    'end_at' => $end_at,
                    'status' => 1,
                ]);

                echo "✅ Schedule #$i created for Teacher ID {$teacher->id} on $day ($start_at - $end_at)\n";
            } else {
                echo "❌ Conflict detected for Schedule #$i! Skipping...\n";
            }
        }

        // Add an extra schedule for teacher_id = 1
        $section = Section::inRandomOrder()->first();
        $subject = Subject::inRandomOrder()->first();
        $year = Year::inRandomOrder()->first();
        $day = $days[array_rand($days)];
        $start_at = now()->setHour(rand(7, 15))->setMinute(0)->format('H:i:s');
        $end_at = now()->setHour(rand(16, 20))->setMinute(0)->format('H:i:s');

        // Ensure there's no conflict before inserting
        $conflict = Schedule::where('day', $day)
            ->where('teacher_id', 1)
            ->where(function ($query) use ($start_at, $end_at) {
                $query->whereBetween('start_at', [$start_at, $end_at])
                    ->orWhereBetween('end_at', [$start_at, $end_at])
                    ->orWhere(function ($q) use ($start_at, $end_at) {
                        $q->where('start_at', '<=', $start_at)
                            ->where('end_at', '>=', $end_at);
                    });
            })
            ->exists();

        if (!$conflict) {
            Schedule::create([
                'section_id' => $section->id,
                'teacher_id' => 1, // Default to Teacher ID 1
                'subject_id' => $subject->id,
                'year_id' => $year->id,
                'day' => $day,
                'start_at' => $start_at,
                'end_at' => $end_at,
                'status' => 1,
            ]);

            echo "✅ Extra Schedule created for Teacher ID 1 on $day ($start_at - $end_at)\n";
        } else {
            echo "❌ Conflict detected for Teacher ID 1! Skipping...\n";
        }
    }
}
