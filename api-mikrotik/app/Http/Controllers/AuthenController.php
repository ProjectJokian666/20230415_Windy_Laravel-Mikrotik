<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;
use App\Models\Login;
use App\Models\Notif;

use App\Models\RouterOsApi;

class AuthenController extends Controller
{   
    public function login()
    {   
        $this->auto_login(request());
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
                ->cookie('email',$request->username,1000000,'/')
                ->cookie('password',$request->password,1000000,'/')
                ;
            }
            else{
                Auth::logout();
                return redirect()->route('login')->with('gagal','Login Gagal!!!, Silahkan Daftar Terlebih Dahulu')
                ->withoutCookie('email')
                ->withoutCookie('password')
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
            return redirect()->intended('choice')
            ->cookie('email',$request->username,1000000,'/')
            ->cookie('password',$request->password,1000000,'/')
            ;
        }
        else{
            Auth::logout();
            return redirect('login')->with('gagal','Login Gagal!!!, Silahkan Daftar Terlebih Dahulu')
            ->withoutCookie('email')
            ->withoutCookie('password')
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
        return redirect()->route('login')->with('sukses','Silahkan Login')
        ->with('sukses','Silahkan Login Untuk Melanjutkan')
        ->withoutCookie('email')
        ->withoutCookie('password')
        ;
    }
    public function choice(Request $request)
    {   
        return view('Auth.choice');
    }
    public function list_akun()
    {
        $data = [
            'list_akun' => Login::all(),
        ];
        return view('Auth.list_akun',compact('data'));
    }
    public function list_akun_id($id)
    {
        $data = Login::find($id);
        // dd($id,$data);

        $API = new RouterOsApi();
        // dd($API->debug,$API);
        $API->debug = false;
        // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"),$API->connect("id-17.hostddns.us:10269","windy","admin1"));
        if ($API->connect($data->ip, $data->user, $data->password)) {
            request()->session()->put($data);
            $this->insert_data_login_dan_check_data();
            return redirect('/');
        }
        else{
            // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"));
            return redirect()->route('choice.list_akun');
        }
    }
    public function login_akun()
    {   
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
        // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"),$API->connect("id-26.hostddns.us:7871","chosyi","12345"));
        if ($API->connect($request->ip, $request->user, $request->password)) {
            $request->session()->put($data);
            $this->insert_data_login_dan_check_data();
            return redirect('/');
        }
        else{
            // dd($request,$API->connect($request->ip,$request->user,$request->password),$API->connect("id-31.hostddns.us:5915","windy","admin"));
            return redirect()->route('choice.login_akun');
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
    public function notif_akun()
    {   
        $cek_data = Notif::find(1);
        //cek data
        // dd($cek_data==null);
        if ($cek_data==null) {
            //jika data kosong maka akan diinsert dahulu
            $input_data = Notif::create([
                "id" => "1",
            ]);
        }
        $data = [
            'notif' => Notif::find(1),
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
}
