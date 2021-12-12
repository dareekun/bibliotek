<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;

class ApiController extends Controller
{
    public function datauser(){
        if (Auth::user()->role == 'developer') {
            $data = DB::table('users')->select('nik', 'name', 'email', 'department', 'role')->get();
        } else { 
            $data = DB::table('users')
            ->select('nik', 'name', 'email', 'department', 'role')->where('role', '<>' ,'developer')->get();
        }
        return Datatables::of($data)->make(true);
    }
    public function datadepartment(){
        if (Auth::user()->role == 'developer') {
            $data = DB::table('department')->select('code', 'department', 'location')->get();
        } else { 
            $loca = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $data = DB::table('department')->select('id', 'code', 'department', 'location')->where('location', $loca)->get();
        }
        return Datatables::of($data)->make(true);
    }
}
