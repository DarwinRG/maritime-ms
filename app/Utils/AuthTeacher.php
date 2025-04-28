<?php

namespace App\Utils;

use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class AuthTeacher
{
    public static function get()
    {
        return Teacher::where('user_id', Auth::id())->first();
    }
}
