<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifWa;
use Auth;

class NotifWaController extends Controller
{
    public function notif_wa(Request $request)
    {
        $insert_data = NotifWa::create([
            'id_adm'=>Auth()->user()->id,
            'no_wa'=>$request->no_wa,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
            'detik'=>$request->detik,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif wa berhasil ditambahkan');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif wa gagal ditambahkan');
        }
    }
}
