<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Hiển thị trang chính cho quản trị viên
    // public function index(){
    //     return view('admin.dashboard');
    // }

    public function index()
    {
        $devices = device::all(); // Lấy tất cả thiết bị từ database
        return view('admin.dashboard', compact('devices')); // Truyền biến $devices vào view
    }

}
