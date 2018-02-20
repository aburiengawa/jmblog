<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (auth()->user()->role_id !== 3) {
        //     return view('admin.index');
        // } else {
        //     return redirect('/');
        // }
        return view('admin.index');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/admin');
    }

}
