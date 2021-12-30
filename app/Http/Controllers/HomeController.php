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

    public function detail($id){
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

    public function catdrop(Request $request)
    {
        $data = DB::table('category')->where('location', $request->get('loc'))->pluck('id', 'desc');
        return response()->json($data);
    }

    public function documenttype($id){
        $type = 0;
        return view('document', ['condition' => $type]);
    }
}
