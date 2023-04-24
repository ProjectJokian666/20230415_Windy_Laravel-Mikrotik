<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }
    public function register()
    {
        return view('Auth.register');
    }
    public function choice()
    {
        return view('Auth.choice');
    }
    public function list_akun()
    {
        return view('Auth.list_akun');
    }
    public function login_akun()
    {
        return view('Auth.login_akun');
    }
}
