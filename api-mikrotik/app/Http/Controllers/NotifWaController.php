<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifWa;
use Auth;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class NotifWaController extends Controller
{
    public function add_wa()
    {
        return view('Auth.notif.add_wa');
    }
    public function notif_wa(Request $request)
    {
        // if ($request->jam<=0&&$request->menit<=0) {
        //     return redirect('choice/notif_akun')->with('gagal','Data notif Wa gagal ditambahkan, Jam atau Manit harus lebih dari 0');
        // }
        $insert_data = NotifWa::create([
            'id_adm'=>Auth()->user()->id,
            'no_wa'=>$request->no_wa,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'mulai'=>$request->jam_mulai,
            'berakhir'=>$request->jam_berakhir,
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
        $update_data = NotifWa::
        where('id',$id)->
        update([
            'id_adm'=>Auth()->user()->id,
            'no_wa'=>$request->no_wa,
            'no_twilio'=>$request->no_twilio,
            'account_sid'=>$request->account_sid,
            'auth_token'=>$request->auth_token,
            'mulai'=>$request->jam_mulai,
            'berakhir'=>$request->jam_berakhir,
        ]);

        if ($update_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Wa berhasil diubah');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Wa gagal diubah');
        }
    }

    public function test_sinyal()
    {
        $data_wa = NotifWa::find(request()->data);

        $twilio_whatsapp_number = $data_wa->no_twilio;
        $account_sid = $data_wa->account_sid;
        $auth_token = $data_wa->auth_token;

        $client = new Client($account_sid, $auth_token);

        $message = "Coba Test Pesan Twilio";
        $wa=$data_wa->no_wa;

        $data = $client->messages->create(
            "whatsapp:$wa", 
            array(
                'from' => "whatsapp:$twilio_whatsapp_number", 
                'body' => $message
            )
        );
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

            $data_akun = NotifWa::find(request()->id);

            $twilio_whatsapp_number = $data_akun->no_twilio;
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
            $wa=$data_akun->no_wa;

            // $data_periodik = $client->messages->create(
            //     "whatsapp:$wa", 
            //     array(
            //         'from' => "whatsapp:$twilio_whatsapp_number", 
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
