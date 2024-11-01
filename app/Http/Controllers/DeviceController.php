<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all(); // Lấy tất cả thiết bị từ database
        return view('admin.dashboard', compact('devices')); // Truyền biến $devices vào view
    }    

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'device_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:Chưa sử dụng,Đang sử dụng,Đang bảo trì,Hỏng hóc',
        ]);
    
        // Thêm thiết bị
        $device = new Device();
        $device->device_name = $validatedData['device_name'];
        $device->quantity = $validatedData['quantity'];
        $device->category = $validatedData['category'];
        $device->status = $validatedData['status'];
        $device->save();
    
        return back()->with('success', 'Thiết bị đã được thêm thành công!');
    }
    

public function update(Request $request, $id)
{
    // Xác thực dữ liệu
    $validatedData = $request->validate([
        'device_name' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'category' => 'required|string|max:255',
        'status' => 'required|string|in:Chưa sử dụng,Đang sử dụng,Đang bảo trì,Hỏng hóc',
    ]);

    // Cập nhật thiết bị
    $device = Device::find($id);
    if (!$device) {
        return response()->json(['success' => false, 'message' => 'Thiết bị không tồn tại.']);
    }
    $device->update($validatedData);

    return response()->json(['success' => true, 'message' => 'Cập nhật thiết bị thành công.']);
}

public function destroy($id)
{
    Device::destroy($id);
    return back()->with('success', 'Thiết bị đã được xóa thành công!');
}

}
