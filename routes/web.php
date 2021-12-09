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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/document/{id}', [HomeController::class, 'document'])->name('document');

// Level Admin Be Advice
Route::middleware(['auth:sanctum', 'verified'])->get('/setting', [AdminController::class, 'setting'])->name('setting');
Route::middleware(['auth:sanctum', 'verified'])->get('/department', [AdminController::class, 'department'])->name('department');
Route::middleware(['auth:sanctum', 'verified'])->get('/users', [AdminController::class, 'users'])->name('users');