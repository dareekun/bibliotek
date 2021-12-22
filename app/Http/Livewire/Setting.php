<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Setting extends Component
{

    public $locations = [];
    public $categorys = [];
    public $statuscat = [];
    public $input1;
    public $input2;
    public $referid;
    public $tulisan;
    public $referdesc;
    public $modaltittle;

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
        ]);
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addcategory']);
        $this->input1 = '';
        $this->input2 = '';
        $this->dispatchBrowserEvent('toaster', ['message' => 'Location added successfully', 'color' => '#28a745', 'title' => 'Success Add Category']);
        } else {
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addcategory']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#28a745', 'title' => 'Duplicate Data']);
        }
    }

    public function editcat($id){
        if (in_array(1, $this->statuscat)) {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        } else {
            $this->statuscat[$id] = 1;
        }
    }

    public function cancelcat($id){
        $this->statuscat[$id] = 0;
    }

    public function saveloc($id, $index){
        if(DB::table('location')->where('id', '!=', $id)->where('desc', $this->locations[$index]['desc'])->doesntExist()) {
            DB::table('location')->where('id', $id)->update([
                'desc' => $this->locations[$index]['desc'],
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
                ]);  
            } else {
                DB::table('category')->where('id', $id)->update([
                    'desc'     => $this->categorys[$index]['desc'],
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
        if (Auth::user()->role == 'developer') {
            $this->categorys  = DB::table('category')->join('location', 'location.id', '=', 'category.location')
            ->select('category.id as id', 'category.desc as desc', 'location.desc as location',)
            ->get();
            for ($n = 0; $n < count($this->categorys); $n++) {
                array_push($this->statuscat, 0);
            }
            $this->locations  = DB::table('location')->get();
        } else {
        $location          = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        $this->categorys   = DB::table('category')->where('location', $location)->get();
        for ($i = 0; $i < count($this->categorys); $i++) {
            array_push($this->statuscat, 0);
        }
        }
        return view('livewire.setting');
    }
}