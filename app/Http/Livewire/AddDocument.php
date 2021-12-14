<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Auth;

class AddDocument extends Component
{
    use WithFileUploads;

    public $count = 1;
    public $pin = [];
    public $users = [];
    public $nodoc;
    public $createdate;
    public $expiredate;
    public $reminder;
    public $file;
    public $remark;


    public function plus(){
        if ($this->count < 5) {
            $this->count++;
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Maximal Notification 5 Person', 'color' => '#dc3545', 'title' => 'Email Limit']);
        }
    }

    public function minus($array){
        unset($this->pin[$array]); 
        $this->pin = array_values($this->pin);
        $this->count--;
    }

    public function submit()
    {
        $this->validate([
            'file' => 'image|max:2048', // 1MB Max
        ]);
 
        $this->photo->store('photos');
    }

    public function render()
    {
        $location    = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        $this->users = DB::table('users')->join('department', 'users.department', '=', 'department.id')
        ->where('department.location', $location)->where('users.role', '<>', 'developer')
        ->select('users.id as id', 'users.nik as nik', 'users.name as name')->get();
        return view('livewire.add-document');
    }
}
