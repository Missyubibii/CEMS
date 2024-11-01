<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Hiển thị trang login
    public function index()
    {
        return view('login');
    }

    // Xác thực tài khoản đăng nhập
    public function authenticate(Request $request)
    {
        // Kiểm tra các điều kiện đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Nếu xác thực không thành công
        if ($validator->fails()) {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validator);
        }

        // Thực hiện đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard
            return redirect()->route('account.dashboard');
        } else {
            // Đăng nhập thất bại, trả về trang login với thông báo lỗi
            return redirect()->route('account.login')
                ->withInput()
                ->with('error', '*Tên email hoặc mật khẩu không chính xác, vui lòng kiểm tra và đăng nhập lại*');
        }
    }

    // Hiển thị trang đăng ký
    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $request){
         // Kiểm tra các điều kiện đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'password' => 'required|min:8',
            'password_confirmation' => 'required',
        ]);
    
        // Nếu xác thực không thành công
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->role = 'Giáo viên';
            $user->save();

            return redirect()->route('account.login')-> with('success','Đăng ký tài khoản thành công.');
        }else{
            // Sau khi lưu thành công, chuyển hướng đến trang login
            return redirect()->route('account.register')
            ->withInput()
            ->withErrors($validator);
        }
    
        // Nếu xác thực thành công, thực hiện lưu tài khoản
        // Thêm mã để lưu thông tin người dùng vào database tại đây
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('account.login')->with('success','Đăng xuất thành công.');
    }
    
}
