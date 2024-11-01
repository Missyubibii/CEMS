<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Hiển thị trang chính cho người dùng
    public function index(){
        return view('dashboard');
    }
}
