<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use App\Models\NotifEmail;

class NotifEmailController extends Controller
{
    public function add_email()
    {
        return view('Auth.notif.add_email');
    }
    public function notif_email(Request $request)
    {
        // dd($request);
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal ditambahkan, Jam atau Manit harus lebih dari 0');
        }
        $insert_data = NotifEmail::create([
            'id_adm'=>Auth()->user()->id,
            'akun_email'=>$request->akun_email,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil ditambahkan');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal ditambahkan');
        }
    }
    public function patch_email($id,Request $request)
    {
        // dd($id,$request);
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect()->back()->with('gagal','Data notif Email gagal diubah, Jam atau Manit harus lebih dari 0');
        }
        $insert_data = NotifEmail::
        where('id',$id)->
        update([
            'id_adm'=>Auth()->user()->id,
            'akun_email'=>$request->akun_email,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil diubah');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal diubah');
        }
    }
    public function delete_email($id){
        $delete_data = NotifEmail::
        where('id',$id)->
        delete();
        DB::statement('alter table notif_email auto_increment=0');

        if ($delete_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil dihapus');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal dihapus');
        }
    }
    public function edit_email($id)
    {
        $data = [
            'data' => NotifEmail::find($id),
        ];
        return view('Auth.notif.edit_email',compact('data'));
    }
    public function test_email()
    {
        $email = 'emailtujuan@hotmail.com';
        $data = [
            'title' => 'Data Rekap Monitoring Mikrotik',
        ];
        Mail::to($email)->send(new SendMail($data));
        return 'Berhasil mengirim email!';
    }
}
