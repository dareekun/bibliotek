<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Auth;

class Detaildocument extends Component
{
    use WithFileUploads;

    public $pass;
    public $notif     = [];
    public $records   = [];
    public $table     = [];
    public $users     = [];
    public $statusdoc = 0;
    public $document;
    public $newnodoc;
    public $newissuedate;
    public $newexpiredate;
    public $newfile;
    public $docstatus;

    public function editdoc(){
        $this->statusdoc = 1;
    }

    public function canceldoc(){
        DB::table('notify')->where('refer', $this->pass)->where('user', '-')->delete();
        $this->statusdoc = 0;
    }

    public function mount(){
        DB::table('notify')->where('refer', $this->pass)->where('user', '-')->delete();
    }

    public function update(){
        $status = DB::table('document')->where('id', $this->pass)->value('statusdoc');
        if ($status == 4) {
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal1']);
            $this->dispatchBrowserEvent('openmodal', ['modalid' => '#Modal2']);
        } elseif($status == 1){
            DB::table('document')->where('id', $this->pass)->update([
                'statusdoc' => 3
            ]);
            activity()->log('Update Document ('.$this->pass.')');
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal1']);
        }
        else {
            $newstatus = $status + 1;
            DB::table('document')->where('id', $this->pass)->update([
                'statusdoc' => $newstatus
            ]);
            activity()->log('Update Document ('.$this->pass.')');
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal1']);
        }
    }

    public function deactive(){
        DB::table('document')->where('id', $this->pass)->update([
            'statusdoc' => 0
        ]);
        activity()->log('Deactive Document ('.$this->pass.')');
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal1']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Document Successfully Deactivate', 'color' => '#28a745', 'title' => 'Deactivate Document']);
    }

    public function savedoc($index){
        if (strtotime($this->records[$index]['expireddate'].' - '.  $this->records[$index]['reminder']. ' days') < strtotime('now') && strtotime($this->records[$index]['expireddate']) > strtotime('now')){
            $newstatus = 2;
            DB::table('email_job')->insert([
                'refer'     => $refer,
                'condition' => 0
            ]);
        } else if (strtotime($this->records[$index]['expireddate']) <= strtotime('now')) {
            $newstatus = 0;
            DB::table('email_job')->insert([
                'refer'     => $refer,
                'condition' => 0
            ]);
        } else {
            $newstatus = 1;
        }
        DB::table('document')->where('id', $this->pass)->update([
            'issuedate'   => $this->records[$index]['issuedate'],
            'expireddate' => $this->records[$index]['expireddate'],
            'reminder'    => $this->records[$index]['reminder'],
            'pic'         => $this->records[$index]['idpic'],
            'remark'      => $this->records[$index]['remark'],
            'statusdoc'   => $newstatus
        ]);
        DB::table('notify')->where('refer', $this->pass)->where('user', '-')->delete();
        activity()->log('Edited Document ('.$this->pass.')');
        $this->statusdoc = 0;
        $this->dispatchBrowserEvent('toaster', ['message' => 'Change Successfully Saved', 'color' => '#28a745', 'title' => 'Edit Document']);
    }

    public function showpdf($file){
        $this->document = $file;
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#modalpdf']);
    }

    public function deletepin($pinid){
        DB::table('notify')->where('refer', $this->pass)->where('id', $pinid)->delete();
        activity()->log('Deleted Person Notify On Document ('.$this->pass.')');
    }

    public function changepin($pinid, $no){
        $pertama = DB::table('notify')->join('users', 'notify.user', '=', 'users.id')->where('notify.refer', $this->pass)->where('notify.id', $pinid)->value('users.nik');
        $kedua   = DB::table('users')->where('id', $this->notif[$no]['iduser'])->value('nik');
        DB::table('notify')->where('refer', $this->pass)->where('id', $pinid)->update([
            'user' => $this->notif[$no]['iduser']
        ]);
        if ($pertama != '') {
            activity()->log('Change Person Notify On Document ('.$this->pass.') From '.$pertama.' To '.$kedua);
        } else {
            activity()->log('Add Person Notify '.$kedua.' On Document ('.$this->pass.')');
        }
    }

    public function addpin(){
        if (count($this->notif) < 3) {
            DB::table('notify')->insert([
                'refer' => $this->pass,
                'user' => '-'
            ]);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Maximal Notification 3 Person', 'color' => '#dc3545', 'title' => 'Email Limit']);
        }
    }
    public function newdoc(){

        $this->validate([
            'newfile' => 'max:20480',
        ]);

        $docname   = strtoupper(base_convert(time().sprintf('%02d', rand(1,99)),10,32));
        $this->newfile->storePubliclyAs("doc", $docname.'.pdf', 'public');
        DB::table('history')->insert([
            'refer' => $this->pass,
            'code' => $this->newnodoc,
            'statusdoc' => 1,
            'issuedate' => $this->newissuedate,
            'expirdate' => $this->newexpiredate,
            'file' => $docname
        ]);
        DB::table('document')->where('id', $this->pass)->update([
            'issuedate'   => $this->newissuedate,
            'expireddate' => $this->newexpiredate,
            'statusdoc'   => 1
        ]);
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal2']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'Document Successfully Updated', 'color' => '#28a745', 'title' => 'Updated Document']);
        activity()->log('Upload Document ('.$this->pass.')');
    }

    public function render()
    {
        $this->docstatus = DB::table('document')->where('document.id', $this->pass)->value('statusdoc');
        $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
        $this->records   = DB::table('document')->leftJoin('users', 'users.id', '=', 'document.pic')
        ->select('document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.reminder as reminder',
        'document.pic as idpic', 'document.docloc as docloc',
        'users.name as name', 'document.remark as remark', 'document.statusdoc as statusdoc')
        ->where('document.id', $this->pass)->get();
        $this->notif     = DB::table('notify')->leftJoin('users', 'users.id', '=', 'notify.user')
        ->select('notify.user as uid', 'users.name as name', 'notify.user as iduser')
        ->where('refer', $this->pass)->get();
        $this->users     = DB::table('users')->leftjoin('department', 'users.department', '=', 'department.id')
        ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
        'users.role as role', 'department.id as idpt')
        ->get();
        $this->table     = DB::table('history')->where('refer', $this->pass)->get();
        return view('livewire.detaildocument');
    }
}
