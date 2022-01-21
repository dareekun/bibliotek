<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Category extends Component
{
    public $categorys = [];
    public $subs      = [];
    public $statuscat = [];
    public $statussub = [];
    public $cats      = [];
    public $input0;
    public $input1;
    public $input2;
    public $referid;
    public $tulisan;
    public $referdesc;
    public $modaltitle;
    public $subloc;
    public $subcat;
    public $subcode;
    public $subdesc;

    public function submitcat(){
        if (DB::table('category')->where('code', $this->input0)->doesntExist()) {
        DB::table('category')->insert([
            'code'     => $this->input0,
            'desc'     => $this->input1,
        ]);
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addcategory']);
        $this->input0 = '';
        $this->input1 = '';
        $this->input2 = '';
        $this->dispatchBrowserEvent('toaster', ['message' => 'Location added successfully', 'color' => '#28a745', 'title' => 'Success Add Category']);
        } else {
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addcategory']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#dc3545', 'title' => 'Duplicate Data']);
        }
    }

    public function submitsubcat(){
        if (DB::table('subcategory')->where('code', $this->input0)->doesntExist()) {
        DB::table('subcategory')->insert([
            'code'     => $this->subcode,
            'cat'      => $this->subcat,
            'desc'     => $this->subdesc,
        ]);
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addsubcategory']);
        $this->subcode = '';
        $this->subcat  = '';
        $this->subdesc = '';
        $this->dispatchBrowserEvent('toaster', ['message' => 'Location added successfully', 'color' => '#28a745', 'title' => 'Success Add Category']);
        } else {
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#addsubcategory']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#dc3545', 'title' => 'Duplicate Data']);
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

    public function editsub($id){
        if (in_array(1, $this->statuscat)) {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        } else {
            $this->statussub[$id] = 1;
        }
    }

    public function cancelsub($id){
        $this->statussub[$id] = 0;
    }

    public function savesub($id, $index){
        if(DB::table('subcategory')->where('id', '!=', $id)->where('code', $this->subs[$index]['code'])->doesntExist()) {
                DB::table('subcategory')->where('id', $id)->update([
                    'code'     => $this->subs[$index]['code'],
                    'cat'      => $this->subs[$index]['cat'],
                    'desc'     => $this->subs[$index]['desc'],
                ]); 
            $this->statussub[$index] = 0;
            $this->dispatchBrowserEvent('toaster', ['message' => 'Sub-Category data changed successfully', 'color' => '#28a745', 'title' => 'Change location data']);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Location Data', 'color' => '#dc3545', 'title' => 'Duplicate Data']);
        }
    }

    public function savecat($id, $index){
        if(DB::table('category')->where('id', '!=', $id)->where('code', $this->categorys[$index]['code'])->doesntExist()) {
            if(Auth::user()->can('isSadmin')) {
                DB::table('category')->where('id', $id)->update([
                    'code'     => $this->categorys[$index]['code'],
                    'desc'     => $this->categorys[$index]['desc'],
                ]);  
            } else {
                DB::table('category')->where('id', $id)->update([
                    'code'     => $this->categorys[$index]['code'],
                    'desc'     => $this->categorys[$index]['desc'],
                ]);  
            }     
            $this->statuscat[$index] = 0;       
            $this->dispatchBrowserEvent('toaster', ['message' => 'Category data changed successfully', 'color' => '#28a745', 'title' => 'Change location data']);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate Category Data', 'color' => '#dc3545', 'title' => 'Duplicate Data']);
        }
    }

    public function deletecat($id){
        $this->modaltitle = 'category';
        $this->referid    = $id;
        $this->tulisan    = 'Are You sure want to delete this category?';
        $this->referdesc  = DB::table('category')->where('id', $id)->value('desc');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#delete']);
    }

    public function deletesub($id){
        $this->modaltitle = 'subcategory';
        $this->referid    = $id;
        $this->tulisan    = 'Are You sure want to delete this location?';
        $this->referdesc  = DB::table('location')->where('id', $id)->value('desc');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#delete']);
    }

    public function confirm(){
        DB::table($this->modaltitle)->where('id', $this->referid)->delete();
        $this->modaltitle = '';
        $this->referid    = '';
        $this->tulisan    = '';
        $this->referdesc  = '';
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#delete']);
        $this->dispatchBrowserEvent('toaster', ['message' => ucwords($this->modaltitle).' remove successfully', 'color' => '#28a745', 'title' => 'Delete successfull']);
        
    }

    public function render()
    {
            $this->categorys  = DB::table('category')
            ->select('category.id as id', 'category.desc as desc', 'category.code as code')
            ->get();
            for ($n = 0; $n < count($this->categorys); $n++) {
                array_push($this->statuscat, 0);
            }
            $this->subs      = DB::table('subcategory')->join('category', 'category.id', '=', 'subcategory.cat')
            ->select('subcategory.id as id', 'subcategory.desc as desc', 'category.desc as cat', 'subcategory.code as code', 'subcategory.cat as catid')
            ->get();
            for ($n = 0; $n < count($this->subs); $n++) {
                array_push($this->statussub, 0);
            }
        return view('livewire.category');
    }
}