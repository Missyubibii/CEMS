<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Hiển thị trang quản trị viên đăng nhập
    public function index(){
        return view('admin.Login');
    }

    public function authenticate(Request $request)
    {
        // Kiểm tra các điều kiện đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Nếu xác thực không thành công
        if ($validator->fails()) {
            return redirect()->route('admin.login')
                ->withInput()
                ->withErrors($validator);
        }

        // Thực hiện đăng nhập
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Kiểm tra vai trò của người dùng
            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', '*Bạn không có quyền truy cập vào trang này*');
            }
            // Đăng nhập thành công, chuyển hướng đến trang dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // Đăng nhập thất bại, trả về trang login với thông báo lỗi
            return redirect()->route('admin.login')
                ->withInput()
                ->with('error', '*Tên email hoặc mật khẩu không chính xác, vui lòng kiểm tra và đăng nhập lại*');
        }
    }
    //Thực hiện đăng xuất cho quản trị viên
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
