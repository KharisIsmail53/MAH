<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KKWController extends Controller
{
    public function index()
    {
        return view('kkw.dashboard-kkw',['type_menu'=>'dashboard']);
    }
}
