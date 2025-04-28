<?php

namespace App\Http\Controllers\Student\Setting;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentBoarding;
use App\Models\User;
use App\Utils\AuthStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = AuthStudent::get();
         $student = Student::where('id', $student->id)->with('boarding')->first();
        return view('student.setting.index',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $setting)
    {



        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::where('id', $setting->user_id)->firstOrFail();

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        $user->update([
            'avatar' => $user->avatar
        ]);

        StudentBoarding::updateOrCreate(
            ['student_id' => $user->student->id], // Find condition
            [
                'boarding_on'  => $request->board_on,
                'boarding_off' => $request->board_off
            ]
        );

        $user->student->update([
            'first_name'   => $request->first_name,
            'middle_name'  => $request->middle_name,
            'last_name'    => $request->last_name,
            'birth_date'   => $request->birth_date,
            'contact'      => $request->contact,
            'address'      => $request->address,
            'street'       => $request->street,
            'city'         => $request->city,
            'province'     => $request->province,
        ]);


        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
