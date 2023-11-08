<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BMMController extends Controller
{
    public function index()
    {
        return view('bmm.dashboard-bmm',['type_menu'=>'dashboard']);
    }
}
