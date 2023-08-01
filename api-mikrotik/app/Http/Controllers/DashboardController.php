<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterOsApi;
use App\Models\RouterOsApi2;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNotifUpDown;
use App\Mail\SendMailNotif;
use App\Models\NotifEmail;
use Twilio\Rest\Client;
use App\Models\NotifWa;

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
        $status_jaringan='tidak';

        if ($API->connect($ip, $user, $password)) {
            $status = "connect";
            if(session()->get('status')!=$status){
                $status_jaringan='ubah';
                session()->put('status','connect');
            }

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
                        $isi_data=[
                            'title'=>'Notifikasi Jaringan TX',
                            'message'=>$message,
                            'ip'=>$ip,
                            'status_tx'=>$status_tx,
                            'status_ubah'=>'ubah',
                        ];
                        array_push($data_jaringan_tx,$isi_data);
                        session()->put('status_tx_'.$i['default-name'],$status_tx);
                        
                    }
                    else{
                        $message = "Bandwidth Transfer pada ".$i['default-name'].' tetap dalam posisi '.$status_tx;
                        $isi_data=[
                            'title'=>'Notifikasi Jaringan TX',
                            'message'=>$message,
                            'ip'=>$ip,
                            'status_tx'=>$status_tx,
                            'status_ubah'=>'tetap',
                        ];
                        array_push($data_jaringan_tx,$isi_data);
                    }

                    $ether_rx = session()->get('status_rx_'.$i['default-name']);
                    $status_rx = "up";
                    if ($rx==0) {
                        $status_rx="down";
                    }
                    if ($ether_rx!=$status_rx) {
                        $message = "Bandwidth Receiver pada ".$i['default-name'].' mengalami '.$status_rx.' yang sebelumnya '.$ether_rx;
                        $isi_data=[
                            'title'=>'Notifikasi Jaringan RX',
                            'message'=>$message,
                            'ip'=>$ip,
                            'status_tx'=>$status_rx,
                            'status_ubah'=>'ubah',
                        ];
                        array_push($data_jaringan_rx,$isi_data);
                        session()->put('status_rx_'.$i['default-name'],$status_rx);
                        
                    }
                    else{
                        $message = "Bandwidth Receiver pada ".$i['default-name'].' tetap dalam posisi '.$status_rx;
                        $isi_data=[
                            'title'=>'Notifikasi Jaringan RX',
                            'message'=>$message,
                            'ip'=>$ip,
                            'status_tx'=>$status_rx,
                            'status_ubah'=>'tetap',
                        ];
                        array_push($data_jaringan_rx,$isi_data);
                    }
                }
            }

        }
        else{
            $status = "putus";
            if(session()->get('status')!=$status){
                $status_jaringan='ubah';
                session()->put('status','connect');
            }
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
    public function kirim_notif_base_app()
    {
        foreach (NotifEmail::where('id_adm',Auth()->user()->id)->get() as $key => $value) {
            $isi_data=[
                'title'=>request()->get('title'),
                'ip'=>request()->get('ip'),
                'message'=>request()->get('message'),
            ];
            // dd($isi_data);
            Mail::to($value->akun_email)->send(new SendNotifUpDown($isi_data));
        }
        // dd(request());
        foreach (NotifWa::where('id_adm',Auth()->user()->id)->get() as $key => $value) {
            $twilio_whatsapp_number = $value->no_twilio;
            $account_sid = $value->account_sid;
            $auth_token = $value->auth_token;

            $client = new Client($account_sid, $auth_token);

            $message = "
            Data Periodik
            Title ".request()->get('title')."
            Ip ".request()->get('ip')."
            Message ".request()->get('message')
            ;
            $wa=$value->no_wa;

            $data_periodik = $client->messages->create(
                "whatsapp:$wa", 
                array(
                    'from' => "whatsapp:$twilio_whatsapp_number", 
                    'body' => $message
                )
            );
        }
    }
    public function kirim_periodik()
    {
        foreach (NotifEmail::where('id_adm',Auth()->user()->id)->get() as $key => $value) {

            $data_periodik = [
                'title'=>'Data Periodik',
                'ip'=>session()->get('ip'),
                'user'=>session()->get('user'),
                'password'=>session()->get('password'),
                'data'=>$this->isi(),
            ];

            // dd($isi_data);
            // if (DATE('')) {
            //     // code...
            // }
            if (strtotime(DATE('H:i:s',time()+60*60*7))>strtotime($value->mulai)&&strtotime(DATE('H:i:s',time()+60*60*7))<strtotime($value->berakhir)) {
                // code...
                Mail::to($value->akun_email)->send(new SendMailNotif($data_periodik));
                // $data = [
                //     'time_saat_ini'=>DATE('H:i:s',time()+60*60*7),
                //     'mulai'=>$value->mulai,
                //     'berakhir'=>$value->berakhir,
                //     'htung'=>strtotime(DATE('H:i:s',time()+60*60*7)),
                //     'htung_mulai'=>strtotime($value->mulai),
                //     'htung_akhir'=>strtotime($value->berakhir),
                // ];
                // return response()->json($data);
            }
        }
        foreach (NotifWa::where('id_adm',Auth()->user()->id)->get() as $key => $value) {
            if (strtotime(DATE('H:i:s',time()+60*60*7))>strtotime($value->mulai)&&strtotime(DATE('H:i:s',time()+60*60*7))<strtotime($value->berakhir)) {
                $twilio_whatsapp_number = $value->no_twilio;
                $account_sid = $value->account_sid;
                $auth_token = $value->auth_token;

                $client = new Client($account_sid, $auth_token);

                $message = "
                Data Periodik
                Akun ".Auth()->User()->email."
                Ip ".session()->get('ip')."
                User ".session()->get('user')."
                Password ".session()->get('password')
                ;
                $wa=$value->no_wa;

                $data_periodik = $client->messages->create(
                    "whatsapp:$wa", 
                    array(
                        'from' => "whatsapp:$twilio_whatsapp_number", 
                        'body' => $message
                    )
                );
            }
        }
    }
    public function isi()
    {
        $uptime = 0;
        $free_memory = 0;
        $total_memory = 0;
        $cpu = 0;
        $cpu_count = 0;
        $cpu_frequency = 0;
        $cpu_load = 0;
        $free_hdd = 0;
        $total_hdd = 0;
        $since_reboot = 0;
        $total = 0;
        $architecture = 0;
        $board = 0;
        $version = 0;
        $build_time = 0;
        $factory_software = 0;
        $array_interface=[];

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');

                $uptime = $data[0]['uptime'];
                $free_memory = $data[0]['free-memory'];
                $total_memory = $data[0]['total-memory'];
                $cpu = $data[0]['cpu'];
                $cpu_count = $data[0]['cpu-count'];
                $cpu_frequency = $data[0]['cpu-frequency'];
                $cpu_load = $data[0]['cpu-load'];
                $free_hdd = $data[0]['free-hdd-space'];
                $total_hdd = $data[0]['total-hdd-space'];
                $since_reboot = $data[0]['write-sect-since-reboot'];
                $total = $data[0]['write-sect-total'];
                $architecture = $data[0]['architecture-name'];
                $board = $data[0]['board-name'];
                $version = $data[0]['version'];
                $build_time = $data[0]['build-time'];
                $factory_software = $data[0]['factory-software'];

                $interface = $API->comm('/interface/print');
                foreach ($interface as $key => $value) {
                    if ($value['type']=="ether") {
                        $data_ether = $API->comm('/interface/monitor-traffic',array(
                            'interface'=>$value['default-name'],
                            'once'=>'',
                        ));

                        array_push($array_interface,[
                            "name"=>$value['name'],
                            "type"=>$value['type'],
                            "key"=>$value['default-name'],
                            "mac_address"=>$value['mac-address'],
                            "tx" =>formatBytes($data_ether[0]['tx-bits-per-second'],2),
                            "rx" =>formatBytes($data_ether[0]['rx-bits-per-second'],2),
                            "running"=>$value['running'],
                            "disabled"=>$value['disabled'],
                        ]);
                    }
                }
            }
        }
        $data = [
            'uptime'=>$uptime,
            'free_memory'=>formatBytes($free_memory,2),
            'total_memory'=>formatBytes($total_memory,2),
            'cpu'=>$cpu,
            'cpu_count'=>$cpu_count,
            'cpu_frequency'=>$cpu_frequency,
            'cpu_load'=>$cpu_load,
            'free_hdd'=>formatBytes($free_hdd,2),
            'total_hdd'=>formatBytes($total_hdd,2),
            'since_reboot'=>$since_reboot,
            'total'=>$total,
            'architecture'=>$architecture,
            'board'=>$board,
            'version'=>$version,
            'build_time'=>$build_time,
            'factory_software'=>$factory_software,
            'array_interface'=>$array_interface,
            'status'=>'sukses kirim notif',
        ];
        return $data;
        // dd($data);
    }
}
