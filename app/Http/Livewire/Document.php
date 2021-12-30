<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Auth;

class Document extends Component
{
    public $documents = [];
    public $condition;
    
    public function render()
    {
        if (Auth::user()->role == 'developer') {
            $this->documents = DB::table('document')->join('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->select('document.id as id', 'document.title as title', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category')->where('document.statusdoc', $this->condition)
            ->get();
        } elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'sadmin') {
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->join('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->select('document.id as id', 'document.title as title', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category')->where('document.statusdoc', $this->condition)
            ->where('document.location', $location)->get();
        } elseif(Auth::user()->role == 'manager') {
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->join('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->select('document.id as id', 'document.title as title', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category')->where('document.statusdoc', $this->condition)
            ->where('document.department', Auth::user()->department)->get();
        } elseif (Auth::user()->role == 'user'){
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->join('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->select('document.id as id', 'document.title as title', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category')->where('document.statusdoc', $this->condition)
            ->where(function($query) {$query->where('document.creator', Auth::user()->id)->orWhere('document.pic', Auth::user()->id);})->get();
        } elseif (Auth::user()->role == 'pic'){
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->join('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->select('document.id as id', 'document.title as title', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category')->where('document.statusdoc', $this->condition)
            ->where('document.creator', Auth::user()->id)->get();
        }
        return view('livewire.document');
    }
}
