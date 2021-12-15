<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
