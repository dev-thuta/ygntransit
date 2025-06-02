<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function guide()
    {
        return view('front.guide');
    }

    public function home()
    {
        return view('front.home');
    }
}
