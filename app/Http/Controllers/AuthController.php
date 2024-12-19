<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if(Auth::guard('siswa')->attempt(['nis'=>$request->nis,'password'=>$request->password])){
            return redirect('/dashboard');
        }else{
            return redirect('/')->with(['warning'=>'Nis / Password Salah']);
        }
    }
    public function proseslogout()
    {
        if(Auth::guard('siswa')->check()){
            Auth::guard('siswa')->logout();
            return redirect('/');
        }
    }
    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }
    public function prosesloginadmin(Request $request)
    {
        if(Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/panel/dashboardadmin');
        }else{
            return redirect('/panel')->with(['warning'=>'email / Password Salah']);
        }
    }
}
