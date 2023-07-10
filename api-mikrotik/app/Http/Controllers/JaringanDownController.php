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
        $status = "gagal kirim jaringan";

        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        // $ip = "12axa";

        $API = new RouterOsApi();
        $API->debug = false;
        $data_jaringan=[];
        $data_jaringan_tx=[];
        $data_jaringan_rx=[];
        $data_akun = NotifEmail::find(request()->id);

        if ($API->connect($ip, $user, $password)) {
            $status = 'sukses kirim jaringan';

            $interface = $API->comm('/interface/print');
            foreach($interface as $i){
                if ($i['type']=="ether") {
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));

                    $tx=$data_ether[0]['tx-bits-per-second'];
                    $rx=$data_ether[0]['rx-bits-per-second'];

                    // cek session untuk ether
                    $ether_tx = session()->get('status_tx_'.$i['default-name']);
                    $status_tx = "up";
                    if ($tx==0) {
                        $status_tx="down";
                    }
                    if ($ether_tx!=$status_tx) {
                        $message = "Bandwidth Transfer pada ".$i['default-name'].' mengalami '.$status_tx.' yang sebelumnya '.$ether_tx;
                        $data_jaringan_tx = [
                            'title'=>'Notifikasi Jaringan',
                            'message'=>$message,
                            'status_tx'=>$status_tx,
                        ];
                        Mail::to($data_akun->akun_email)->send(new SendMailJaringan($data_jaringan_tx));
                        session()->put('status_tx_'.$i['default-name'],$status_tx);
                    }

                    // $status_tx = session()->get($ether);
                    // session()->put('status_coba','aaa');
                    
                    $ether_rx = session()->get('status_rx_'.$i['default-name']);
                    $status_rx = "up";
                    if ($rx==0) {
                        $status_rx="down";
                    }
                    if ($ether_rx!=$status_rx) {
                        $message = "Bandwidth Receiver pada ".$i['default-name'].' mengalami '.$status_rx.' yang sebelumnya '.$ether_rx;
                        $data_jaringan_rx = [
                            'title'=>'Notifikasi Jaringan',
                            'message'=>$message,
                            'status_tx'=>$status_rx,
                        ];
                        Mail::to($data_akun->akun_email)->send(new SendMailJaringan($data_jaringan_rx));
                        session()->put('status_rx_'.$i['default-name'],$status_rx);
                    }

                    // cek kondisi ether

                }
            }
        }
        else{
            $status = 'gagal kirim jaringan';
            // kirim broadcast ke banuak email
            $data_jaringan = [
                'title'=>'Notifikasi Jaringan',
                'message'=>'Koneksi Ke Mikrotik Terputus',
            ];
            Mail::to($data_akun->akun_email)->send(new SendMailJaringan($data_jaringan));
        }

        $data = [
            'status'=>$status,
            'data_jaringan'=>$data_jaringan,
            'data_jaringan_tx'=>$data_jaringan_tx,
            'data_jaringan_rx'=>$data_jaringan_rx,
            'status_coba'=>session()->get('status_coba'),
        ];
        // dd($data);
        return response()->json($data);
    }
}
