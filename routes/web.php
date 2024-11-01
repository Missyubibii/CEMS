<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReadMoreController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'account'], function () {
    // Kiểm tra tài khoản đăng nhập, đăng ký,...
    Route::group(['middleware'=> 'guest'], function () {
        Route::get('login', [LoginController::class, 'index']) -> name('account.login');
        Route::get('register', [LoginController::class, 'register']) -> name('account.register');
        Route::post('process-register', [LoginController::class, 'processRegister']) -> name('account.processRegister');
        Route::post('authenticate', [LoginController::class, 'authenticate']) -> name('account.authenticate');
        Route::get('readmore', [ReadMoreController::class, 'index'])->name('account.readmore');
    });
    
    Route::group(['middleware'=> 'auth'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout']) -> name('account.logout');
    });
});


Route::group(['prefix'=> 'admin'], function () {
    // Kiểm tra tài khoản đăng nhập, đăng ký,... cho quản trị viên
    Route::group(['middleware'=> 'admin.guest'], function () {
        Route::get('login', [AdminLoginController::class, 'index']) -> name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate']) -> name('admin.authenticate');

    });
    
    Route::group(['middleware'=> 'admin.auth'], function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout']) -> name('admin.logout');

          // Các route quản lý thiết bị
        Route::get('devices', [DeviceController::class, 'index'])->name('admin.devices');
        Route::post('devices/store', [DeviceController::class, 'store'])->name('admin.devices.store');
        Route::put('/admin/devices/update/{id}', [DeviceController::class, 'update'])->name('admin.devices.update');
        Route::delete('devices/delete/{id}', [DeviceController::class, 'destroy'])->name('admin.devices.delete');

                  // Các route quản lý phòng học
        Route::get('rooms', [RoomController::class, 'index'])->name('admin.rooms');
        Route::post('rooms/store', [RoomController::class, 'store'])->name('admin.rooms.store');
        Route::put('/admin/rooms/update/{id}', [RoomController::class, 'update'])->name('admin.rooms.update');
        Route::delete('rooms/delete/{id}', [RoomController::class, 'destroy'])->name('admin.rooms.delete');
    });
});







