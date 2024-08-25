<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function indexchat(Request $request)
    {
        $datos = json_decode($request->input('datos'));
        return view('chat', compact('datos'));
    }

    public function indexchat2(Request $request)
    {
        // $datos = json_decode($request->input('datos'));
        return view('chat2');
    }

    // public function indexchat(Request $request)
    // {
    //      $datos = $request->input('datos');
    //      return view('chat.index', compact('datos'));
    // }
    // public function indexchat(){
    //     return view('chat.index');
    // }
    public function index(){
        return view('inicio');
    }

   
}
