<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if ($user->divisi === 'DKM') {
               return redirect('dashboard-dkm');   
            }
            else if ($user->divisi === 'KKW') {
                return redirect('dashboard-kkw');   
             }
            else if ($user->divisi === 'BMM') {
                return redirect('dashboard-bmm');   
             }
            else if ($user->divisi === 'Zakat') {
                return redirect('dashboard-zakat');   
            }else{
                return view('login.login');
            }
        }else{
            return view('login.login');
        }
    }

    public function actionlogin(Request $request)
    {
        // $data = [
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        // ];
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd(Auth::Attempt($data));
        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            $user = auth()->user();
            session(['user_name' => $user->name]);
            if (auth()->user()->divisi == 'KKW') {
                // dd(user()->divisi);
                
                return redirect()->route('dashboard-kkw');   
             }
             else if (auth()->user()->divisi == 'DKM') {
                //  return redirect('dashboard-dkm');
                 return redirect()->route('dashboard-dkm');   
              }
             else if (auth()->user()->divisi == 'BMM') {
                //  return redirect('dashboard-bmm');
                 return redirect()->route('dashboard-bmm');   
              }
             else if (auth()->user()->divisi == 'Zakat') {
                return redirect()->route('dashboard-zakat');   
             }else{
                return redirect()->back();
             }  
        }else{
            session()->flash('error', 'Email atau Password Salah');
            return redirect()->back();
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
