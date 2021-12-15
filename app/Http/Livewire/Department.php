<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Department extends Component
{
    public $departments = [];
    public $locations = [];
    public $search;
    public $deletedepart;
    public $inputcode;
    public $inputname;
    public $inputloc;
    public $location;

    public $deleteid;
    public $deletecode;
    public $deletedpt;


    public function delete($id)
    {
        
        $this->deleteid   = $id;
        $this->deletecode = DB::table('department')->where('id', $id)->value('code');
        $this->deletedpt  = DB::table('department')->where('id', $id)->value('department');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#deletedpt']);
    }

    public function confirm()
    {
        DB::table('department')->where('id', $this->deleteid)->delete();
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#deletedpt']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Department Data Deleted Successfully', 'color' => '#dc3545', 'title' => 'Delete Department']);
    }

    public function submit()
    {
        if (DB::table('department')->where('code', $this->inputcode)->doesntExist()) {
            if (Auth::user()->role == 'developer') {
                DB::table('department')->insert([
                    'code' => $this->inputcode,
                    'department' => $this->inputname,
                    'location' => $this->inputloc,
                ]);
            } else {
                $this->location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
                DB::table('department')->insert([
                    'code' => $this->inputcode,
                    'department' => $this->inputname,
                    'location' => $this->location,
                ]);
            }
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#exampleModal']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Department Added Successfully', 'color' => '#28a745', 'title' => 'Add Department']);
            $this->inputcode = ''; 
            $this->inputname = '';
            $this->inputloc  = '';
        } else {
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#exampleModal']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Data Department', 'color' => '#dc3545', 'title' => 'Duplicate Department']);
        }
    }

    public function save($tag, $ind){
        $copycode  = DB::table('department')->where('id', $tag)->value('code');
        if ($copycode == $this->departments[$ind]['code']) {
            if (Auth::user()->role == 'developer'){
                $location = $this->departments[$ind]['location'];
            }else {
                $location = DB::table('department')->where('id', $tag)->value('location');
            }
            DB::table('department')->where('id', $tag)->update([
                'department' => $this->departments[$ind]['department'],
                'location' => $location,
                'status' => 0,
            ]);
        } else {
            if (DB::table('department')->where('id', '<>' ,$tag)->where('code', $this->departments[$ind]['code'])->exists()) {
                $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Data Department', 'color' => '#dc3545', 'title' => 'Duplicate Department']);
            } else {
                if (Auth::user()->role == 'developer'){
                    $location = $this->departments[$ind]['location'];
                }else {
                    $location = DB::table('department')->where('id', $tag)->value('location');
                }
                DB::table('department')->where('id', $tag)->update([
                    'code' => $this->departments[$ind]['code'],
                    'department' => $this->departments[$ind]['department'],
                    'location' => $location,
                    'status' => 0,
                ]);
            }
        }
        
    }

    public function edit($id){
        if (DB::table('department')->where('status', $id)->doesntExist()) {
            DB::table('department')->where('id', $id)->update([
                'status' => 1,
            ]);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        }
    }
    
    public function render()
    {
        if (Auth::user()->role == 'developer') {
            $this->departments = DB::table('department')->get();
            $this->locations = DB::table('location')->get();
        } else {
            $this->location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->departments = DB::table('department')->where('location', $this->location)->get();
        }
        return view('livewire.department');
    }
}
