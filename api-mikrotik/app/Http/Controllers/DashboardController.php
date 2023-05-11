<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouterOsApi;
use App\Models\RouterOsApi2;

class DashboardController extends Controller
{   
    public function index()
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
            // dd($data);
        //     return response()->json($uptime['0']['uptime'],200);
        }
        $data = [
            'interface' => $data_interface
        ];
        // dd($data);
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

        // dd($hasil_log);

        $limit = is_null($request["length"]) ? 10 : $request["length"];
        $offset = is_null($request["start"]) ? 0 : $request["start"];
        $draw = $request["draw"];
        
        // dd($request->search);

        $search = is_null($request->search) ? '' : $request->search['value'];

        // if (!empty($search)) {
        //     $data_log = $data_log
        //     ->where('time','LIKE','%'.$search.'%')
        //     orWhere('topic','LIKE','%'.$search.'%')
        //     orWhere('message','LIKE','%'.$search.'%');
        // }

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
}
