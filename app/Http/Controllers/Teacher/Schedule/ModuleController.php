<?php

namespace App\Http\Controllers\Teacher\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleList;
use App\Models\ModuleListStudent;
use App\Models\ScheduleStudent;
use App\Utils\AuthTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.module.index');
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


        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required',
            'module_is'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::transaction(function () use($request){
            $moduleList = ModuleList::create([
                'title' => $request->title,
                'points' => $request->points,
                'module_is'=>$request->module_is,
                'start_at' => Carbon::parse($request->start_date),
                'end_at' => Carbon::parse($request->end_date),
                'description' => $request->description,
                'module_id' => $request->module_id,
            ]);

            foreach (ScheduleStudent::where('schedule_id',$request->schedule_id)->get() as $value) {
                    ModuleListStudent::create([
                        'module_list_id' => $moduleList->id,
                        'module_id' => $request->module_id,
                        'student_id' => $value->student_id,
                    ]);


                    $emailContent = "
                    <h2>New Module List Assigned</h2>
                    <p><strong>Title:</strong> {$moduleList->title}</p>
                    <p><strong>Description:</strong> {$moduleList->description}</p>
                    <p><strong>Start Date:</strong> {$moduleList->start_at->format('F d, Y')}</p>
                    <p><strong>End Date:</strong> {$moduleList->end_at->format('F d, Y')}</p>
                ";

                $teacher = AuthTeacher::get();
                if ($value->student->user->email) {

                    Mail::raw($emailContent, function ($message) use ($value, $moduleList,$teacher) {
                        $message->from($teacher->user->email)
                                ->to($value->student->user->email)
                                ->subject('New Module List Assigned: ' . $moduleList->title);
                        });


                    sleep(4);
                }
            }
        });

        return redirect()->back()->with('success', 'Schedule added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Module $scheduleModule)
    {

           $module = Module::whereHas('list',function($query){
            $query->whereNotIn('status',[0]);
         })->where('id',$scheduleModule->id)
         ->with(['list.activity','list'=>function($query){
            $query->withCount('activity');
         }])
        ->first();

        return view('teacher.module.show',compact('module','scheduleModule'));
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
        $validator = Validator::make($request->all(), [
            // 'points' => 'required|integer',
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the existing record
        $module = ModuleList::findOrFail($id);

        // Update the record
        $module->update([
            'title' => $request->title,
            'points' => $request->points,
            'module_is'=>$request->module_is,
            'start_at' => Carbon::parse($request->start_date),
            'end_at' => Carbon::parse($request->end_date),
            'description' => $request->description,
            'module_id' => $request->module_id,
            'status'=>$request->status,
        ]);

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModuleList $scheduleModule)
    {
        // $scheduleModule->update(['status'=>0]);
        $scheduleModule->delete();
        return redirect()->back()->with('danger','Activity has been archive');
    }
}
