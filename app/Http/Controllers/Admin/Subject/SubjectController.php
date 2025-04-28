<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = subject::query();
        $courses = Course::all();
        if ($request->search) {
            $categories = $categories->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $categories->with('course')->where('status',1)->orderBy('id','desc')->paginate(10);

        return view('admin.subject.index', compact('categories','courses'));
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

        subject::create($request->all());
        return redirect()->back()->with('success','subject has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subject $subject)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('subjects')->ignore($subject->id),
            ],
            'course_id' => 'required',
        ]);

        $subject->update($request->only('name', 'course_id'));

        return redirect()->back()->with('success', 'subject has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(subject $program)
    {
        $program->update(['status'=>0]);
        return redirect()->back()->with('danger','subject has been archive');
    }
}
