<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            // Create a new user for the teacher
            $user = User::create([
                'email' => "teacher{$i}@example.com",
                'password' => Hash::make('password'), // Default password
                'role' => 'teacher',
            ]);

            // Create a teacher linked to that user
            Teacher::create([
                'teacher_id' => 'TCH' . str_pad($i, 3, '0', STR_PAD_LEFT), // TCH001, TCH002, ...
                'user_id' => $user->id,
                'first_name' => 'TeacherFirst' . $i,
                'middle_name' => 'TeacherMiddle' . $i,
                'last_name' => 'TeacherLast' . $i,
                'address' => '456 Faculty Lane',
                'street' => 'Faculty St.',
                'city' => 'Faculty City',
                'province' => 'Faculty Province',
                'birth_date' => now()->subYears(35)->format('Y-m-d'), // Approx. 35 years old
                'contact' => '0923456789' . $i, // Unique contact number
                'status' => 1,
            ]);
        }
    }
}
