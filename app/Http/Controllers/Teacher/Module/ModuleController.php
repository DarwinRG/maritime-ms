<?php

namespace App\Http\Controllers\Teacher\Module;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ScheduleStudent;
use App\Utils\AuthTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Illuminate\Support\Facades\DB;


class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        // Validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'end_date' => 'required|date',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::transaction(function () use ($request) {
            // Create the module
            $module = Module::create([
                'title' => $request->title,
                'schedule_id' => $request->schedule_id,
                'end_at' => Carbon::parse($request->end_date),
                'description' => $request->description,
            ]);




                $emailContent = "New Module Created\n\n";
                $emailContent .= "Title: {$module->title}\n";
                $emailContent .= "Description: {$module->description}\n";
                $emailContent .= "End Date: {$module->end_at->format('F d, Y')}\n";


                $students = ScheduleStudent::where('schedule_id', $request->schedule_id)->get();
                $teacher = AuthTeacher::get();

                foreach ($students as $student) {
                    if ($student->student->user->email) {
                        Mail::raw($emailContent, function ($message) use ($student, $module ,$teacher) {
                            $message->from($teacher->user->email)
                            ->to($student->student->user->email)
                            ->subject('New Module Created: ' . $module->title);
                        });

                        sleep(4);
                    }
                }
        });

        return redirect()->back()->with('success', 'Module added successfully and emails sent to students!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'end_date' => 'required|date',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $module->update([
            'title' => $request->title,
            'end_at' => Carbon::parse($request->end_date),
            'description' => $request->description,
            'status'=>$request->status,
        ]);

        return redirect()->back()->with('success', 'Module updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        // $scheduleModule->update(['status'=>0]);
        $module->delete();
        return redirect()->back()->with('danger','Activity has been archive');
    }
}
