<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            // StudentSeeder::class,
            // TeacherSeeder::class,
            // YearSeeder::class,
            // CourseSeeder::class,
            // SubjectSeeder::class,
            // SectionSeeder::class,
            // ScheduleSeeder::class,
            // StudentScheduleSeeder::class,
            // ModuleSeeder::class,
            // ModuleListSeeder::class,
        ]);
    }
}
