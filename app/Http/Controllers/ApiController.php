<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\InternalSender;
use Illuminate\Support\Facades\Mail;
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

    public function changestatus(){
        $document = DB::table('document')->where('statusdoc', '>', 0)->get();
        foreach($document as $dcm) {
            if (strtotime('now') >= strtotime($dcm->expireddate)) {
                DB::table('document')->where('id', $dcm->id)->update([
                    'statusdoc' => 0
                ]);
                DB::table('email_job')->insert([
                    'refer' => $dcm->id,
                    'status' => 0,
                    'condition' => 0,
                ]);
            } elseif (strtotime('now') >= strtotime($dcm->expireddate.'-'.$dcm->reminder.' days') && $dcm->statusdoc == 1){
                DB::table('document')->where('id', $dcm->id)->update([
                    'statusdoc' => 2
                ]);
            }
        }
    }

    public function queryjob(){
        $document = DB::table('document')->where('statusdoc', '>', 1)->get();
        foreach($document as $dcm) {
            if (strtotime($dcm->expireddate.'-7 days') <= strtotime('now') && strtotime('now') < strtotime($dcm->expireddate)){
                DB::table('email_job')->insert([
                    'refer' => $dcm->id,
                    'condition' => 0,
                ]);
            }
            elseif (strtotime($dcm->expireddate.'-28 days') == strtotime('now') || strtotime($dcm->expireddate.'-21 days') == strtotime('now') || strtotime($dcm->expireddate.'-14 days') == strtotime('now')){
                DB::table('email_job')->insert([
                    'refer' => $dcm->id,
                    'condition' => 0,
                ]);
            } 
            elseif (strtotime($dcm->expireddate.'-'.$dcm->reminder.' days') <= strtotime('now') && strtotime($dcm->expireddate.'-30 days') >= strtotime('now')) {
                for($i = $dcm->reminder; $i >= 30; $i=$i-30)
                {
                    if(strtotime($dcm->expireddate.'-'.$i.' days') == strtotime('now')){
                        DB::table('email_job')->insert([
                            'refer' => $dcm->id,
                            'condition' => 0,
                        ]);
                    }
                    else {
                        // Do Nothing
                    }
                }
            }
        };
    }

    public function sendjob(){
        $records = DB::table('email_job')->join('document', 'document.id', '=', 'email_job.refer')->get();
        foreach ($records as $rcds) {
            $cc  = DB::table('notify')->where('refer', $rcds->refer)->join('users', 'users.id', '=', 'notify.user')->pluck('users.email');
            $mst = DB::table('users')->where('id', $rcds->creator)->value('email');
            $pic = DB::table('users')->where('id', $rcds->pic)->value('email');
            $nma = DB::table('users')->where('id', $rcds->pic)->value('name');
            $ndc = DB::table('history')->where('refer', $rcds->refer)->orderBy('id', 'desc')->limit(1)->value('code');
            $mgr = DB::table('users')->where('role', 'manager')->where('department', $rcds->department)->limit(1)->value('email');
            array_push($cc, $mgr);
            array_push($cc, $mst);
            $cc  = array_filter($cc);
            Mail::to($pic)
            ->cc($cc)
            ->queue(new InternalSender($rcds->refer, $name, $rcds->category, $rcds->expireddate, $ndc));
        }
    }
}
