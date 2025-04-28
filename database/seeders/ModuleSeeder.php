<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Schedule;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all schedules
        $schedules = Schedule::all();

        // Check if schedules exist
        if ($schedules->isEmpty()) {
            $this->command->info('No schedules found! Please seed schedules first.');
            return;
        }

        // Loop through each schedule and create 20 modules
        foreach ($schedules as $schedule) {
            for ($i = 1; $i <= 10; $i++) {
                Module::create([
                    'title' => "Module $i for Schedule {$schedule->id}",
                    'description' => "This is a sample module $i for schedule {$schedule->id}.",
                    'schedule_id' => $schedule->id, // Assign to current schedule
                ]);
            }
        }

        $this->command->info('20 modules created for each schedule successfully!');
    }
}
