<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::post('catdrop',  [HomeController::class, 'catdrop'])->name('catdrop');
Route::post('subcatdrop',  [HomeController::class, 'subcatdrop'])->name('subcatdrop');
Route::get('/test/{id}', [HomeController::class, 'test']);


Route::get('/forgot_password',  [HomeController::class, 'forgot_password'])->name('forgot_password');
Route::post('/password_reset',  [HomeController::class, 'password_reset'])->name('password_reset');
Route::post('/password_update',  [HomeController::class, 'password_update'])->name('password_update');
Route::get('/reset-password/{token}',  [HomeController::class, 'reset_password'])->name('reset-password');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::middleware(['auth:sanctum', 'verified'])->get('/newdocument', [HomeController::class, 'newdocument'])->name('newdocument')->middleware('can:isUser');

// Document List
Route::middleware(['auth:sanctum', 'verified'])->get('/document/{id}', [HomeController::class, 'documenttype'])->name('documenttype');


// Level Admin Be Advice
Route::middleware(['auth:sanctum', 'verified'])->get('/category', [AdminController::class, 'category'])->name('category')->middleware('can:isAdmin');
Route::middleware(['auth:sanctum', 'verified'])->get('/department', [AdminController::class, 'department'])->name('department')->middleware('can:isAdmin');
Route::middleware(['auth:sanctum', 'verified'])->get('/users', [AdminController::class, 'users'])->name('users')->middleware('can:isSadmin');

// Level Super Admin Be Advice
Route::middleware(['auth:sanctum', 'verified'])->get('/loghorizon', [AdminController::class, 'loghorizon'])->name('log_horizon')->middleware('can:isSadmin');
Route::middleware(['auth:sanctum', 'verified'])->get('/emailhorizon', [AdminController::class, 'emailhorizon'])->name('email_horizon')->middleware('can:isSadmin');
Route::middleware(['auth:sanctum', 'verified'])->get('/location', [AdminController::class, 'location'])->name('location')->middleware('can:isSadmin');

//Level Developer please be Advice