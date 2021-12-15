<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Dashboardtable extends Component
{
    public $documents = [];
    public $green;
    public $yellow;
    public $red;
    
    public function render()
    {
        if (Auth::user()->role == 'developer') {
            DB::table('document')->get();
            $this->green = DB::table('document')->count();
            $this->yellow = DB::table('document')->where('statusdoc', 2)->count();
            $this->red = DB::table('document')->where('statusdoc', 3)->count();
        } elseif(Auth::user()->role == 'admin') {
            $location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            DB::table('document')->where('location', $location)->get();
            $this->green = DB::table('document')->where('location', $location)->count();
            $this->yellow = DB::table('document')->where('location', $location)->where('statusdoc', 2)->count();
            $this->red = DB::table('document')->where('location', $location)->where('statusdoc', 3)->count();
        } else {
            $location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            DB::table('document')->where('location', $location)->where('pic', Auth::user()->id)->get();
            $this->green = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->count();
            $this->yellow = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 2)->count();
            $this->red = DB::table('document')->where('location', $location)->where('department', Auth::user()->department)->where('statusdoc', 3)->count();
        }
        return view('livewire.dashboardtable');
    }
}
