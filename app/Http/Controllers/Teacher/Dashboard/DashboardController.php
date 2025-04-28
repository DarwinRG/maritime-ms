<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Utils\AuthTeacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = AuthTeacher::get();

        $schedules = Schedule::where('teacher_id', $teacher->id)->count();

        $studentCount = Schedule::where('teacher_id', $teacher->id)
            ->withCount('list')
            ->get()
            ->sum('list_count');

        $moduleCount = Schedule::where('teacher_id', $teacher->id)
            ->withCount('modules')
            ->get()
            ->sum('modules_count');

      $moduleListCount = Schedule::where('teacher_id', $teacher->id)
        ->with('modules.list')
        ->get()
        ->pluck('modules')
        ->flatten()
        ->pluck('list')
        ->flatten()
        ->count();


        return view('teacher.dashboard.index', compact('schedules', 'studentCount', 'moduleCount','moduleListCount'));
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
