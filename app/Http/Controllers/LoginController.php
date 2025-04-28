<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function index()
    {
        return view('guest.login.index');
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


        config(['app.timezone' => 'Asia/Manila']);

        $input = $request->all();

        Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);



        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {

            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard.index');
                case 'teacher':
                    return redirect()->route('teacher.dashboard.index');
                case 'student':
                        return redirect()->route('student.dashboard.index');
                default:
                    abort(403);
            }
        }else{

                return redirect()->back()
                ->with('warning','Email and Password Invalid. Please try again!');
        }

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
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
