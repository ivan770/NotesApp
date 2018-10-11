<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function New(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required|max:5000',
            'public' => 'required|in:true,false'
        ]);

        if($request->session()->get('id') == ""){
            return "Error";
        } else {
            DB::insert('insert into notes (title, body, public, owner) values (?, ?, ?, ?)', [$request->input('title'), $request->input('body'), $request->input('public'), $request->session()->get('id')]);
            return "OK";
        }
    }

    public function Delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        if($request->session()->get('id') == ""){
            return "Error";
        } else {
            DB::delete('delete from notes where id = :id and owner = :owner', ['id' => $request->input('id'), 'owner' => $request->session()->get('id')]);
            return "OK";
        }
    }

    public function Get(Request $request)
    {
        if($request->session()->get('id') == ""){
            return "Error";
        } else {
            $arr = DB::select('select id,title,body,public from notes where owner = :owner order by id desc', ['owner' => $request->session()->get('id')]);
            return response()->json($arr);
        }
    }

    public function Edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'body' => 'required|max:5000'
        ]);

        if($request->session()->get('id') == ""){
            return redirect()->route('account', ['error' => 1]);
        } else {
            $arr = DB::update('update notes set body = :body where id = :id and owner = :owner', ['body' => $request->input('body'), 'id' => $request->input('id'), 'owner' => $request->session()->get('id')]);
            return redirect()->route('index');
        }
    }
}