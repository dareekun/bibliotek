<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Users extends Component
{
    public $users = [];
    public $departments = [];
    public $status = [];
    public $inputnik;
    public $inputname;
    public $inputemail;
    public $inputpass;
    public $inputdept;
    public $inputrole;

    public $deleteid;
    public $deletenik;
    public $deletename;

    public $passid;
    public $inputpass1;
    public $inputpass2;

    protected $listeners = ['rubah' => 'change'];    
    
    public function change($payload){
        $this->dispatchBrowserEvent('toaster', ['message' => 'Data '. $payload['data'], 'color' => '#dc3545', 'title' => 'Debug Message']);
    }

    public function delete($id){
        $this->deleteid   = $id;
        $this->deletenik  = DB::table('users')->where('id', $id)->value('nik');
        $this->deletename = DB::table('users')->where('id', $id)->value('name');
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#deleteuser']);
    }

    public function confirm()
    {
        DB::table('users')->where('id', $this->deleteid)->delete();
        $this->dispatchBrowserEvent('closemodal', ['modalid' => '#deleteuser']);
        $this->dispatchBrowserEvent('toaster', ['message' => 'User Data Deleted Successfully', 'color' => '#dc3545', 'title' => 'Delete User']);
    }

    public function changepass($id){
        $this->inputpass1 = '';
        $this->inputpass2 = '';
        $this->passid = $id;
        $this->dispatchBrowserEvent('openmodal', ['modalid' => '#changepassword']);
    }

    public function confirmpass(){
        if (strlen($this->inputpass1) < 5) {
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#changepassword']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Password must contain atleast 6 character', 'color' => '#dc3545', 'title' => 'Password Length']);
        } else {
            if($this->inputpass1 != $this->inputpass2) {
                $this->dispatchBrowserEvent('closemodal', ['modalid' => '#changepassword']);
                $this->dispatchBrowserEvent('toaster', ['message' => 'Password is not same', 'color' => '#dc3545', 'title' => 'Change Password']);
            } else {
                DB::table('users')->where('id', $this->passid)->update([
                    'password' => bcrypt($this->inputpass1)
                ]);
                $this->dispatchBrowserEvent('closemodal', ['modalid' => '#changepassword']);
                $this->dispatchBrowserEvent('toaster', ['message' => 'password changed successfully', 'color' => '#28a745', 'title' => 'Change Password']);
            }
        }
    }

    public function edit($tag){
        if (in_array(1, $this->status)) {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        } else {
            $this->status[$tag] = 1;
        }
    }
    
    public function cancel($tag){
        $this->status[$tag] = 0;
    }

    public function submit()
    {
        if (DB::table('users')->where('nik', $this->inputnik)->orWhere('email', $this->inputemail)->doesntExist()) {
            if (strlen($this->inputpass) < 5) {
                $this->dispatchBrowserEvent('closemodal', ['modalid' => '#exampleModal']);
                $this->dispatchBrowserEvent('toaster', ['message' => 'Password must contain atleast 6 character', 'color' => '#dc3545', 'title' => 'Password Length']);
            } else {
                DB::table('users')->insert([
                    'nik' => $this->inputnik,
                    'name' => $this->inputname,
                    'email' => $this->inputemail,
                    'department' => $this->inputdept,
                    'password' => bcrypt($this->inputpass),
                    'role' => $this->inputrole,
                ]);
                $this->dispatchBrowserEvent('closemodal', ['modalid' => '#exampleModal']);
                $this->dispatchBrowserEvent('toaster', ['message' => 'User added successfully', 'color' => '#28a745', 'title' => 'Add User']);
            }
        } else {
            $this->dispatchBrowserEvent('closemodal', ['modalid' => '#exampleModal']);
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate data user', 'color' => '#dc3545', 'title' => 'Duplicate User']);
        }
        $this->inputnik   = '';
        $this->inputname  = '';
        $this->inputemail = '';
        $this->inputpass  = '';
        $this->inputdept  = '';
        $this->inputrole  = '';
    }

    public function save($tag, $ind){
        $a = $this->users[$ind]['nik'];
        $b = $this->users[$ind]['email'];
        if (DB::table('users')->where('id', '<>' ,$tag)->where(function ($query) use ($a,$b) {$query->where('nik', $a)->orWhere('email', $b);})->exists()) {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate data user', 'color' => '#dc3545', 'title' => 'Duplicate User']);
        } else {
            DB::table('users')->where('id', $tag)->update([
            'nik' => $this->users[$ind]['nik'],
            'name' => $this->users[$ind]['name'],
            'email' => $this->users[$ind]['email'],
            'department' => $this->users[$ind]['idpt'],
            'role' => $this->users[$ind]['role'],
        ]);                
        $this->status[$ind] = 0;
        $this->dispatchBrowserEvent('toaster', ['message' => 'User data changed successfully - '. $this->users[$ind]['idpt'], 'color' => '#28a745', 'title' => 'Change user data']);
        }
    }

    public function render()
    {
        if (Auth::user()->can('isDeveloper')) {
            $this->users = DB::table('users')->leftjoin('department', 'users.department', '=', 'department.id')
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'users.department as idpt')
            ->get();
            $this->departments = DB::table('department')->get();
            for ($i = 0; $i < count($this->users); $i++) {
                array_push($this->status, 0);
            }
        } else {
            $location    = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->users = DB::table('users')->join('department', 'users.department', '=', 'department.id')
            ->where('department.location', $location)->where('users.role', '<>', 'developer')
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'users.department as idpt')
            ->get();
            $this->departments = DB::table('department')->where('location', $location)->get();
            for ($i = 0; $i < count($this->users); $i++) {
                array_push($this->status, 0);
            }
        }
        return view('livewire.users');
    }
}