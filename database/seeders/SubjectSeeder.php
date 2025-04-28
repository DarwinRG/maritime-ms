<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve all courses
        $courses = Course::all();

        // Define subjects for each course
        $subjects = [
            'On Board Trainee',
            // 'Mathematics',
            // 'Physics',
            // 'Chemistry',
            // 'Biology',
            // 'History',
            // 'Literature',
            // 'Art',
            // 'Physical Education',
        ];

        // Iterate over each course and assign subjects
        foreach ($courses as $course) {
            foreach ($subjects as $subjectName) {
                Subject::create([
                    'course_id' => $course->id,
                    'name' => $subjectName,
                    'status' => true,
                ]);
            }
        }
    }
}
