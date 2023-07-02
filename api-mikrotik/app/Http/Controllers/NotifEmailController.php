<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use App\Mail\SendMailNotif;
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
    public function test_sinyal()
    {
        $status=false;
        if (request()->data) {
            $status= true;
            $data_akun = NotifEmail::find(request()->data);
            $data = [
                'title'=>'Test Ketersediaan Data',
            ];
            Mail::to($data_akun->akun_email)->send(new SendMail($data));
        }
        else{
            $status = false;
        }
        $data = [
            'data_id'=>request()->data,
            'status'=>$status,
        ];
        return response()->json($data,200);
    }
    public function kirim_notif()
    {
        $time_lock = request()->time_lock;
        $time_server = DATE('Y-m-d H:i:',strtotime(request()->time_server)).'00';
        // $time_server = request()->time_server;
        $time_loop = strtotime($time_server)-strtotime($time_lock);
        $jam = request()->jam;
        $menit = request()->menit;
        $time_send = $jam*3600+$menit*60;
        if ($time_loop%$time_send==0) {
            $data = [
                'id'=>request()->id,
                'jam'=>$jam,
                'menit'=>$menit,
                'status'=>'kirim',
                'time_send'=>$time_send,
                'time_server'=>$time_server,
                'time_lopp'=>$time_loop,
                'time_mod'=>$time_loop%$time_send,
                'time_lock'=>$time_lock,
            ];

            $data_akun = NotifEmail::find(request()->id);

            $data_periodik = [
                'title'=>'Data Periodik',
                'ip'=>session()->get('ip'),
                'user'=>session()->get('user'),
                'password'=>session()->get('password'),
            ];

            // Mail::to($data_akun->akun_email)->send(new SendMailNotif($data_periodik));
            return response()->json($data);
        }
        else{
            $data=[
                'status'=>'tidak',
            ];
            return response()->json($data);
        }
    }
}
