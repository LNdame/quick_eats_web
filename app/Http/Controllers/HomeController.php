<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware(['auth','verified']);    }

    }


    /**
     * Show the application dashboard.
     *

     * @return \Illuminate\View\View
     */
    public function index()
    {
//        dd();
        $user = Auth::user();
        $role = $user->roles[0];
        if($role->name=='admin'){
            return view('dashboard');
        }else if($role->name=='student'){
            return view('student-dashboard');
        }else if($role->name=='vendor'){
            return view('vendor-dashboard');
        }

    }
}
