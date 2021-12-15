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
        $data = DB::table('location')->leftjoin('setting', 'location.id', '=', 'setting.location')->get();
        return $data;
    }

    public function newdocument(){
        return view('newdocument');
    }
}
