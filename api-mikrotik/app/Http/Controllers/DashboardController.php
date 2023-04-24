<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
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
}
