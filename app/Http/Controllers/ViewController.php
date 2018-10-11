<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function Main(Request $request)
    {
        if($request->session()->get('id') == ""){
            return view('index', ['username' => 'Account', 'auth' => false]);
        } else {
            $arr = DB::select('select * from notes where owner = :owner order by id desc', ['owner' => $request->session()->get('id')]);
            return view('index', ['username' => $request->session()->get('username'), 'notes' => $arr, 'auth' => true]);
        }
    }

    public function Account(Request $request)
    {
        if($request->session()->get('id') == ""){
            return view('login', ['error' => $request->error]);
        } else {
            $arr = DB::select('select * from users where id = :id', ['id' => $request->session()->get('id')]);
            $ip = DB::select('select * from ips where username = :username order by id desc limit 10', ['username' => $request->session()->get('id')]);
            return view('account', ['username' => $request->session()->get('username'), 'email' => $arr[0]->email, 'ips' => $ip]);
        }
    }

    public function Register(Request $request)
    {
        if($request->session()->get('id') == ""){
            return view('register', ['error' => $request->error]);
        } else {
            return redirect()->route('index');
        }
    }

    public function Public(Request $request, $id)
    {
        $arr = DB::select('select * from notes where id = :id and public = "true"', ['id' => $id]);
        return view('public', ['notes' => $arr]);
    }

    public function Settings(Request $request)
    {
        if($request->session()->get('id') == ""){
            return redirect()->route('account', ['error' => 1]);
        } else {
            $arr = DB::select('select * from users where id = :id', ['id' => $request->session()->get('id')]);
            return view('settings', ['username' => $request->session()->get('username'), 'email' => $arr[0]->email]);
        }
    }

    public function Edit(Request $request, $id)
    {
        if($request->session()->get('id') == ""){
            return redirect()->route('account', ['error' => 1]);
        } else {
            $arr = DB::select('select * from notes where owner = :owner and id = :id', ['owner' => $request->session()->get('id'), 'id' => $id]);
            if(!empty($arr)){
                return view('edit', ['username' => $request->session()->get('username'), 'note' => $arr[0]->body, 'title' => $arr[0]->title, 'id' => $arr[0]->id]);
            } else {
                return redirect()->route('index');
            }
        }
    }
}