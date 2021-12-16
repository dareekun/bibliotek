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
    public $statusdoc; 

    
    public function deactive($id){
        DB::table('document')->where('id', $id)->update([
            'statusdoc' => 0
        ]);
    }

    public function editdoc($id){
        DB::table('document')->where('id', $id)->update([
            'status' => 1,
        ]);
    }

    public function update(){
        DB::table('document')->where('id', $id)->update([
            'statusdoc' => 4
        ]);
    }

    public function render()
    {
        $this->statusdoc = DB::table('document')->where('id', $this->pass)->value('statusdoc');
        $this->records = DB::table('document')->join('users', 'users.id', '=', 'document.pic')
        ->select('document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.reminder as reminder',
        'users.name as name', 'document.status as status', 'document.remark as remark', 'document.statusdoc as statusdoc')
        ->where('document.id', $this->pass)->get();
        $this->notif = DB::table('notify')->join('users', 'users.id', '=', 'notify.user')
        ->select('notify.user as uid', 'users.name as name')
        ->where('refer', $this->pass)->get();
        return view('livewire.detaildocument');
    }
}
