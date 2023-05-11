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

    //Ether
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
}
