<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\RouterOsApi;
use App\Mail\SendMailJaringan;
use App\Models\NotifEmail;

class JaringanDownController extends Controller
{
    public function cek_jaringan()
    {
        $status = "false";

        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        // $ip = "12axa";

        $API = new RouterOsApi();
        $API->debug = false;

        $data_akun = NotifEmail::find(request()->id);

        if ($API->connect($ip, $user, $password)) {
            $status = 'sukses';

            $interface = $API->comm('/interface/print');
            foreach($interface as $i){
                if ($i['type']=="ether") {
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));
                    $tx=$data_ether[0]['tx-bits-per-second'];
                    $rx=$data_ether[0]['rx-bits-per-second'];
                    if ($tx==0) {
                        $status = 'tx down';
                        $message = "Bandwidth pada ".$i['default-name'].' mengalami down';
                        $data_jaringan = [
                            'title'=>'Notifikasi Jaringana',
                            'message'=>$message,
                        ];
                        Mail::to($data_akun->akun_email)->send(new SendMailJaringan($data_jaringan));
                    }
                    if ($rx==0) {
                        $status = 'rx down';
                        $message = "Bandwidth pada ".$i['default-name'].' mengalami down';
                        $data_jaringan = [
                            'title'=>'Notifikasi Jaringana',
                            'message'=>$message,
                        ];
                        Mail::to($data_akun->akun_email)->send(new SendMailJaringan($data_jaringan));
                    }
                }
            }
        }
        else{
            $status = 'gagal';
            // kirim broadcast ke banuak email
            $data_jaringan = [
                'title'=>'Notifikasi Jaringan',
                'message'=>'Koneksi Ke Mikrotik Terputus',
            ];
            Mail::to($data_akun->akun_email)->send(new SendMailJaringan($data_jaringan));
        }

        $data = [
            'status'=>$status,
        ];

        return response()->json($data);
    }
}
