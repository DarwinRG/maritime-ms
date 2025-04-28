<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModuleListSeeder extends Seeder
{
    public function run()
    {
        // Fetch all module IDs
        $moduleIds = DB::table('modules')->pluck('id');

        // Check if modules exist
        if ($moduleIds->isEmpty()) {
            $this->command->info('No modules found! Please seed the modules table first.');
            return;
        }

        // Loop through each module and create a module list entry
        foreach ($moduleIds as $moduleId) {
            $startAt = Carbon::now()->addDays(rand(5, 30)); // Random future start date
            $endAt   = $startAt->copy()->addDays(rand(1, 15)); // Ensure end_at is after start_at

            DB::table('module_lists')->insert([
                'module_id'  => $moduleId,
                'title'      => 'Module File for ID ' . $moduleId,
                'file'       => 'module_' . $moduleId . '.pdf', // Dummy file name
                'start_at'   => $startAt,
                'end_at'     => $endAt,
                'description'=>'nothing just test',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Module lists seeded successfully with start_at and end_at!');
    }
}
