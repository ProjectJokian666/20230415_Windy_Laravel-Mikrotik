<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifWa;
use Auth;
use Illuminate\Support\Facades\DB;

class NotifWaController extends Controller
{
    public function add_wa()
    {
        return view('Auth.notif.add_wa');
    }
    public function notif_wa(Request $request)
    {
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect('choice/notif_akun')->with('gagal','Data notif Wa gagal ditambahkan, Jam atau Manit harus lebih dari 0');
        }
        $insert_data = NotifWa::create([
            'id_adm'=>Auth()->user()->id,
            'no_wa'=>$request->no_wa,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif wa berhasil ditambahkan');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif wa gagal ditambahkan');
        }
    }
    public function delete_wa($id){
        $delete_data = NotifWa::
        where('id',$id)->
        delete();
        DB::statement('alter table notif_wa auto_increment=0');

        if ($delete_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Wa berhasil dihapus');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Wa gagal dihapus');
        }
    }
    public function edit_wa($id)
    {
        $data = [
            'data' => NotifWa::find($id),
        ];
        return view('Auth.notif.edit_wa',compact('data'));
    }
    public function patch_wa($id,Request $request)
    {
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect('choice/notif_akun')->with('gagal','Data notif Wa gagal diubah, Jam atau Manit harus lebih dari 0');
        }
        $update_data = NotifWa::
        where('id',$id)->
        update([
            'id_adm'=>Auth()->user()->id,
            'no_wa'=>$request->no_wa,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($update_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Wa berhasil diubah');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Wa gagal diubah');
        }
    }
}
