<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home'); // resources/views/home.blade.php
    }

    public function about()
    {
        return view('about'); // resources/views/about.blade.php
    }
}
