<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;
use File;

class AddDocument extends Component
{
    use WithFileUploads;

    public $count = 1;
    public $pin = [];
    public $users = [];
    public $categorys = [];
    public $category;
    public $pic;
    public $title;
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
            'file' => 'max:20480',
        ]);
        $refer     = strtoupper(base_convert(date('YmdHis').sprintf('%02d', rand(1,99)),10,32));
        $location  = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        
        $docname = strtoupper(base_convert(time().sprintf('%02d', rand(1,99)),10,32));
        $this->file->storeAs('docs', $docname.'.pdf');
        if (date('Ymd', strtotime($this->expiredate)) <= date('Ymd')) {
            $statusdoc = 3;
            DB::table('email_job')->insert([
                'refer'     => $refer,
                'condition' => 0
            ]);
        }elseif (date('Ymd', strtotime($this->expiredate.' - '.  $this->reminder. ' days')) < date('Ymd') && (date('Ymd', strtotime($this->expiredate)) > date('Ymd'))) {
            $statusdoc = 2;
            DB::table('email_job')->insert([
                'refer'     => $refer,
                'condition' => 0
            ]);
        } else {
            $statusdoc = 1;
        }
        DB::table('document')->insert([
            'id'          => $refer,
            'pic'         => $this->pic,
            'creator'     => Auth::user()->id,
            'title'       => $this->title,
            'department'  => Auth::user()->department,
            'category'    => $this->category,
            'issuedate'   => $this->createdate,
            'expireddate' => $this->expiredate,
            'reminder'    => $this->reminder,
            'file'        => $docname,
            'remark'      => $this->remark,
            'statusdoc'   => $statusdoc,
            'location'    => $location,
            'status'      => 0,
        ]);
        DB::table('history')->insert([
            'refer'     => $refer,
            'code'      => $this->nodoc,
            'statusdoc' => $statusdoc,
            'status'    => 0,
        ]);
        for ($i = 0; $i < count($this->pin); $i++) {
            DB::table('notify')->insert([
                'refer'  => $refer,
                'user'   => $this->pin[$i],
                'status' => 0
            ]);
        }
        $this->dispatchBrowserEvent('toaster', ['message' => 'Document Added Successfully', 'color' => '#28a745', 'title' => 'Save Successfull']);
        return redirect()->to('/document/'.$refer);
    }

    public function render()
    {
        $location    = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        $this->users = DB::table('users')->join('department', 'users.department', '=', 'department.id')
        ->where('department.location', $location)->where('users.role', '<>', 'developer')
        ->select('users.id as id', 'users.nik as nik', 'users.name as name')->get();
        $this->categorys = DB::table('category')->where('location', $location)->get();
        return view('livewire.add-document');
    }
}
