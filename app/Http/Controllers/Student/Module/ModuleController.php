<?php

namespace App\Http\Controllers\Student\Module;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\ModuleList;
use App\Models\ModuleListStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Utils\AuthStudent;
use Illuminate\Support\Facades\Storage;

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


        // Find the related records
        $moduleList = ModuleList::find($request->module_list_id);
        $module = Module::find($request->module_id);
        $auth = AuthStudent::get(); // Assuming authentication for students

        // Validate if the records exist
        if (!$moduleList || !$module || !$auth) {
            return redirect()->back()->with('error', 'Invalid data provided.');
        }

        // Find the student record in `module_list_students`
        $moduleListStudent = ModuleListStudent::where([
            ['module_list_id', $moduleList->id],
            ['module_id', $module->id],
            ['student_id', $auth->id]
        ])->first();

        // If no record exists, return an error
        if (!$moduleListStudent) {
            return redirect()->back()->with('error', 'Student record not found.');
        }

        if (!$request->hasFile('file')) {
            return redirect()->back()->with('error', 'File must be not empty.');
        }

            $path = $request->file('file')->store('public/student');
            $moduleListStudent->update([
            'status' => 2,
            'file' => $path
        ]);

        return redirect()->back()->with('success', 'Module updated successfully!');
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
    public function update(Request $request, ModuleListStudent $module)
    {


        if (!$request->hasFile('file')) {
            return redirect()->back()->with('error', 'File must not be empty.');
        }


        if (Storage::exists($module->file)) {
            Storage::delete($module->file);
        }


        $path = $request->file('file')->store('public/student');

        $module->update([
            'status' => 2,
            'file' => $path
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
