<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterOsApi;
use App\Models\RouterOsApi2;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{   
    public function index()
    {   
        // dd(
        //     session()->get('ip'),
        //     session()->get('user'),
        //     session()->get('password'),
        // );
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)==false) {
            return redirect()->route('choice.choice');
        }

        $data_interface = array();
        // dd($data);
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            foreach($interface as $i){
                if ($i['type']=="ether") {
                    array_push($data_interface,[
                        "name"=>$i['name'],
                        "type"=>$i['type'],
                        "mac_address"=>$i['mac-address'],
                        "running"=>$i['running'],
                        "disabled"=>$i['disabled'],
                    ]);
                }
            }
            // dd($interface);
        //     return response()->json($uptime['0']['uptime'],200);
        }
        $data = [
            'interface' => $data_interface
        ];
        // dd(
        //     $data,
        //     session()->all(),
        // );
        return view('Mikrotik.index',compact('data'));
    }
    public function interfaces()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)==false) {
            return redirect()->route('choice.choice');
        }

        $data_interface = array();
        // dd($interface);
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            // dd($interface);
            foreach($interface as $i){
                if ($i['type']=="ether") {
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));

                    // dd($data_ether[0]['tx-bits-per-second']);

                    array_push($data_interface,[
                        "name"=>$i['name'],
                        "type"=>$i['type'],
                        "key"=>$i['default-name'],
                        "mac_address"=>$i['mac-address'],
                        "tx" =>formatBytes($data_ether[0]['tx-bits-per-second'],2),
                        "rx" =>formatBytes($data_ether[0]['rx-bits-per-second'],2),
                        "running"=>$i['running'],
                        "disabled"=>$i['disabled'],
                    ]);
                }
            }
            // dd($data_interface);
        }
        $data = [
            'interface' => $data_interface,
        ];
        // dd($data);
        return view('Mikrotik.interfaces',compact('data'));
    }
    public function log()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)==false) {
            return redirect()->route('choice.choice');
        }

        return view('Mikrotik.log');
    }
    public function get_log(Request $request)
    {
        // dd($request);
        $API = new RouterOsApi();
        $API->debug = false;
        
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        if ($API->connect($ip, $user, $password)) {
            $hasil_log = $API->comm("/log/print");
            // foreach($hasil_log as $key => $value){
            //     array_push($data_log,[
            //         'time' => $value['time'],
            //         'topic' => $value['topic'],
            //         'message' => $value['message'],
            //     ]);
            // }
        }


        $limit = is_null($request["length"]) ? 10 : $request["length"];
        $offset = is_null($request["start"]) ? 0 : $request["start"];
        $draw = $request["draw"];
        
        // dd($request->search);

        $search = is_null($request->search) ? '' : $request->search['value'];
        $hasil_log=collect($hasil_log);
        $time1 = is_null(request()->time1) ? '00:00:00' : request()->time1;
        $time2 = is_null(request()->time2) ? '23:59:59' : request()->time2;

        // if (!empty($search)) {
        //     $data_log = $data_log
        //     ->where('time','LIKE','%'.$search.'%')
        //     orWhere('topic','LIKE','%'.$search.'%')
        //     orWhere('message','LIKE','%'.$search.'%');
        // }
        $hasil_log=$hasil_log->where('time','>',$time1)->where('time','<',$time2);
        // dd($time1,$time2,$hasil_log);
        $get_count = count($hasil_log);
        // dd($get_count);
        // $data_log = $data_log
        // ->limit($limit)
        // ->offset($offset)
        // ->get();

        $data=[];
        foreach ($hasil_log as $key => $value) {
            // dd($value);
            $data[]=array(
                'time' => $value['time'],
                'topic' => $value['topics'],
                'message' => $value['message'],
            );
        }

        // dd($data_log);
        $recordsTotal = is_null($get_count) ? 0 : $get_count;
        $recordsFiltered = is_null($get_count) ? 0 : $get_count;

        return response()->json(compact("data", "draw", "recordsTotal", "recordsFiltered"));
    }
    public function realtime_log()
    {
    }
    public function resources()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)==false) {
            return redirect()->route('choice.choice');
        }

        return view('Mikrotik.resources');
    }
    public function update_tx_rx()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        $data_interface = array();
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            // dd($interface);
            foreach($interface as $i){
                if ($i['type']=="ether") {
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));

                    // dd($data_ether[0]['tx-bits-per-second']);

                    array_push($data_interface,[
                        "name"=>$i['name'],
                        "type"=>$i['type'],
                        "key"=>$i['default-name'],
                        "mac_address"=>$i['mac-address'],
                        "tx" =>formatBytes($data_ether[0]['tx-bits-per-second'],2),
                        "rx" =>formatBytes($data_ether[0]['rx-bits-per-second'],2),
                        "running"=>$i['running'],
                        "disabled"=>$i['disabled'],
                    ]);
                }
            }
            // dd($data_interface);
        }

        $data = [
            'interface' => $data_interface,
        ];
        return response()->json($data);
    }
    public function update_notif_web()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        $data_jaringan=[];
        $data_jaringan_tx=[];
        $data_jaringan_rx=[];

        if ($API->connect($ip, $user, $password)) {
            $status = "connect";

            // get data interface
            $interface = $API->comm('/interface/print');
            foreach ($interface as $key => $i) {
                // jika type sama maka eksekusi
                if ($i['type']=='ether') {
                    // dapatkan data ether
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));
                    // mendapatkan data jaringan
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
                        array_push($data_jaringan_tx,[
                            'title'=>'Notifikasi Jaringan TX',
                            'message'=>$message,
                            'status_tx'=>$status_tx,
                            'status_ubah'=>'ubah',
                        ]);
                        session()->put('status_tx_'.$i['default-name'],$status_tx);
                    }
                    else{
                        $message = "Bandwidth Transfer pada ".$i['default-name'].' tetap dalam posisi '.$status_tx;
                        array_push($data_jaringan_tx,[
                            'title'=>'Notifikasi Jaringan TX',
                            'message'=>$message,
                            'status_tx'=>$status_tx,
                            'status_ubah'=>'tetap',
                        ]);
                    }

                    $ether_rx = session()->get('status_rx_'.$i['default-name']);
                    $status_rx = "up";
                    if ($rx==0) {
                        $status_rx="down";
                    }
                    if ($ether_rx!=$status_rx) {
                        $message = "Bandwidth Receiver pada ".$i['default-name'].' mengalami '.$status_rx.' yang sebelumnya '.$ether_rx;
                        array_push($data_jaringan_rx,[
                            'title'=>'Notifikasi Jaringan RX',
                            'message'=>$message,
                            'status_tx'=>$status_rx,
                            'status_ubah'=>'ubah',
                        ]);
                        session()->put('status_rx_'.$i['default-name'],$status_rx);
                    }
                    else{
                        $message = "Bandwidth Receiver pada ".$i['default-name'].' tetap dalam posisi '.$status_rx;
                        array_push($data_jaringan_rx,[
                            'title'=>'Notifikasi Jaringan RX',
                            'message'=>$message,
                            'status_tx'=>$status_rx,
                            'status_ubah'=>'tetap',
                        ]);
                    }
                }
            }

        }
        else{
            $status = "putus";
        }
        if (session()->get('status')!=$status) {
            $status_jaringan='ubah';
            session()->put('status','ubah');
        }
        else{
            $status_jaringan='tidak';
        }

        $data = [
            'status'=>$status,
            'status_jaringan'=>$status_jaringan,
            // 'status'=>'putus',
            // 'status_jaringan'=>'ubah',
            'data_jaringan_tx'=>$data_jaringan_tx,
            'data_jaringan_rx'=>$data_jaringan_rx,
        ];
        return response()->json($data);
    }
}
