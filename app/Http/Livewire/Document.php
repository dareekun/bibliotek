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
            $this->documents = DB::table('document')->leftJoin('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->join('location', 'location.id', '=', 'document.location')->join('subcategory', 'subcategory.id', '=', 'document.subcategory')->join('department', 'department.id', '=', 'document.department')
            ->select('document.id as id', 'document.title as title', 'document.no as no', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.created_at as created_at',
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category', 'location.code as locode', 'category.code as catcode', 'subcategory.code as subcatcode', 'department.code as deptcode')->where('document.statusdoc', $this->condition)
            ->get();
        } elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'sadmin') {
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->leftJoin('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->join('location', 'location.id', '=', 'document.location')->join('subcategory', 'subcategory.id', '=', 'document.subcategory')->join('department', 'department.id', '=', 'document.department')
            ->select('document.id as id', 'document.title as title', 'document.no as no', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.created_at as created_at',
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category', 'location.code as locode', 'category.code as catcode', 'subcategory.code as subcatcode', 'department.code as deptcode')->where('document.statusdoc', $this->condition)
            ->where('document.location', $location)->get();
        } elseif(Auth::user()->role == 'manager') {
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->leftJoin('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->join('location', 'location.id', '=', 'document.location')->join('subcategory', 'subcategory.id', '=', 'document.subcategory')->join('department', 'department.id', '=', 'document.department')
            ->select('document.id as id', 'document.title as title', 'document.no as no', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.created_at as created_at', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category', 'location.code as locode', 'category.code as catcode', 'subcategory.code as subcatcode', 'department.code as deptcode')->where('document.statusdoc', $this->condition)
            ->where('document.department', Auth::user()->department)->get();
        } elseif (Auth::user()->role == 'user'){
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->leftJoin('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->join('location', 'location.id', '=', 'document.location')->join('subcategory', 'subcategory.id', '=', 'document.subcategory')->join('department', 'department.id', '=', 'document.department')
            ->select('document.id as id', 'document.title as title', 'document.no as no', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.created_at as created_at', 
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category', 'location.code as locode', 'category.code as catcode', 'subcategory.code as subcatcode', 'department.code as deptcode')->where('document.statusdoc', $this->condition)
            ->where(function($query) {$query->where('document.creator', Auth::user()->id)->orWhere('document.pic', Auth::user()->email);})->get();
        } elseif (Auth::user()->role == 'pic'){
            $location        = DB::table('department')->where('id', Auth::user()->department)->limit(1)->value('location');
            $this->documents = DB::table('document')->leftJoin('users', 'users.id', '=' ,'document.pic')->join('category', 'category.id', '=' ,'document.category')
            ->join('location', 'location.id', '=', 'document.location')->join('subcategory', 'subcategory.id', '=', 'document.subcategory')->join('department', 'department.id', '=', 'document.department')
            ->select('document.id as id', 'document.title as title', 'document.no as no', 'document.issuedate as issuedate', 'document.expireddate as expireddate', 'document.created_at as created_at',
            'users.name as pic', 'document.statusdoc as statusdoc', 'category.desc as category', 'location.code as locode', 'category.code as catcode', 'subcategory.code as subcatcode', 'department.code as deptcode')->where('document.statusdoc', $this->condition)
            ->where('document.creator', Auth::user()->email)->get();
        }
        return view('livewire.document');
    }
}
