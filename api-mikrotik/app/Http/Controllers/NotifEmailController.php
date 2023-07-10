<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use App\Mail\SendMailNotif;
use App\Models\NotifEmail;
use App\Models\RouterOsApi;

class NotifEmailController extends Controller
{
    public function add_email()
    {
        return view('Auth.notif.add_email');
    }
    public function notif_email(Request $request)
    {
        // dd($request);
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal ditambahkan, Jam atau Manit harus lebih dari 0');
        }
        $insert_data = NotifEmail::create([
            'id_adm'=>Auth()->user()->id,
            'akun_email'=>$request->akun_email,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil ditambahkan');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal ditambahkan');
        }
    }
    public function patch_email($id,Request $request)
    {
        // dd($id,$request);
        if ($request->jam<=0&&$request->menit<=0) {
            return redirect()->back()->with('gagal','Data notif Email gagal diubah, Jam atau Manit harus lebih dari 0');
        }
        $insert_data = NotifEmail::
        where('id',$id)->
        update([
            'id_adm'=>Auth()->user()->id,
            'akun_email'=>$request->akun_email,
            'jam'=>$request->jam,
            'menit'=>$request->menit,
        ]);

        if ($insert_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil diubah');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal diubah');
        }
    }
    public function delete_email($id){
        $delete_data = NotifEmail::
        where('id',$id)->
        delete();
        DB::statement('alter table notif_email auto_increment=0');

        if ($delete_data) {
            return redirect('choice/notif_akun')->with('sukses','Data notif Email berhasil dihapus');
        }
        else{
            return redirect('choice/notif_akun')->with('gagal','Data notif Email gagal dihapus');
        }
    }
    public function edit_email($id)
    {
        $data = [
            'data' => NotifEmail::find($id),
        ];
        return view('Auth.notif.edit_email',compact('data'));
    }
    public function test_email()
    {
        $email = 'emailtujuan@hotmail.com';
        $data = [
            'title' => 'Data Rekap Monitoring Mikrotik',
        ];
        Mail::to($email)->send(new SendMail($data));
        return 'Berhasil mengirim email!';
    }
    public function test_sinyal()
    {
        $status=false;
        if (request()->data) {
            $status= true;
            $data_akun = NotifEmail::find(request()->data);
            $data = [
                'title'=>'Test Ketersediaan Data',
            ];
            Mail::to($data_akun->akun_email)->send(new SendMail($data));
        }
        else{
            $status = false;
        }
        $data = [
            'data_id'=>request()->data,
            'status'=>$status,
        ];
        return response()->json($data,200);
    }
    public function kirim_notif()
    {
        // dd('"ggg');
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

            $data_akun = NotifEmail::find(request()->id);

            $data_periodik = [
                'title'=>'Data Periodik',
                'ip'=>session()->get('ip'),
                'user'=>session()->get('user'),
                'password'=>session()->get('password'),
                'data'=>$this->isi(),
            ];

            Mail::to($data_akun->akun_email)->send(new SendMailNotif($data_periodik));
            return response()->json($data_periodik);
        }
        else{
            $data=[
                'status'=>'tidak',
            ];
            return response()->json($data);
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
