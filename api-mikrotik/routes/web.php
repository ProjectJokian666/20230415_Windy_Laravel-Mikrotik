<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenController as Authen;
use App\Http\Controllers\NotifWaController as NotifWa;
use App\Http\Controllers\NotifSmsController as NotifSms;
use App\Http\Controllers\NotifEmailController as NotifEmail;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\RealtimeController as Realtime;
use App\Http\Controllers\NotifController as Notif;
use App\Http\Controllers\JaringanDownController as CekJaringan;


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
        Route::get('',[Authen::class,'choice'])->name('.choice');

        //menampilkan list akun masuk kedalam mikrotik
        Route::get('list_akun',[Authen::class,'list_akun'])->name('.list_akun');
        Route::post('post_list_akun',[Authen::class,'post_list_akun'])->name('.post_list_akun');

        //menampilkan form untuk login kedalam sistem mikrotik
        Route::get('login_akun',[Authen::class,'login_akun'])->name('.login_akun'); 
        Route::post('post_login_akun',[Authen::class,'post_login_akun'])->name('.post_login_akun'); 
        Route::get('list_akun/{id}',[Authen::class,'list_akun_id'])->name('.list_akun_id'); 
        Route::get('list_akun/{id}/delete',[Authen::class,'delete_akun_id'])->name('.delete_akun_id'); 

        //menampilkan form untuk notif kedalam sistem mikrotik
        // Route::get('notif_wa',[Notif::class,'notif_wa'])->name('.notif_wa');
        Route::get('notif_akun',[Authen::class,'notif_akun'])->name('.notif_akun'); 
        // Route::get('cek_notif',[Authen::class,'cek_notif'])->name('.cek_notif'); 
        // Route::post('simpan_notif_akun',[Authen::class,'simpan_notif_akun'])->name('.simpan_notif_akun');

        Route::prefix('notif_akun')->name('.notif_akun')->group(function(){
            Route::post('',[Authen::class,'notif_akun']);

            
            Route::prefix('notif_wa')->name('.notif_wa')->group(function(){
                Route::get('add_wa',[NotifWa::class,'add_wa'])->name('.add_wa');
                Route::post('',[NotifWa::class,'notif_wa'])->name('.notif_wa');
                Route::get('{id}/wa/edit',[NotifWa::class,'edit_wa'])->name('.edit_wa');
                Route::patch('{id}/wa/edit',[NotifWa::class,'patch_wa'])->name('.patch_wa');
                Route::delete('{id}/wa/hapus',[NotifWa::class,'delete_wa'])->name('.delete_wa');
                
                Route::get('test_sinyal',[NotifWa::class,'test_sinyal'])->name('.test_sinyal');
                Route::get('kirim_notif',[NotifWa::class,'kirim_notif'])->name('.kirim_notif');
            });

            Route::prefix('notif_sms')->name('.notif_sms')->group(function(){
                Route::get('add_sms',[NotifSms::class,'add_sms'])->name('.add_sms');
                Route::post('',[NotifSms::class,'notif_sms'])->name('.notif_sms');
                Route::get('{id}/sms/edit',[NotifSms::class,'edit_sms'])->name('.edit_sms');
                Route::patch('{id}/sms/edit',[NotifSms::class,'patch_sms'])->name('.patch_sms');
                Route::delete('{id}/sms/hapus',[NotifSms::class,'delete_sms'])->name('.delete_sms');

                Route::get('test_sinyal',[NotifSms::class,'test_sinyal'])->name('.test_sinyal');
                Route::get('kirim_notif',[NotifSms::class,'kirim_notif'])->name('.kirim_notif');
            });

            Route::prefix('notif_email')->name('.notif_email')->group(function(){
                Route::get('add_email',[NotifEmail::class,'add_email'])->name('.add_email');
                Route::post('',[NotifEmail::class,'notif_email'])->name('.notif_email');
                Route::get('{id}/email/edit',[NotifEmail::class,'edit_email'])->name('.edit_email');
                Route::patch('{id}/email/edit',[NotifEmail::class,'patch_email'])->name('.patch_email');
                Route::delete('{id}/email/hapus',[NotifEmail::class,'delete_email'])->name('.delete_email');
                Route::get('test_email',[NotifEmail::class,'test_email'])->name('.test_email');

                Route::get('test_sinyal',[NotifEmail::class,'test_sinyal'])->name('.test_sinyal');
                Route::get('kirim_notif',[NotifEmail::class,'kirim_notif'])->name('.kirim_notif');
            });
        });

        Route::get('logout',[Authen::class,'logout_akun'])->name('.logout'); 
    });

    Route::get('/',[Dashboard::class,'index'])->name('/');
    Route::get('interfaces',[Dashboard::class,'interfaces'])->name('interfaces');
    Route::get('log',[Dashboard::class,'log'])->name('log');
    Route::get('get_log',[Dashboard::class,'get_log'])->name('get_log');
    Route::get('resources',[Dashboard::class,'resources'])->name('resources');
    Route::get('update_tx_rx',[Dashboard::class,'update_tx_rx'])->name('update_tx_rx');
    Route::get('update_notif_web',[Dashboard::class,'update_notif_web'])->name('update_notif_web');

    Route::get('cek_jaringan',[CekJaringan::class,'cek_jaringan'])->name('cek_jaringan');

    Route::prefix('realtime')->name('realtime')->group(function(){
        // Resource
        Route::get('uptime',[Realtime::class,'uptime'])->name('.uptime');
        Route::get('free_memory',[Realtime::class,'free_memory'])->name('.free_memory');
        Route::get('total_memory',[Realtime::class,'total_memory'])->name('.total_memory');
        Route::get('cpu',[Realtime::class,'cpu'])->name('.cpu');
        Route::get('cpu_count',[Realtime::class,'cpu_count'])->name('.cpu_count');
        Route::get('cpu_frequency',[Realtime::class,'cpu_frequency'])->name('.cpu_frequency');
        Route::get('cpu_load',[Realtime::class,'cpu_load'])->name('.cpu_load');
        Route::get('free_hdd',[Realtime::class,'free_hdd'])->name('.free_hdd');
        Route::get('total_hdd',[Realtime::class,'total_hdd'])->name('.total_hdd');
        Route::get('since_reboot',[Realtime::class,'since_reboot'])->name('.since_reboot');
        Route::get('total',[Realtime::class,'total'])->name('.total');
        Route::get('architecture',[Realtime::class,'architecture'])->name('.architecture');
        Route::get('board',[Realtime::class,'board'])->name('.board');
        Route::get('version',[Realtime::class,'version'])->name('.version');
        Route::get('build_time',[Realtime::class,'build_time'])->name('.build_time');
        Route::get('factory_software',[Realtime::class,'factory_software'])->name('.factory_software');

        // Report Ethernet
        Route::get('tx/{tx}',[Realtime::class,'tx'])->name('.tx');
        Route::get('rx/{rx}',[Realtime::class,'rx'])->name('.rx');

        Route::get('traffic/{ether}',[Realtime::class,'traffic'])->name('.traffic');
        Route::get('resources',[Realtime::class,'resources'])->name('.resources');
    });

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