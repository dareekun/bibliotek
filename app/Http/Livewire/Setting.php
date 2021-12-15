<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Setting extends Component
{

    public $categorys = [];
    public $locations = [];
    public $inputremind;
    public $inputloc;
    public $input1;
    public $input2;
    public $referid;
    public $tulisan;
    public $referdesc;
    public $modaltittle;
    public $countloc;

    public function submitcat(){
        if(Auth::user()->role == 'developer') {
            $location =  $this->input2;
        } else {
            $location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        }
        if (DB::table('category')->where('desc', $this->input1)->where('location', $location)->doesntExist()) {
        DB::table('category')->insert([
            'desc' => $this->input1,
            'location' => $location,
            'status' => 0
        ]);
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addcategory']);
        $this->input1 = '';
        $this->input2 = '';
        $this->dispatchBrowserEvent('toaster', ['message' => 'Location added successfully', 'color' => '#28a745', 'title' => 'Add User']);
        } else {
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addcategory']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function submitloc(){
        if (DB::table('location')->where('desc', $this->inputloc)->doesntExist()) {
            DB::table('location')->insert([
                'desc' => $this->inputloc,
                'status' => 0,
            ]);
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addlocation']);
            $this->inputloc = '';
            $this->dispatchBrowserEvent('toaster', ['message' => 'Location added successfully', 'color' => '#28a745', 'title' => 'Success']);
        } else {
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addlocation']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function editloc($id){
        if (DB::table('location')->where('status', 1)->doesntExist() || DB::table('category')->where('status', 1)->doesntExist()) {
            DB::table('location')->where('id', $id)->update([
                'status' => 1
            ]);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        }
    }

    public function editcat($id){
        if (DB::table('category')->where('status', 1)->doesntExist() || DB::table('location')->where('status', 1)->doesntExist() ) {
            DB::table('category')->where('id', $id)->update([
                'status' => 1
            ]);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        }
    }

    public function saveloc($id, $index){
        if(DB::table('location')->where('id', '!=', $id)->where('desc', $this->locations[$index]['desc'])->doesntExist()) {
            DB::table('location')->where('id', $id)->update([
                'desc' => $this->locations[$index]['desc'],
                'status' => 0,
            ]);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Location data changed successfully', 'color' => '#28a745', 'title' => 'Change location data']);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function savecat($id, $index){
        if(DB::table('category')->where('id', '!=', $id)->where('desc', $this->locations[$index]['desc'])->doesntExist()) {
            if(Auth::user()->role == 'developer') {
                DB::table('category')->where('id', $id)->update([
                    'desc'     => $this->categorys[$index]['desc'],
                    'location' => $this->categorys[$index]['location'],
                    'status'   => 0,
                ]);  
            } else {
                DB::table('category')->where('id', $id)->update([
                    'desc'     => $this->categorys[$index]['desc'],
                    'status'   => 0,
                ]);  
            }            
            $this->dispatchBrowserEvent('toaster', ['message' => 'Location data changed successfully', 'color' => '#28a745', 'title' => 'Change location data']);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function deletecat($id){
        $this->modaltittle = 'category';
        $this->referid     = $id;
        $this->tulisan     = 'Are You sure want to delete this category?';
        $this->referdesc   = DB::table('category')->where('id', $id)->value('desc');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#delete']);
    }

    public function deleteloc($id){
        $this->modaltittle = 'location';
        $this->referid     = $id;
        $this->tulisan     = 'Are You sure want to delete this location?';
        $this->referdesc   = DB::table('location')->where('id', $id)->value('desc');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#delete']);
    }

    public function confirm(){
        DB::table($this->modaltittle)->where('id', $this->referid)->delete();
        $this->modaltittle = '';
        $this->referid     = '';
        $this->tulisan     = '';
        $this->referdesc   = '';
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#delete']);
        $this->dispatchBrowserEvent('toaster', ['message' => ucwords($this->modaltittle).' remove successfully', 'color' => '#28a745', 'title' => 'Delete successfull']);
        
    }

    public function update(){
        $location  = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        DB::table('setting')->updateOrInsert(
        ['name' => 'remindays', 'location' => $location],
        ['value' => $this->inputremind]);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Value Save successfully', 'color' => '#28a745', 'title' => 'Save successfull']);
    }

    public function render()
    {
        $location          = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        $this->inputremind = DB::table('setting')->where('name', 'remindays')->where('location', $location)->value('value');
        if (Auth::user()->role == 'developer') {
            $this->categorys  = DB::table('category')->get();
            $this->locations  = DB::table('location')->get();
        } else {
        $this->category   = DB::table('category')->where('location', $location)->get();
        $this->setreminds = DB::table('location')->leftjoin('setting', 'location.id', '=', 'setting.location')->where('locations.id', $location)->where('setting.name', 'remindays')->get();
        }
        return view('livewire.setting');
    }
}