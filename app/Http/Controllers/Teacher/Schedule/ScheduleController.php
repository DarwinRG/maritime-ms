<?php

namespace App\Http\Controllers\Teacher\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Utils\AuthTeacher;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teacher = AuthTeacher::get();
         $schedules = schedule::where('teacher_id', $teacher->id)->with(['subject','year','section','teacher'])
        ->withCount('list')
        ->orderBy('id','desc')
        ->get();

        return view('teacher.schedule.index', compact(
            'schedules',
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


        $teacher = AuthTeacher::get();
        $schedule = Schedule::where('id', $schedule->id)
            ->where('teacher_id',$teacher->id)
            ->with(['modules.list.student','subject', 'year', 'section', 'teacher'])
            ->firstOrFail();


        $subjects = Subject::all();
        $years = Year::all();
        $sections = Section::all();
        $teachers = Teacher::all();

        return view('teacher.schedule.show', compact(
            'subjects',
            'years',
            'sections',
            'schedule',
            'teachers'
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
        $program->update(['status'=>0]);
        return redirect()->back()->with('danger','schedule has been archive');
    }
}
