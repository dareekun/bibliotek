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
        // $data = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        // $category   = DB::table('category')->where('location', $data)->get();
        // return $category;
        
        $cc  = DB::table('notify')->join('users', 'users.id', '=', 'notify.user')->pluck('users.email')->toArray();
        $mgr = DB::table('users')->where('role', 'manager')->where('department', 2)->limit(1)->value('email');
        array_push($cc, $mgr);
        $cc  = array_filter($cc);
        return $cc;
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
        $array = ['deactive', 'valid', 'pending', 'ongoing', 'waiting'];
        $type  = array_search($id, $array);
        return view('document', ['value' => $type]);
    }
}
