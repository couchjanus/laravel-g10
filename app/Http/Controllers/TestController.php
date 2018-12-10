<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TestController extends Controller {

    public function index()       {
        return view('test');
    }

    public function fooIndex()       {
        return view('test');
    }

    public function barIndex()       {
        return view('hello')->with('name', 'Janus Nic');
    }

    public function baxIndex()       {
        return view('hello')->withName('Janus Nic With Name');
    }

    public function bazIndex()       {
        if (view()->exists('hello')) {
            return view('hello', ['name' => 'Janus Nic As Name']);
        }
    }

    public function bazukaIndex()   	{
        if (view()->exists('bazuka')) {
            $fooUrl = url('foobar');
            return view('bazuka', ['name' => 'Janus Nic As Name', 'fooUrl'=>$fooUrl]);
        }
    }

}
