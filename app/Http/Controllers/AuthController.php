<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'required'
        ]);

        $arr = DB::select('select * from users where username = :username', ['username' => $request->input('username')]);

        if(!empty($arr)){
            if (Hash::check($request->input('password'), $arr[0]->password)) {
                $request->session()->put('username', $arr[0]->username);
                $request->session()->put('id', $arr[0]->id);
                // DEV SERVER: DEVLOGIN
                // $_SERVER['HTTP_CF_CONNECTING_IP']
                DB::insert('insert into ips (ip, username, time) values (?, ?, CURRENT_TIMESTAMP)', ["DEVLOGIN", $request->session()->get('id')]);
                return redirect()->route('index');
            } else {
                return redirect()->route('account', ['error' => 1]);
            }
        } else {
            return redirect()->route('account', ['error' => 1]);
        }
    }

    public function Logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate(true);
        return redirect()->route('account');
    }

    public function Register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:128',
            'password' => 'required|min:6'
        ]);

        if($request->session()->get('id') == ""){
            $arr = app('db')->select('select * from users where username = :username or email = :email', ['username' => $request->input('username'), 'email' => $request->input('email')]);
            if(empty($arr)){
                DB::insert('insert into users (username, password, email) values (?, ?, ?)', [$request->input('username'), Hash::make($request->input('password')), $request->input('email')]);
                return redirect()->route('account');
            } else {
                return redirect()->route('register', ['error' => 1]);
            }
        } else {
            return redirect()->route('register', ['error' => 1]);
        }
    }

    public function Settings(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:128'
        ]);

        if($request->session()->get('id') == ""){
            return redirect()->route('account', ['error' => 1]);
        } else {
            $arr = app('db')->select('select * from users where email = :email', ['email' => $request->input('email')]);
            if(empty($arr)){
                DB::update('update users set email = :email where id = :id', ['email' => $request->input('email'), 'id' => $request->session()->get('id')]);
                return redirect()->route('account');
            } else {
                return redirect()->route('account', ['error' => 1]);
            }
        }
    }

    public function Password(Request $request)
    {
        $this->validate($request, [
            'oldpass' => 'required',
            'newpass' => 'required|min:6'
        ]);

        if($request->session()->get('id') == ""){
            return redirect()->route('account', ['error' => 1]);
        } else {
            $arr = app('db')->select('select * from users where id = :id', ['id' => $request->session()->get('id')]);
            if(Hash::check($request->input('oldpass'), $arr[0]->password)){
                DB::update('update users set password = :password where id = :id', ['password' => Hash::make($request->input('newpass')), 'id' => $request->session()->get('id')]);
                return redirect()->route('account');
            } else {
                return redirect()->route('account', ['error' => 1]);
            }
        }
    }
}