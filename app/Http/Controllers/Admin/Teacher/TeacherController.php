<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with('user')->where('status',true)->get();
        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'contact' => 'required|string|max:20',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'Teacher',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'teacher_id' => $request->teacher_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'province' => $request->province,
            'birth_date' => $request->birth_date,
            'contact' => $request->contact,
            'status' => 1,
        ]);


        return redirect()->route('admin.teacher.index')->with('success', 'Teacher added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'email' => 'required|email|unique:users,email,' . $id,
            'teacher_id' => 'required',
            'password' => 'nullable|min:6',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'contact' => 'required|string|max:15',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->except('email', 'password'));

        if ($request->filled('password')) {
            $teacher->user->update(['password' => bcrypt($request->password)]);
        }

        // $teacher->user->update(['email' => $request->email]);

        return redirect()->back()->with('success', 'Teacher updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
         $teacher->update(['status'=>0]);
         return redirect()->back()->with('warning', 'Teacher archive successfully!');
    }
}
