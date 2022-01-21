<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use App\Mail\InternalSender;
use Illuminate\Support\Facades\Mail;

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
        return 'pancen oye';
        // Mail::to('mada.baskoro@mli.panasonic.co.id')
        //     ->cc('madabaskoro@yahoo.com')
        //     ->queue(new InternalSender('test', 'manuk', 'asuransi jiwa', date('now'), 'test'));
        // return 'mail';
    }

    public function newdocument(){
        return view('newdocument');
    }

    public function catdrop(Request $request)
    {
        $data = DB::table('category')->where('location', $request->get('loc'))->pluck('id', 'desc');
        return response()->json($data);
    }
    
    public function subcatdrop(Request $request)
    {
        $data = DB::table('subcategory')->where('cat', $request->get('cat'))->pluck('id', 'desc');
        return response()->json($data);
    }

    public function documenttype($id){
        $array = ['deactive', 'valid', 'pending', 'ongoing', 'waiting'];
        $type  = array_search($id, $array);
        return view('document', ['value' => $type]);
    }
}
