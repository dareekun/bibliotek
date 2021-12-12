<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Users extends Component
{
    public $users = [];
    public $departments = [];
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
        if (DB::table('users')->where('status', $tag)->doesntExist()) {
            DB::table('users')->where('id', $tag)->update([
                'status' => 1,
            ]);
        } else {
            $this->dispatchBrowserEvent('toaster', ['message' => 'Oops Looks like you still have one not saved yet', 'color' => '#dc3545', 'title' => 'Undone Job']);
        }
    }

    public function submit()
    {
        if (DB::table('users')->where('nik', $this->inputnik)->orwhere('email', $this->inputemail)->doesntExist()) {
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
    }

    public function save($tag, $ind){
        $copynik  = DB::table('users')->where('id', $tag)->value('nik');
        $copymail = DB::table('users')->where('id', $tag)->value('email');
        if ($copymail == $this->users[$ind]['email'] && $copynik == $this->users[$ind]['nik']) {
            DB::table('users')->where('id', $tag)->update([
                'name' => $this->users[$ind]['name'],
                'department' => $this->users[$ind]['idpt'],
                'role' => $this->users[$ind]['role'],
                'status' => 0,
            ]);
        }else {
            if (DB::table('users')->where('id', '<>' ,$tag)->where('nik', $this->users[$ind]['nik'])->exists()) {
                $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate data user', 'color' => '#dc3545', 'title' => 'Duplicate User']);
            } elseif (DB::table('users')->where('id', '<>', $tag)->where('email', $this->users[$ind]['email'])->exists()) {
                $this->dispatchBrowserEvent('toaster', ['message' => 'Duplicate data user', 'color' => '#dc3545', 'title' => 'Duplicate User']);
            }else {DB::table('users')->where('id', $tag)->update([
                'nik' => $this->users[$ind]['nik'],
                'name' => $this->users[$ind]['name'],
                'email' => $this->users[$ind]['email'],
                'department' => $this->users[$ind]['idpt'],
                'role' => $this->users[$ind]['role'],
                'status' => 0,
            ]);
            }
        }
    }

    public function render()
    {
        if (Auth::user()->role == 'developer') {
            $this->users = DB::table('users')->join('department', 'users.department', '=', 'department.id')
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'users.status as status', 'department.id as idpt')
            ->get();
            $this->departments = DB::table('department')->get();
        } else {
            $location    = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->users = DB::table('users')->join('department', 'users.department'. '=', 'department.id')
            ->where('department.location', '$location')->where('users.role', '<>', 'developer')
            ->select('users.id as id', 'users.nik as nik', 'users.name as name', 'users.email as email', 'department.department as department', 
            'users.role as role', 'users.status as status', 'department.id as idpt')
            ->get();
            $this->departments = DB::table('department')->where('location', $location)->get();
        }
        return view('livewire.users');
    }
}