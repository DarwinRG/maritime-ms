<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::where('status',1)->orderBy('id','desc')->get();
        $years = Year::where('status',1)->orderBy('id','desc')->get();
        $sections = Section::where('status',1)->orderBy('id','desc')->get();
        $teachers = Teacher::where('status',1)->orderBy('last_name','desc')->get();

         $schedules = schedule::with(['subject','year','section','teacher'])
        ->withCount('list')

        ->orderBy('id','desc')
        ->get();

        return view('admin.schedule.index', compact(
            'subjects',
            'years',
            'sections',
            'schedules',
            'teachers',
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
        $request->validate([
            'section_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'year_id' => 'required',
            'day' => 'required',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at',
        ]);

        $conflict = Schedule::where('section_id', $request->section_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('day', $request->day)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_at', [$request->start_at, $request->end_at])
                      ->orWhereBetween('end_at', [$request->start_at, $request->end_at])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_at', '<=', $request->start_at)
                            ->where('end_at', '>=', $request->end_at);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['error' => 'Schedule conflict! The time slot is already taken.']);
        }

        Schedule::create($request->all());

        return redirect()->back()->with('success', 'Schedule added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {

        $schedule = Schedule::where('id', $schedule->id)
            ->with(['list.student','subject', 'year', 'section', 'teacher'])

            ->firstOrFail();


        $subjects = Subject::all();
        $years = Year::all();
        $sections = Section::all();
        $teachers = Teacher::all();

        return view('admin.schedule.show', compact(
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
        $request->validate([
            'section_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'year_id' => 'required',
            'day' => 'required',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at',
        ]);

        // Check for schedule conflicts excluding the current schedule
        $conflict = Schedule::where('section_id', $request->section_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('day', $request->day)
            ->where('id', '!=', $schedule->id) // Exclude current schedule from conflict check
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_at', [$request->start_at, $request->end_at])
                      ->orWhereBetween('end_at', [$request->start_at, $request->end_at])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_at', '<=', $request->start_at)
                            ->where('end_at', '>=', $request->end_at);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['error' => 'Schedule conflict! The time slot is already taken.']);
        }

        // Update the schedule record
        $schedule->update([
            'section_id' => $request->section_id,
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'year_id' => $request->year_id,
            'day' => $request->day,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return redirect()->back()->with('success', 'Schedule has been updated.');
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
