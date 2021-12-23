<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/users/list',[UserController::class,'index'])->name('users.index');
Route::get('/getUsersList',[UserController::class,'getUsersList'])->name('get.users.list');
Route::post('/addUser',[UserController::class,'addUser'])->name('add.user');
Route::post('/getUserDetails',[UserController::class,'getUserDetails'])->name('get.user.details');
Route::post('/updateUserDetails',[UserController::class,'updateUserDetails'])->name('update.user.details');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
