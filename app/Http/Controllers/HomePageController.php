<?php

namespace App\Http\Controllers;

class HomePageController extends Controller
{
    public function home(): object
    {
        return view('home');
    }
}
