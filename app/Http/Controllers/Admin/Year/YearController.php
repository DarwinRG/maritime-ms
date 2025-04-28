<?php

namespace App\Http\Controllers\Admin\Year;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = year::query();
        if ($request->search) {
            $categories = $categories->where('name', 'like', '%' . $request->search . '%');
        }

        $categories = $categories->where('status',1)->orderBy('id','desc')->paginate(10);

        return view('admin.year.index', compact('categories'));
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

        year::create($request->all());
        return redirect()->back()->with('success','year has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, year $year)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('years')->ignore($year->id),
            ],
        ]);

        $year->update($request->only('name'));

        return redirect()->back()->with('success', 'year has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(year $program)
    {
        $program->update(['status'=>0]);
        return redirect()->back()->with('danger','year has been archive');
    }
}
