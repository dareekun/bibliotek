<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function document($id){
        return view('detaildocument');
    }

    public function test(){
        return Auth::user()->role;
    }
}
