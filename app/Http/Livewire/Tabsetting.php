<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Tabsetting extends Component
{
    public $settings  =[];
    public $locations =[];
    public $input1;
    public $input2;
    public $name;
    Public $value;
    public $location;

    public function edit($id){
        if(DB::table('setting')->where('status', 1)->doesntExist()){
            DB::table('location')->where('id', $id)->update([
                'status' => 1
            ]);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        }
    }

    public function save($id, $index){
        if(DB::table('setting')->where('id', '!=', $id)->where('name', $this->settings[$index]['name'])->where('location', $this->settings[$index]['location'])->doesntExist()) {   
            DB::table('setting')->where('id', $id)->update([
                'name'     => $this->categorys[$index]['name'],
                'value'    => $this->settings[$index]['value'],
                'location' => $this->categorys[$index]['location'],
                'status'   => 0,
            ]);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Setting data changed successfully', 'color' => '#28a745', 'title' => 'Change Setting data']);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Setting Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function delete($id){
        $this->name     = DB::table('setting')->where('id', $id)->value('name');
        $this->value    = DB::table('setting')->where('id', $id)->value('value');
        $this->location = DB::table('location')->where('id', $id)->value('desc');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#deletesetting']);
    }

    public function submit(){
        if(DB::table('setting')->where('name', $this->input1)->where('location', $this->input2)->doesntExist()) {   
            DB::table('setting')->insert([
                'name'     => $this->input1,
                'value'    => 0,
                'location' => $this->input2,
                'status'   => 0,
            ]);
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addsetting']);
            $this->input1 = '';
            $this->input2 = '';
            $this->dispatchBrowserEvent('toaster', ['message' => 'Setting data changed successfully', 'color' => '#28a745', 'title' => 'Change Setting data']);
        } else {
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addsetting']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Setting Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function confirm(){
        DB::table('setting')->where('name', $this->name)->where('location', $this->location)->delete();
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addlocation']);
        $this->name     = '';
        $this->value    = '';
        $this->location = '';
        $this->dispatchBrowserEvent('toaster', ['message' => ucwords($this->modaltittle).' remove successfully', 'color' => '#28a745', 'title' => 'Delete successfull']);
        
    }

    public function render()
    {
        $this->settings  = DB::table('setting')->join('location', 'location.id', '=', 'setting.location')
        ->select('setting.id as id', 'setting.name as name', 'setting.value as value', 'setting.status as status', 'location.desc as location')
        ->get();
        $this->locations = DB::table('location')->get();
        return view('livewire.tabsetting');
    }
}
