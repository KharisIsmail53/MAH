<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DKMController extends Controller
{
    public function index()
    {
        return view('dkm.dashboard-dkm',['type_menu'=>'dashboard']);
    }
}
