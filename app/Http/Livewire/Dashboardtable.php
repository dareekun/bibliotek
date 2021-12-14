<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Dashboardtable extends Component
{

    public $documents = [];
    
    public function render()
    {
        if (Auth::user()->role == 'developer') {
            DB::table('document')->get();
        } elseif(Auth::user()->role == 'admin') {
            $location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            DB::table('document')->where('location', $location)->get();
        } else {
            $location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            DB::table('document')->where('location', $location)->where('pic', Auth::user()->id)->get();
        }
        return view('livewire.dashboardtable');
    }
}
