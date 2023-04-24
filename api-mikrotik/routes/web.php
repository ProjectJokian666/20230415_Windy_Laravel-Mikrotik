<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenController as Authen;
use App\Http\Controllers\DashboardController as Dashboard;


Route::middleware('guest')->group(function(){
});

Route::get('login',[Authen::class,'login'])->name('login'); //masuk ke dalam sistem
Route::post('post_login',[Authen::class,'post_login'])->name('post_login');
Route::get('register',[Authen::class,'register'])->name('register'); //daftar untuk masuk kedalam sistem
Route::post('post_register',[Authen::class,'post_register'])->name('post_register');


Route::middleware('auth')->group(function(){
});

Route::get('logout',[Authen::class,'logout'])->name('logout');

Route::prefix('choice')->name('choice')->group(function(){
    Route::get('',[Authen::class,'choice']); //menampilkan pilihan setelah login
    Route::get('list_akun',[Authen::class,'list_akun'])->name('.list_akun'); //menampilkan list akun masuk kedalam mikrotik
    Route::get('login_akun',[Authen::class,'login_akun'])->name('.login_akun'); //menampilkan form untuk login kedalam sistem mikrotik
});
Route::get('/',[Dashboard::class,'index'])->name('');
Route::get('interfaces',[Dashboard::class,'interfaces'])->name('interfaces');
Route::get('log',[Dashboard::class,'log'])->name('log');
Route::get('resources',[Dashboard::class,'resources'])->name('resources');