<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
