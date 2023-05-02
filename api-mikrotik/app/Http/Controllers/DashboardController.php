<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterOsApi;
use App\Models\RouterOsApi2;

class DashboardController extends Controller
{   
    private function check_login(){
        // dd(Auth()->user());
        // dd(session()->all());
        if (session()->has('ip')==null&&session()->has('user')==null&&session()->has('password')==null) {
            return redirect()->route('choice.login_akun');
        }
    }
    public function index()
    {   
        $this->check_login();
        return view('Mikrotik.index');
    }
    public function interfaces()
    {
        return view('Mikrotik.interfaces');
    }
    public function log()
    {
        return view('Mikrotik.log');
    }

    public function resources()
    {
        return view('Mikrotik.resources');
    }

    public function realtime_uptime()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $uptime = $API->comm('/system/resource/print');

            return response()->json($uptime['0']['uptime'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_free_memory()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $free_memory = $API->comm('/system/resource/print');
            // dd($free_memory);
            return response()->json($free_memory['0']['free-memory'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_total_memory()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $total_memory = $API->comm('/system/resource/print');
            // dd($total_memory);
            return response()->json($total_memory['0']['total-memory'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_cpu()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $cpu = $API->comm('/system/resource/print');
            // dd($cpu);
            return response()->json($cpu['0']['cpu'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_cpu_count()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $cpu_count = $API->comm('/system/resource/print');
            // dd($cpu_count);
            return response()->json($cpu_count['0']['cpu-count'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_cpu_frequency()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $cpu_frequency = $API->comm('/system/resource/print');
            // dd($cpu_frequency);
            return response()->json($cpu_count['0']['cpu-count'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_cpu_load()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $cpu_load = $API->comm('/system/resource/print');
            // dd($cpu_load);
            return response()->json($cpu_load['0']['cpu-load'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_free_hdd()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $total_hdd_space = $API->comm('/system/resource/print');
            // dd($total_hdd_space);
            return response()->json($total_hdd_space['0']['free-hdd-space'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_total_hdd()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $total_hdd = $API->comm('/system/resource/print');
            // dd($total_hdd);
            return response()->json($total_hdd['0']['total-hdd-space'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_since_reboot()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi2();
        $API->debug = false;

        if ($API->connect("id-31.hostddns.us:5915", "windy", "admin")) {

            $total_hdd = $API->comm('/system/resource/print');
            // dd($total_hdd);
            return response()->json($total_hdd['0']['total-hdd-space'],200);
        } 
        else if ($API->connect("id-17.hostddns.us:10269", "windy", "admin")) {

            $total_hdd = $API->comm('/system/resource/print');
            // dd($total_hdd);
            return response()->json($total_hdd['0']['total-hdd-space'],200);
        } else {
            return response()->json('0',200);
        }
    }
    public function realtime_board()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new RouterOsApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

            $board_name = $API->comm('/system/resource/print');
            // dd($board_name);
            return response()->json($board_name['0']['board-name'],200);
        } else {
            return response()->json('0',200);
        }
    }
}
