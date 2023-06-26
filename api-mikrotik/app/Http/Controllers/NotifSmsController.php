<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifSms;
use Auth;
use Illuminate\Support\Facades\DB;

class NotifSmsController extends Controller
{
    public function add_sms()
    {
        return view('Auth.notif.add_sms');
    }
    public function notif_sms(Request $request)
    {
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect('choice/notif_akun')->with('gagal','Data notif Sms gagal ditambahkan, Jam atau Manit harus lebih dari 0');
        }
        $insert_data = NotifSms::create([
            'id_adm'=>Auth()->user()->id,
            'no_sms'=>$request->no_sms,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Sms berhasil ditambahkan');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Sms gagal ditambahkan');
        }
    }
    public function delete_sms($id){
        $delete_data = NotifSms::
        where('id',$id)->
        delete();
        DB::statement('alter table notif_sms auto_increment=0');

        if ($delete_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil dihapus');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal dihapus');
        }
    }
    public function edit_sms($id)
    {
        $data = [
            'data' => NotifSms::find($id),
        ];
        return view('Auth.notif.edit_sms',compact('data'));
    }
    public function patch_sms($id,Request $request)
    {
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect()->back()->with('gagal','Data notif Sms gagal diubah, Jam atau Manit harus lebih dari 0');
        }
        $update_data = NotifSms::
        where('id',$id)->
        update([
            'id_adm'=>Auth()->user()->id,
            'no_sms'=>$request->no_sms,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($update_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Sms berhasil diubah');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Sms gagal diubah');
        }
    }
}
