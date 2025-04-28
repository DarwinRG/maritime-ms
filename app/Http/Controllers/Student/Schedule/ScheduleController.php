<?php

namespace App\Http\Controllers\Student\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleStudent;
use Illuminate\Http\Request;
use App\Utils\AuthStudent;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $auth = AuthStudent::get();
         $students = ScheduleStudent::where('student_id', $auth->id)
         ->with([
            'student',
            'schedule.teacher',
            'schedule.subject',
            'schedule.year',
            'schedule.section'])
        ->orderBy('id','desc')
        ->get();

        return view('student.schedule.index', compact(
            'students',
        ));
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

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {


        $auth = AuthStudent::get();
          $student = ScheduleStudent::where(function($query) use($schedule,$auth){
            $query->where('schedule_id', $schedule->id)->where('student_id',$auth->id);
            })
            ->with(['schedule.modules.list','schedule.subject', 'schedule.year', 'schedule.section', 'student'])
            ->firstOrFail();


        return view('student.schedule.show', compact(
            'schedule',
            'student'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(schedule $program)
    {

    }
}
