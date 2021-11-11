<?php

namespace App\Http\Controllers\Admin;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        $user = Auth::user();
        $user_roles_arr = $user->roles->toArray();
        if($user_roles_arr[0]['id'] ==3 ){
            return view('student-home');
        }elseif ($user_roles_arr[0]['id'] ==7 ){
            $lectures = Lecture::where('date','>',date("Y/m/d"))->orderBy('date', 'ASC')->get();
            $all_lectures = $lectures->toArray();
            return view('visitor-home', compact('all_lectures'));
        }else{
            return view('home');
        }
    }
}
