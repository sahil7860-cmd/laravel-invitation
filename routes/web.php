<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('index');
})->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginUser', [LoginController::class, 'loginUser'])->name('loginUser');
Route::get('/register', [RegisterController::class, 'register'])->middleware('isValidUser')->name('register');
Route::post('/storeUser', [RegisterController::class, 'storeUser'])->name('storeUser');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['admin']],function () {
     Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/request', [InvitationController::class ,'sendInvitation'])->name('sendInvitation');
Route::post('/enable', [InvitationController::class ,'enable'])->name('enable');
Route::post('/disable', [InvitationController::class ,'disable'])->name('disable');
Route::post('invitations',[InvitationController::class, 'store'])->name('storeInvitation');
});
Route::group(['middleware' => ['client']],function () {
Route::get('user-dashboard',[ClientController::class, 'index'])->name('client');
Route::post('uploadAvatar',[ClientController::class,'uploadAvatar'])->name('upload-avatar');
});
