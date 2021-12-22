<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Tabsetting extends Component
{
    public $locations = [];
    public $statusloc = [];
    public $inputloc;
    public $input1;
    public $input2;
    public $referid;
    public $tulisan;
    public $referdesc;
    public $modaltittle;
    public $countloc;

    public function submitloc(){
        if (DB::table('location')->where('desc', $this->inputloc)->doesntExist()) {
            DB::table('location')->insert([
                'desc' => $this->inputloc,
            ]);
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addlocation']);
            $this->inputloc = '';
            $this->dispatchBrowserEvent('toaster', ['message' => 'Location added successfully', 'color' => '#28a745', 'title' => 'Success Add Location']);
        } else {
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addlocation']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function editloc($id){
        if (in_array(1, $this->statusloc)) {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        } else {
            $this->statusloc[$id] = 1;
        }
    }

    public function cancelloc($id){
        $this->statusloc[$id] = 0;
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

    public function render()
    {
        $this->settings  = DB::table('setting')->join('location', 'location.id', '=', 'setting.location')
        ->select('setting.id as id', 'setting.name as name', 'setting.value as value', 'location.desc as location')
        ->get();
        $this->locations  = DB::table('location')->get();
        for ($i = 0; $i < count($this->locations); $i++) {
            array_push($this->statusloc, 0);
        }
        return view('livewire.tabsetting');
    }
}
