<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Dashboardtable extends Component
{
    public $valid;
    public $pending;
    public $ongoing;
    public $wating;
    public $deactive;
    
    public function render()
    {
        if (Auth::user()->role == 'developer') {
            $this->valid    = DB::table('document')->where('statusdoc', 1)->count();
            $this->pending  = DB::table('document')->where('statusdoc', 2)->count();
            $this->ongoing  = DB::table('document')->where('statusdoc', 3)->count();
            $this->wating   = DB::table('document')->where('statusdoc', 4)->count();
            $this->deactive = DB::table('document')->where('statusdoc', 0)->count();
        } elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'sadmin') {
            $location       = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->valid    = DB::table('document')->where('location', $location)->where('statusdoc', 1)->count();
            $this->pending  = DB::table('document')->where('location', $location)->where('statusdoc', 2)->count();
            $this->ongoing  = DB::table('document')->where('location', $location)->where('statusdoc', 3)->count();
            $this->wating   = DB::table('document')->where('location', $location)->where('statusdoc', 4)->count();
            $this->deactive = DB::table('document')->where('location', $location)->where('statusdoc', 0)->count();
        } elseif (Auth::user()->role == 'manager'){
            $location       = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->valid    = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 1)->count();
            $this->pending  = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 2)->count();
            $this->ongoing  = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 3)->count();
            $this->wating   = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 4)->count();
            $this->deactive = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 0)->count();
        } elseif (Auth::user()->role == 'pic'){
            $location       = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->valid    = DB::table('document')->where('pic', Auth::user()->id)->where('statusdoc', 1)->count();
            $this->pending  = DB::table('document')->where('pic', Auth::user()->id)->where('statusdoc', 2)->count();
            $this->ongoing  = DB::table('document')->where('pic', Auth::user()->id)->where('statusdoc', 3)->count();
            $this->wating   = DB::table('document')->where('pic', Auth::user()->id)->where('statusdoc', 4)->count();
            $this->deactive = DB::table('document')->where('pic', Auth::user()->id)->where('statusdoc', 0)->count();
        } elseif (Auth::user()->role == 'user'){
            $location       = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->valid    = DB::table('document')->where('creator', Auth::user()->id)->orWhere('pic', Auth::user()->id)->where('statusdoc', 1)->count();
            $this->pending  = DB::table('document')->where('creator', Auth::user()->id)->orWhere('pic', Auth::user()->id)->where('statusdoc', 2)->count();
            $this->ongoing  = DB::table('document')->where('creator', Auth::user()->id)->orWhere('pic', Auth::user()->id)->where('statusdoc', 3)->count();
            $this->wating   = DB::table('document')->where('creator', Auth::user()->id)->orWhere('pic', Auth::user()->id)->where('statusdoc', 4)->count();
            $this->deactive = DB::table('document')->where('creator', Auth::user()->id)->orWhere('pic', Auth::user()->id)->where('statusdoc', 0)->count();
        }
        return view('livewire.dashboardtable');
    }
}
