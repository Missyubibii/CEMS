<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadMoreController extends Controller
{
    public function index(){
        return view('readmore');
    }
}
