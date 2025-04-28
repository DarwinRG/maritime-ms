<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ['name' => 'OBT', 'code' => 'OBT-2025'],
            // ['name' => 'PE 1-M', 'code' => 'PE1M-2025'],
            // ['name' => 'PE 2', 'code' => 'PE2-2025'],
            // ['name' => 'PE 3', 'code' => 'PE3-2025'],
            // ['name' => 'PE 4', 'code' => 'PE4-2025'],
            // ['name' => 'RIZAL', 'code' => 'RIZAL-2025'],
            // ['name' => 'SEAM 1', 'code' => 'SEAM1-2025'],
            // ['name' => 'SEAM 2', 'code' => 'SEAM2-2025'],
            // ['name' => 'SEAM 3', 'code' => 'SEAM3-2025'],
            // ['name' => 'SEAM 4', 'code' => 'SEAM4-2025'],
            // ['name' => 'SEAM 5', 'code' => 'SEAM5-2025'],
            // ['name' => 'SEAM 6', 'code' => 'SEAM6-2025'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
