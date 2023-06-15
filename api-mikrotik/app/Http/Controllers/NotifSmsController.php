<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifSms;
use Auth;

class NotifSmsController extends Controller
{
    public function add_sms()
    {
        return view('Auth.notif.add_sms');
    }
    public function notif_sms(Request $request)
    {
        $insert_data = NotifSms::create([
            'id_adm'=>Auth()->user()->id,
            'no_sms'=>$request->no_sms,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
            'detik'=>$request->detik,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Sms berhasil ditambahkan');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Sms gagal ditambahkan');
        }
    }
}
