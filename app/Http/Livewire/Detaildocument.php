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
    public $tempdatadel = [];
    public $tempdataupd = [];


    public function mount(){
        DB::table('notify')->where('refer', $this->pass)->where('user', '')->delete();
    }

    public function editdoc(){
        $this->statusdoc   = 1;
        $this->tempdataupd = [];
        $this->tempdatadel = [];
        $nonf = DB::table('notify')->where('refer', $this->pass)->get();
        foreach ($nonf as $nft) {
            $nano = [];
            array_push($nano, $nft->id);
            array_push($nano, $nft->user);
            array_push($this->tempdataupd, $nano);
        }
    }

    public function canceldoc(){
        $this->statusdoc   = 0;
        $this->tempdatadel = [];
        $this->tempdataupd = [];
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

    public function showpdf($file){
        $this->document = $file;
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#modalpdf']);
    }

    public function tempdelete($index){
            $value = $this->tempdataupd[$index][1];
        if (DB::table('notify')->where('refer', $this->pass)->where('user', $value)->exists()) {
            $key = array_search($value, array_column($this->tempdataupd, 1));
            $this->dispatchBrowserEvent('toaster', ['message' => $key, 'color' => '#dc3545', 'title' => 'Input Date Error']);
            unset($this->tempdataupd[$key]);
            $this->tempdataupd  = array_values($this->tempdataupd);
            $tempo = DB::table('notify')->where('refer', $this->pass)->where('user', $value)->limit(1)->value('id');
            array_push($this->tempdatadel, $tempo);
        } else {
            $key = array_search($value, array_column($this->tempdataupd, 1));
            $this->dispatchBrowserEvent('toaster', ['message' => $value, 'color' => '#dc3545', 'title' => 'Input Date Error']);
            unset($this->tempdataupd[$key]);
            $this->tempdataupd  = array_values($this->tempdataupd);
        }
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
        if (count($this->tempdataupd) < 3) {
            $nano = [];
            array_push($nano, '');
            array_push($nano, '');
            array_push($this->tempdataupd, $nano);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Maximal Notification 3 Person', 'color' => '#dc3545', 'title' => 'Email Limit']);
        }
    }

    public function savedoc($index){
        if (strtotime($this->records[$index]['expireddate']) > strtotime($this->records[$index]['issuedate'])) {
            if (strtotime($this->records[$index]['expireddate'].' - '.  $this->records[$index]['reminder']. ' days') < strtotime('now') && strtotime($this->records[$index]['expireddate']) > strtotime('now')){
                $newstatus = 2;
                DB::table('email_job')->insert([
                    'refer'     => $this->pass,
                    'condition' => $newstatus
                ]);
            } else if (strtotime($this->records[$index]['expireddate']) <= strtotime('now')) {
                $newstatus = 0;
                DB::table('email_job')->insert([
                    'refer'     => $this->pass,
                    'condition' => $newstatus
                ]);
            } else {
                $newstatus = 1;
            }
            DB::table('document')->where('id', $this->pass)->update([
                'issuedate'   => $this->records[$index]['issuedate'],
                'expireddate' => $this->records[$index]['expireddate'],
                'reminder'    => $this->records[$index]['reminder'],
                'pic'         => $this->records[$index]['emailpic'],
                'remark'      => $this->records[$index]['remark'],
                'statusdoc'   => $newstatus
            ]);
            for ($i = 0; $i < count($this->tempdatadel); $i++) {
                if (DB::table('notify')->where('refer', $this->pass)->where('id', $this->tempdatadel[$i])->exists()) {
                    DB::table('notify')->where('refer', $this->pass)->where('id', $this->tempdatadel[$i])->delete();
                }else {
                    //Do Nothing
                }
            }
            for ($n = 0; $n < count($this->tempdataupd); $n++) {
                if (DB::table('notify')->where('refer', $this->pass)->where('user', $this->tempdataupd[$n][1])->exists()) {
                    // Do Nothing
                }else {
                    if ($this->tempdataupd[$n][0] == NULL) {
                        DB::table('notify')->insert([
                            'refer' => $this->pass,
                            'user' => $this->tempdataupd[$n][1]
                        ]);
                    } else {
                        DB::table('notify')->where('id', $this->tempdataupd[$n][0])->update([
                            'refer' => $this->pass,
                            'user' => $this->tempdataupd[$n][1]
                        ]);
                    }
                }
            }
            DB::table('notify')->where('refer', $this->pass)->where('user', '-')->delete();
            activity()->log('Edited Document ('.$this->pass.')');
            $this->statusdoc = 0;
            $this->dispatchBrowserEvent('toaster', ['message' => 'Change Successfully Saved', 'color' => '#28a745', 'title' => 'Edit Document']);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Opps, date data have some issue', 'color' => '#dc3545', 'title' => 'Input Date Error']);
        }
    }

    public function newdoc(){
        $this->validate([
            'newfile' => 'max:20480',
        ]);
        if (strtotime($this->newexpiredate) > strtotime($this->newissuedate)) {
            $docname   = strtoupper(base_convert(time().sprintf('%02d', rand(1,99)),10,32));
            $this->newfile->storePubliclyAs("doc", $docname.'.pdf', 'public');
            $coundown = DB::table('document')->where('id', $this->pass)->value('reminder');
            if (strtotime($this->newexpiredate.' - '.  $coundown. ' days') < strtotime('now') && strtotime($this->newexpiredate) > strtotime('now')) {
                $newstatusdoc = 2;
            } elseif (strtotime($this->newexpiredate) <= strtotime('now')) {
                $newstatusdoc = 0;
            }else {
                $newstatusdoc = 1;
            }
            DB::table('history')->insert([
                'refer' => $this->pass,
                'code' => $this->newnodoc,
                'statusdoc' => $newstatusdoc,
                'issuedate' => $this->newissuedate,
                'expirdate' => $this->newexpiredate,
                'file' => $docname
            ]);
            DB::table('document')->where('id', $this->pass)->update([
                'issuedate'   => $this->newissuedate,
                'expireddate' => $this->newexpiredate,
                'statusdoc'   => $newstatusdoc
            ]);
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal2']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Document Successfully Updated', 'color' => '#28a745', 'title' => 'Updated Document']);
            activity()->log('Upload Document ('.$this->pass.')');
        } else {
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#Modal2']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Opps, date data have some issue', 'color' => '#dc3545', 'title' => 'Input Date Error']);
        }
    }

    public function render()
    {
        $this->docstatus = DB::table('document')->where('document.id', $this->pass)->value('statusdoc');
        $this->records   = DB::table('document')->leftJoin('users', 'users.email', '=', 'document.pic')
        ->select('document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.reminder as reminder',
        'document.pic as emailpic', 'document.docloc as docloc',
        'users.name as name', 'document.remark as remark', 'document.statusdoc as statusdoc')
        ->where('document.id', $this->pass)->get();
        $this->table     = DB::table('history')->where('refer', $this->pass)->get();
        $this->notif     = DB::table('notify')->where('refer', $this->pass)->get();
        return view('livewire.detaildocument');
    }
}
