<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Detaildocument extends Component
{
    public $pass;
    public $notif     = [];
    public $records   = [];
    public $table     = [];
    public $users     = [];
    public $statusdoc = 0; 

    
    public function deactive($id){
    }

    public function editdoc(){
        $this->statusdoc = 1;
    }

    public function canceldoc(){
        $this->statusdoc = 0;
    }

    public function update(){
        DB::table('document')->where('id', $id)->update([
            'statusdoc' => 4
        ]);
    }

    public function render()
    {
        
        if (Auth::user()->role == 'developer') { 
            $this->records = DB::table('document')->join('users', 'users.id', '=', 'document.pic')
            ->select('document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.reminder as reminder',
            'document.pic as idpic', 
            'users.name as name', 'document.status as status', 'document.remark as remark', 'document.statusdoc as statusdoc')
            ->where('document.id', $this->pass)->get();
            $this->notif = DB::table('notify')->join('users', 'users.id', '=', 'notify.user')
            ->select('notify.user as uid', 'users.name as name', 'notify.user as iduser')
            ->where('refer', $this->pass)->get();
            $this->users = DB::table('users')->leftjoin('department', 'users.department', '=', 'department.id')
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'users.status as status', 'department.id as idpt')
            ->get();
        } else {

        }
        return view('livewire.detaildocument');
    }
}
