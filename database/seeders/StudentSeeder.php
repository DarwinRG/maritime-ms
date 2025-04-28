<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {

            $user = User::create([
                'email' => "student{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);


            Student::create([
                'student_id' => 'STU' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'user_id' => $user->id,
                'first_name' => 'First' . $i,
                'middle_name' => 'Middle' . $i,
                'last_name' => 'Last' . $i,
                'address' => '123 Sample St.',
                'street' => 'Sample St.',
                'city' => 'Sample City',
                'province' => 'Sample Province',
                'birth_date' => now()->subYears(20)->format('Y-m-d'),
                'contact' => '0912345678' . $i,
                'status' => 1,
            ]);
        }
    }
}
