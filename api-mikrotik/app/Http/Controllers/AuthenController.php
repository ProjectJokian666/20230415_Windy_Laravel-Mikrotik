<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Login;
use App\Models\NotifWa;
use App\Models\NotifEmail;

use App\Models\RouterOsApi;
use Twilio\Rest\Client;

use App\Mail\SendMailNotif;

class AuthenController extends Controller
{   
    const status_login_akun = false;
    public function __construct(){

    }

    public function login()
    {   
        // if (Auth()) {
        //     dd(Auth());
        // }
        // $this->auto_login(request());
        if (request()->cookie('status_login')&&request()->cookie('email')&&request()->cookie('password')) {
            if (Auth::attempt(['email'=>request()->cookie('email'),'password'=>request()->cookie('password')])) {
                request()->session()->regenerate();
                return redirect()->intended('choice')
                ->cookie('email',request()->cookie('email'),1000000,'/')
                ->cookie('password',request()->cookie('password'),1000000,'/')
                ->cookie('status_login','true',1000000,'/')
                ;
            }
            else{
                Auth::logout();
                return redirect()->route('login')->with('gagal','Login Gagal!!!, Silahkan Daftar Terlebih Dahulu')
                ->withoutCookie('email')
                ->withoutCookie('password')
                ->withoutCookie('status_login')
                ;
            }
        }
        return view('Auth.login');
    }

    public function auto_login($data)
    {   
        // dd($data->request()->username);
        if ($data->cookie('email')&&$data->cookie('password')) {
            // return 'ada';
            // dd($data->cookie('email'),$data->cookie('password'),$data);
            if (Auth::attempt(['email'=>$data->cookie('email'),'password'=>$data->cookie('password')])) {
                request()->session()->regenerate();
                return redirect()->intended('choice')
                ->cookie('email',$data->cookie('email'),1000000,'/')
                ->cookie('password',$data->cookie('password'),1000000,'/')
                ->cookie('status_login','true',1000000,'/')
                ;
            }
            else{
                Auth::logout();
                return redirect()->route('login')->with('gagal','Login Gagal!!!, Silahkan Daftar Terlebih Dahulu')
                ->withoutCookie('email')
                ->withoutCookie('password')
                ->withoutCookie('status_login')
                ;
            }
        }
        else{
            return view('Auth.login');
        }
    }

    public function post_login(Request $request)
    {
        // dd($request);
        if (Auth::attempt(['email'=>$request->username,'password'=>$request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('choice')->with('sukses','Silahkan Memilih Menu')
            ->cookie('email',$request->username,1000000,'/')
            ->cookie('password',$request->password,1000000,'/')
            ->cookie('status_login','true',1000000,'/')
            ;
        }
        else{
            Auth::logout();
            return redirect('login')->with('gagal','Login Gagal!!!, Silahkan Daftar Terlebih Dahulu')
            ->withoutCookie('email')
            ->withoutCookie('password')
            ->withoutCookie('status_login')
            ;
        }
    }
    public function register()
    {
        return view('Auth.register');
    }
    public function post_register(Request $request)
    {   
        $cek_data = User::where('email','=',$request->username)->get();
        // dd($cek_data);
        foreach($cek_data as $cd){
            if (Hash::check($request->password,$cd->password)) {
                return redirect()->route('register')->with('gagal','Gagal mendaftar karena data sudah ada');
            }
        }
        $input_data = User::create([
            'email' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        if ($input_data) {
            return redirect()->route('register')->with('sukses','Data Username dan Password berhasil didaftarkan');
        }
        else{
            return redirect()->route('register')->with('gagal','Data Username dan Password gagal didaftarkan');
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')
        ->with('sukses','Silahkan Login Untuk Melanjutkan')
        ->withoutCookie('email')
        ->withoutCookie('password')
        ->withoutCookie('status_login')
        ;
    }
    public function choice(Request $request)
    {
        // $ip = session()->get('ip');
        // $user = session()->get('user');
        // $password = session()->get('password');

        // $API = new RouterOsApi();
        // $API->debug = false;

        // if ($API->connect($ip, $user, $password)) {
        //     return redirect()->route('/');
        // }

        return view('Auth.choice');
    }
    public function list_akun()
    {
        // $ip = session()->get('ip');
        // $user = session()->get('user');
        // $password = session()->get('password');

        // $API = new RouterOsApi();
        // $API->debug = false;

        // if ($API->connect($ip, $user, $password)) {
        //     return redirect()->route('/');
        // }


        $data = [
            'list_akun' => Login::where('id_adm','=',Auth()->user()->id)->get(),
        ];
        return view('Auth.list_akun',compact('data'));
    }
    public function list_akun_id($id)
    {
        $data_login = Login::find($id);
        // dd($id,$data_login);

        $data = [
            'ip' => $data_login->ip,
            'user' => $data_login->username,
            'password' => $data_login->password,
        ];

        $API = new RouterOsApi();
        // dd($API->debug,$API);
        $API->debug = false;
        // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"),$API->connect("id-17.hostddns.us:10269","windy","admin1"));
        if ($API->connect($data_login->ip, $data_login->username, $data_login->password)) {

            // get session interface
            $interface = $API->comm('/interface/print');
            foreach($interface as $i){
                if ($i['type']=='ether') {
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));

                    // dd($data_ether,$i);
                    $data[$i['default-name']]=$data_ether[0]['name'];
                    if ($data_ether[0]['tx-bits-per-second']>0) {
                        $data['status_tx_'.$i['default-name']]="up";
                    }
                    else{
                        $data['status_tx_'.$i['default-name']]="down";
                    }
                    if ($data_ether[0]['rx-bits-per-second']>0) {
                        $data['status_rx_'.$i['default-name']]="up";
                    }
                    else{
                        $data['status_rx_'.$i['default-name']]="down";
                    }
                    // array_push($data,array(
                    //     $i['default-name']=>$data_ether[0]['name'],
                    // ));
                }
            }
            // dd($data);

            request()->session()->put($data);
            return redirect('/');
        }
        else{
            // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"));
            return redirect()->route('choice.list_akun');
        }
    }

    public function kirim_notif_login()
    {
        // dd($data);
        $email_akun = NotifEmail::where('id_adm',Auth()->user()->id)->get();
        foreach ($email_akun as $key => $value) {

            // $data_dikirim = [
            //     'title'=>'Laporan Login',
            //     'ip'=>$data['ip'],
            //     'user'=>$data['user'],
            //     'password'=>$data['password'],
            // ];

            $update_data = NotifEmail::where('id',$value->id)->
            update([
                'time_lock'=>DATE('Y-m-d H:i'),
            ]);

            // Mail::to($value->akun_email)->send(new SendMailNotif($data_dikirim));

        }
    }
    public function kirim_notif_login_wa()
    {
        $wa_akun = NotifWa::where('id_adm',Auth()->user()->id)->get();
        foreach ($wa_akun as $key => $value) {

            $update_data = NotifWa::where('id',$value->id)->
            update([
                'time_lock'=>DATE('Y-m-d H:i'),
            ]);

            // $data_wa = NotifWa::find($value->id);
            // $no_twillio = $data_wa->no_twilio;
            // $acc = $data_wa->account_sid;
            // $token = $data_wa->auth_token;

            // $kirim_notif = new Client($acc,$token);
            // $pesan = "
            // Laporan Login
            // Ip : ".$data["ip"]."
            // User: ".$data["user"]."
            // Password : ".$data["password"];
            // // dd($kirim_notif,$kirim_notif->messages);
            // $no_wa = $data_wa->no_wa;

            // $status = $kirim_notif->messages->create(
            //     "whatsapp:$no_wa",
            //     array(
            //         'from'=> "whatsapp:$no_twillio",
            //         'body'=>$pesan
            //     )
            // );

            // dd($status,$kirim_notif);
        }
    }
    public function kirim_notif_login_sms()
    {
        $sms_akun = NotifSms::where('id_adm',Auth()->user()->id)->get();
        foreach ($sms_akun as $key => $value) {

            $update_data = NotifSms::where('id',$value->id)->
            update([
                'time_lock'=>DATE('Y-m-d H:i'),
            ]);

            // $data_sms = NotifSms::find($value->id);
            // $no_twillio = $data_sms->no_twilio;
            // $acc = $data_sms->account_sid;
            // $token = $data_sms->auth_token;

            // $kirim_notif = new Client($acc,$token);
            // $pesan = "
            // Laporan Login
            // Ip : ".$data["ip"]."
            // User: ".$data["user"]."
            // Password : ".$data["password"];

            // $no_sms = $data_sms->no_sms;

            // $status = $kirim_notif->messages->create(
            //     "$no_sms",
            //     array(
            //         'from'=>"$no_twillio",
            //         'body'=>$pesan
            //     )
            // );

        }
    }

    public function delete_akun_id($id)
    {
        $data_login = Login::find($id)->delete();
        DB::statement("alter table login auto_increment=0");
        return redirect()->route('choice.list_akun');
    }
    public function login_akun()
    {   
        // dd(session()->get('ip'),session()->get('user'),session()->get('password'));
        if (session()->get('ip')&&session()->get('user')&&session()->get('password')) {
            // dd("ada");
            $API = new RouterOsApi();
            $API->debug = false;
            if ($API->connect(session()->get('ip'), session()->get('user'), session()->get('password'))) {
                return redirect('/');
            }
        }
        return view('Auth.login_akun');
    }
    public function post_login_akun(Request $request)
    {
        $data = [
            'ip' => $request->ip,
            'user' => $request->user,
            'password' => $request->password,
        ];
        $API = new RouterOsApi();
        // dd($API->debug,$API);
        $API->debug = false;
        // dd(
        //     $request,
        //     $API->connect($request->ip,$request->user,$request->password),
        //     $API->connect("id-31.hostddns.us:5915","windy","admin"),
        //     $API->connect("id-1.hostddns.us:4959","windy","admin")
        // );
        // dd($data);
        if ($API->connect($request->ip, $request->user, $request->password)) {
            // dd('a');
            $interface = $API->comm('/interface/print');
            foreach($interface as $i){
                if ($i['type']=='ether') {
                    $data_ether = $API->comm('/interface/monitor-traffic',array(
                        'interface'=>$i['default-name'],
                        'once'=>'',
                    ));

                    $data[$i['default-name']]=$data_ether[0]['name'];
                    if ($data_ether[0]['tx-bits-per-second']==0) {
                        'status_tx_'.$i['default-name']="up";
                    }
                    else{
                        'status_tx_'.$i['default-name']="down";
                    }
                    if ($data_ether[0]['rx-bits-per-second']==0) {
                        'status_rx_'.$i['default-name']="up";
                    }
                    else{
                        'status_rx_'.$i['default-name']="down";
                    }
                }
            }
            $request->session()->put($data);
            $this->insert_data_login_dan_check_data();
            return redirect('/');
        }
        else{
            // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"));
            return redirect()->route('choice.login_akun')->with('gagal','login ke monitoring mikrotik gagal');
        }
    }
    private function insert_data_login_dan_check_data(){
        // dd(Auth()->user()->id,session()->get('ip'));
        $check_data = Login::
        where('id_adm','=',Auth()->User()->id)->
        where('ip','=',session()->get('ip'))->
        where('username','=',session()->get('user'))->
        where('password','=',session()->get('password'))->
        first()
        ;
        if ($check_data==null) {
            $input_data = Login::create([
                'id_adm' => Auth()->user()->id,
                'ip' => session()->get('ip'),
                'username' => session()->get('user'),
                'password' => session()->get('password'),
            ]);
            // dd(Auth()->user()->id,session()->get('ip'),'ksong');
        }
    }
    public function logout_akun()
    {
        session()->forget(['ip','user','password']);
        session()->regenerate();
        return redirect('choice');
    }
    public function notif_akun()
    {
        // $ip = session()->get('ip');
        // $user = session()->get('user');
        // $password = session()->get('password');

        // $API = new RouterOsApi();
        // $API->debug = false;

        // if ($API->connect($ip, $user, $password)) {
        //     return redirect()->route('/');
        // }

        // $cek_data = Notif::find(1);
        // //cek data
        // // dd($cek_data==null);
        // if ($cek_data==null) {
        //     //jika data kosong maka akan diinsert dahulu
        //     $input_data = Notif::create([
        //         "id" => "1",
        //     ]);
        // }
        $data = [
            'notifwa' => NotifWa::where('id_adm','=',Auth()->user()->id)->get(),
            'notifemail' => NotifEmail::where('id_adm','=',Auth()->user()->id)->get(),
        ];
        // dd($data);
        return view('Auth.notif_akun',compact('data'));
    }
    public function simpan_notif_akun(Request $request)
    {   
        $update_data = Notif::find(1)->update([
            'wa' => $request->wa,
            'telegram' => $request->tele,
            'email' => $request->email,
        ]);
        if ($update_data) {
            $data = [
                'wa' => $request->wa,
                'tele' => $request->tele,
                'email' => $request->email,
                'sukses'=>"ok"
            ];
            return response()->json($data,200);
        }
        else{
            $data_tetap = Notif::find(1);
            $data = [
                'wa' => $data_tetap->wa,
                'tele' => $data_tetap->telegram,
                'email' => $data_tetap->email,
                'sukses'=>"gagal"
            ];
            return response()->json($data,200);
        }
    }
    public function cek_notif()
    {
        // dd(request()->wa,request()->tele,request()->email);
        $twilio_whatsapp_number = "+14155238886";
        $account_sid = "";
        $auth_token = "";

        $client = new Client($account_sid, $auth_token);
        $message = "Coba Test Pesan Twilio";
        $wa=request()->wa;
        $data = $client->messages->create("whatsapp:$wa", array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));
    }
}
