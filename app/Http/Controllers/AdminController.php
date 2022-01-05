<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    public function setting(){
        return view('setting');
    }

    public function department(){
        return view('department');
    }

    public function users(){
        return view('users');
    }

    public function tabsetting(){
        if (Auth::user()->role == 'developer') {
            return view('tabsetting');
        } else {
            return redirect('/dashboard');
        }
    }

    public function loghorizon(){
        $horizon = DB::table('sessions')->join('users', 'users.id', '=', 'sessions.user_id')
        ->orderby('last_activity', 'desc')->limit(10)->get();
        return view('sessions', ['logs' => $horizon]);
    }
}
