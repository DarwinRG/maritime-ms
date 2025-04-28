<?php

namespace App\Utils;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AuthStudent
{
    public static function get()
    {
        return Student::where('user_id', Auth::id())->first();
    }
}
