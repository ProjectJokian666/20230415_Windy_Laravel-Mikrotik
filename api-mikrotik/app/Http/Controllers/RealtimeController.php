<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterOsApi;

class RealtimeController extends Controller
{   
    // Resource
    public function uptime(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['uptime'];
            }
        }

        return view('Mikrotik.realtime.uptime',compact('isi'));
    }
    public function free_memory(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['free-memory'];
            }
        }

        return view('Mikrotik.realtime.free-memory',compact('isi'));
    }
    public function total_memory(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['total-memory'];
            }
        }

        return view('Mikrotik.realtime.total-memory',compact('isi'));
    }
    public function cpu(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['cpu'];
            }
        }

        return view('Mikrotik.realtime.cpu',compact('isi'));
    }
    public function cpu_count(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['cpu-count'];
            }
        }

        return view('Mikrotik.realtime.cpu-count',compact('isi'));
    }
    public function cpu_frequency(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['cpu-frequency'];
            }
        }

        return view('Mikrotik.realtime.cpu-frequency',compact('isi'));
    }
    public function cpu_load(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['cpu-load'];
            }
        }

        return view('Mikrotik.realtime.cpu-load',compact('isi'));
    }
    public function free_hdd(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['free-hdd-space'];
            }
        }

        return view('Mikrotik.realtime.free-hdd-space',compact('isi'));
    }
    public function total_hdd(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['total-hdd-space'];
            }
        }

        return view('Mikrotik.realtime.total-hdd',compact('isi'));
    }
    public function since_reboot(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['write-sect-since-reboot'];
            }
        }

        return view('Mikrotik.realtime.write-sect-since-reboot',compact('isi'));
    }
    public function total(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['write-sect-total'];
            }
        }

        return view('Mikrotik.realtime.write-sect-total',compact('isi'));
    }
    public function architecture(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['architecture-name'];
            }
        }

        return view('Mikrotik.realtime.architecture-name',compact('isi'));
    }
    public function board(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['board-name'];
            }
        }

        return view('Mikrotik.realtime.board-name',compact('isi'));
    }
    public function version(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['version'];
            }
        }

        return view('Mikrotik.realtime.version',compact('isi'));
    }
    public function build_time(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['build-time'];
            }
        }

        return view('Mikrotik.realtime.build-time',compact('isi'));
    }
    public function factory_software(){
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                // dd($data);
                $isi = $data[0]['factory-software'];
            }
        }

        return view('Mikrotik.realtime.factory-software',compact('isi'));
    }

    // Ether
    public function tx($tx)
    {
        $isi = 0;
        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/interface/monitor-traffic',array(
                    'interface'=>$tx,
                    'once'=>'',
                ));
                // dd($data,$tx,$data[0]['tx-bits-per-second']);
                $isi = $data[0]['tx-bits-per-second'];
            }
        }
        // return response()->json($isi,200);
        return view('Mikrotik.realtime.tx',compact('isi'));
    }
    public function rx($rx)
    {
        $isi = 0;

        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/interface/monitor-traffic',array(
                    'interface'=>$rx,
                    'once'=>'',
                ));
                // dd($data,$tx);
                $isi = $data[0]['rx-bits-per-second'];
            }
        }

        return view('Mikrotik.realtime.tx',compact('isi'));
    
    }
    public function resources()
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
            'status'=>'sukses'
        ];
        return response()->json($data);
    }

    // Realtime Traffic
    public function traffic($ether)
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
        $tx = 0;
        $rx = 0;
        if (session()->has('ip')!=null&&session()->has('user')!=null&&session()->has('password')!=null) {
            $ip = session()->get('ip');
            $user = session()->get('user');
            $password = session()->get('password');

            $API = new RouterOsApi();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $data = $API->comm('/system/resource/print');
                $data_ether = $API->comm('/interface/monitor-traffic',array(
                    'interface'=>$ether,
                    'once'=>'',
                ));

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
                $tx = $data_ether[0]['tx-bits-per-second'];
                $rx = $data_ether[0]['rx-bits-per-second'];
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
            'tx'=>$tx,
            'angka_tx'=>formatBytes($tx,2),
            'rx'=>$rx,
            'angka_rx'=>formatBytes($rx,2),
            'status'=>'sukses'
        ];
        return response()->json($data);
    }
}
