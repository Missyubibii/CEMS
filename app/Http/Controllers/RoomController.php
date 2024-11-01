<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all(); // Lấy tất cả thiết bị từ database
        return view('admin.dashboard', compact('rooms')); // Truyền biến $devices vào view
    }    

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'room_name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:Còn trống,Đang sử dụng,Đang bảo trì,Hỏng hóc',
        ]);
    
        // Thêm thiết bị
        $room = new room();
        $room->room_name = $validatedData['room_name'];
        $room->capacity = $validatedData['capacity'];
        $room->location = $validatedData['location'];
        $room->status = $validatedData['status'];
        $room->save();
    
        return back()->with('success', 'Phòng học đã được thêm thành công!');
    }
    

public function update(Request $request, $id)
{
    // Xác thực dữ liệu
    $validatedData = $request->validate([
        'room_name' => 'required|string|max:255',
        'capacity' => 'required|integer',
        'location' => 'required|string|max:255',
        'status' => 'required|string|in:Còn trống,Đang sử dụng,Đang bảo trì,Hỏng hóc',
    ]);

    // Cập nhật thiết bị
    $room = room::find($id);
    if (!$room) {
        return response()->json(['success' => false, 'message' => 'Phòng học không tồn tại.']);
    }
    $room->update($validatedData);

    return response()->json(['success' => true, 'message' => 'Cập nhật phòng học thành công.']);
}

public function destroy($id)
{
    room::destroy($id);
    return back()->with('success', 'Phòng học đã được xóa thành công!');
}

}

