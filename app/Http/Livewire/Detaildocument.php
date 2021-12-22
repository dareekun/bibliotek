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


    public function editdoc(){
        $this->statusdoc = 1;
    }

    public function canceldoc(){
        $this->statusdoc = 0;
    }

    public function update($id){
        DB::table('document')->where('id', $id)->update([
            'statusdoc' => 4
        ]);
    }

    public function deactive($id){
        DB::table('document')->where('id', $id)->update([
            'statusdoc' => 0
        ]);
    }

    public function save($tag, $index){

    }

    public function render()
    {
        
        if (Auth::user()->role == 'developer') { 
            $this->records = DB::table('document')->join('users', 'users.id', '=', 'document.pic')
            ->select('document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.reminder as reminder',
            'document.pic as idpic', 'document.docloc as docloc',
            'users.name as name', 'document.remark as remark', 'document.statusdoc as statusdoc')
            ->where('document.id', $this->pass)->get();
            $this->notif = DB::table('notify')->join('users', 'users.id', '=', 'notify.user')
            ->select('notify.user as uid', 'users.name as name', 'notify.user as iduser')
            ->where('refer', $this->pass)->get();
            $this->users = DB::table('users')->leftjoin('department', 'users.department', '=', 'department.id')
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'department.id as idpt')
            ->get();
            $this->table = DB::table('history')->where('refer', $this->pass)->get();
        } else {
            $location = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->records = DB::table('document')->join('users', 'users.id', '=', 'document.pic')
            ->select('document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.reminder as reminder',
            'document.pic as idpic', 'document.docloc as docloc',
            'users.name as name', 'document.remark as remark', 'document.statusdoc as statusdoc')
            ->where('document.id', $this->pass)->get();
            $this->notif = DB::table('notify')->join('users', 'users.id', '=', 'notify.user')
            ->select('notify.user as uid', 'users.name as name', 'notify.user as iduser')
            ->where('refer', $this->pass)->get();
            $this->users = DB::table('users')->leftjoin('department', 'users.department', '=', 'department.id')->where('department.location', $location)
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'department.id as idpt')
            ->get();
            $this->table = DB::table('history')->where('refer', $this->pass)->get();
        }
        return view('livewire.detaildocument');
    }
}
