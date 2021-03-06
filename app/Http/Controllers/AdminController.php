<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AdminController extends Controller
{
    public function category(){
        return view('category');
    }

    public function department(){
        return view('department');
    }

    public function users(){
        return view('users');
    }

    public function location(){
        if (Auth::user()->can('isSadmin')) {
            return view('location');
        } else {
            return redirect('/dashboard');
        }
    }

    public function loghorizon(){
        if (Auth::user()->can('isDeveloper')) {
            $horizon = DB::table('activity_log')->join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('users.name as name', 'activity_log.description as description', 'activity_log.created_at as time')
            ->orderby('activity_log.created_at', 'desc')->limit(300)->get();
        } else {
            $horizon = DB::table('activity_log')->join('users', 'users.id', '=', 'activity_log.causer_id')
            ->select('users.name as name', 'activity_log.description as description', 'activity_log.created_at as time')
            ->where('users.role', '!=' ,'developer')
            ->orderby('activity_log.created_at', 'desc')->limit(300)->get();
        }
        return view('sessions', ['logs' => $horizon]);
    }
    public function emailhorizon(){
        $horizon = DB::table('email_job')->where('condition', '>', 0)->orderby('condition', 'desc')->limit(300)->get();
        return view('emailsessions', ['logs' => $horizon]);
    }
}
