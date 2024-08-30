<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainteContoroller extends Controller
{
    public function index()
    {
        return view('mykart.index');

    }
}
