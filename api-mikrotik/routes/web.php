<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenController as Authen;
use App\Http\Controllers\DashboardController as Dashboard;


Route::middleware('guest')->group(function(){
    //masuk ke dalam sistem
    Route::get('login',[Authen::class,'login'])->name('login'); 
    Route::post('post_login',[Authen::class,'post_login'])->name('post_login');

    //daftar untuk masuk kedalam sistem
    Route::get('register',[Authen::class,'register'])->name('register'); 
    Route::post('post_register',[Authen::class,'post_register'])->name('post_register');
});


Route::middleware('auth')->group(function(){
    Route::get('logout',[Authen::class,'logout'])->name('logout');

    Route::prefix('choice')->name('choice')->group(function(){
        //menampilkan pilihan setelah login
        Route::get('',[Authen::class,'choice']);

        //menampilkan list akun masuk kedalam mikrotik
        Route::get('list_akun',[Authen::class,'list_akun'])->name('.list_akun');

        //menampilkan form untuk login kedalam sistem mikrotik
        Route::get('login_akun',[Authen::class,'login_akun'])->name('.login_akun'); 
        Route::post('post_login_akun',[Authen::class,'post_login_akun'])->name('.post_login_akun'); 

        //menampilkan form untuk notif kedalam sistem mikrotik
        Route::get('notif_akun',[Authen::class,'notif_akun'])->name('.notif_akun'); 
        Route::post('simpan_notif_akun',[Authen::class,'simpan_notif_akun'])->name('.simpan_notif_akun'); 

        Route::get('logout',[Dashboard::class,'logout'])->name('.logout'); 
    });

    Route::get('/',[Dashboard::class,'index'])->name('');
    Route::get('interfaces',[Dashboard::class,'interfaces'])->name('interfaces');
    Route::get('log',[Dashboard::class,'log'])->name('log');
    Route::get('resources',[Dashboard::class,'resources'])->name('resources');

    //realtime data
    Route::get('realtime_uptime',[Dashboard::class,'realtime_uptime'])->name('realtime_uptime');
    Route::get('realtime_free_memory',[Dashboard::class,'realtime_free_memory'])->name('realtime_free_memory');
    Route::get('realtime_total_memory',[Dashboard::class,'realtime_total_memory'])->name('realtime_total_memory');
    Route::get('realtime_cpu',[Dashboard::class,'realtime_cpu'])->name('realtime_cpu');
    Route::get('realtime_cpu_count',[Dashboard::class,'realtime_cpu_count'])->name('realtime_cpu_count');
    Route::get('realtime_cpu_frequency',[Dashboard::class,'realtime_cpu_frequency'])->name('realtime_cpu_frequency');
    Route::get('realtime_cpu_load',[Dashboard::class,'realtime_cpu_load'])->name('realtime_cpu_load');
    Route::get('realtime_free_hdd',[Dashboard::class,'realtime_free_hdd'])->name('realtime_free_hdd');
    Route::get('realtime_total_hdd',[Dashboard::class,'realtime_total_hdd'])->name('realtime_total_hdd');
    Route::get('realtime_since_reboot',[Dashboard::class,'realtime_since_reboot'])->name('realtime_since_reboot');
    Route::get('realtime_total',[Dashboard::class,'realtime_total'])->name('realtime_total');
    Route::get('realtime_architecture',[Dashboard::class,'realtime_architecture'])->name('realtime_architecture');
    Route::get('realtime_board',[Dashboard::class,'realtime_board'])->name('realtime_board');
    Route::get('realtime_version',[Dashboard::class,'realtime_version'])->name('realtime_version');
    Route::get('realtime_build_time',[Dashboard::class,'realtime_build_time'])->name('realtime_build_time');
    Route::get('realtime_factory_software',[Dashboard::class,'realtime_factory_software'])->name('realtime_factory_software');
    
});