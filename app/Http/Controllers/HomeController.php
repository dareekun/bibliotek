<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use App\Mail\InternalSender;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

use Auth;

class HomeController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function detail($id){
        return view('detaildocument', ['refer' => $id]);
    }

    public function forgot_password(){
        return view('auth.forgot-password');
    }

    public function password_reset(Request $request) {
        //Check if the user exists
        if (DB::table('users')->where('nik', '=', $request->nik)->doesntExist()) {
        return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        } else {
            //Create Password Reset Token
            DB::table('password_resets')->updateOrInsert ([
            'email' => $request->nik],[
            'token' => Str::random(60),
            'created_at' => Carbon::now()
            ]);
            //Get the token just created above
            $tokenData = DB::table('password_resets')
            ->where('email', $request->nik)->first();
            $email = DB::table('users')->where('nik', $request->nik)->value('email');
            
            try {
                Mail::to($email)->queue(new ResetPassword($request->nik,$tokenData->token));
                return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
                }
        }
    }

    public function password_update(Request $request){
        $validator = Validator::make($request->all(), [
            'nik' => 'required|exists:users,nik',
            'password' => 'required|min:6',
            'token' => 'required']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['password' => 'Password minimal 6 character']);
        }

        $nik = DB::table('password_resets')->where('token', $request->token)->value('email');
        if ($request->password == $request->password_confirmation) {
            DB::table('users')->where('nik', $nik)->update([
                'password' => bcrypt($request->password)
            ]);
            DB::table('password_resets')->where('token', $request->token)->delete();
            return redirect('/login')->with('status', trans('Password successfully changed. Please login'));
        } else {
            return redirect()->back()->withErrors(['password' => trans('Password missmatch')]);
        }
    }

    public function test($id){
        // $temp = [];
        // $data = DB::table('notify')->where('refer', $id)->get();
        // foreach ($data as $nft){
        //     $nano = [];
        //     array_push($nano, $nft->id);
        //     array_push($nano, $nft->user);
        //     array_push($temp, $nano);
        // }
        // unset($temp[1]);
        // $temp  = array_values($temp);
        // return $temp;
        return 'pancen oye - '.$id;
        // Mail::to('mada.baskoro@mli.panasonic.co.id')
        //     ->cc('madabaskoro@yahoo.com')
        //     ->queue(new InternalSender($id, 'manuk', 'asuransi jiwa', date('now'), 'test'));
        // return 'mail';
    }

    public function reset_password($token){
        if (DB::table('password_resets')->where('token', $token)->exists()) {
            $time = DB::table('password_resets')->where('token', $token)->value('created_at');
            if ((strtotime($time) + 7200) >= time()) {
                $nik  = DB::table('password_resets')->where('token', $token)->value('email');
                return view('auth.reset-password', ['nik' => $nik, 'token' => $token]);
            } else {
                return view('auth.expires');
            }
        } else {
            return view('auth.expires');
        }
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