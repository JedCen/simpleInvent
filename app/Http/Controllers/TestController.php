<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        return view('inventario.test');
    }
}
