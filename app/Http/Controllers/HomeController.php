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
        return view('detaildocument', ['refer' => $id]);
    }

    public function test(){
        $data = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        $category   = DB::table('category')->where('location', $data)->get();
        return $category;
    }

    public function newdocument(){
        return view('newdocument');
    }
}
