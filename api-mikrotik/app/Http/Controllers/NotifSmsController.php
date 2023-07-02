<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifSms;
use Auth;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

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

    public function test_sinyal()
    {
        $data_sms = NotifSms::find(request()->data);
        $twilio_smss_number = $data_sms->no_twilio;
        $account_sid = $data_sms->account_sid;
        $auth_token = $data_sms->auth_token;

        $client = new Client($account_sid, $auth_token);
        $message = "Coba Test Pesan Twilio";
        $sms=$data_sms->no_sms;
        $data = $client->messages->create("$sms", array('from' => "$twilio_smss_number", 'body' => $message));
        return response()->json($data);
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

            $data_akun = NotifSms::find(request()->id);

            $twilio_sms_number = $data_akun->no_twilio;
            $account_sid = $data_akun->account_sid;
            $auth_token = $data_akun->auth_token;

            $client = new Client($account_sid, $auth_token);

            $message = "
            Data Periodik
            Akun ".Auth()->User()->email."
            Ip ".session()->get('ip')."
            User ".session()->get('user')."
            Password ".session()->get('password')
            ;
            $sms=$data_akun->no_sms;

            // $data_periodik = $client->messages->create(
            //     "$sms",
            //     array(
            //         'from' => "$twilio_sms_number", 
            //         'body' => $message
            //     )
            // );

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
