<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(): void
    {
        // Bảng người dùng
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('password');
            $table->enum('role', ['admin', 'Giáo viên'])->default('Giáo viên');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        
        // Lịch sử hoặt động của người dùng
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Bảng thiết bị học
        Schema::create('devices', function (Blueprint $table) {
            $table->id(); // Tạo cột devices_id là primary key
            $table->string('device_name', 255); // Tạo cột device_name, kiểu varchar(255)
            $table->integer('quantity'); // Tạo cột quantity, kiểu int
            $table->string('category', 255); // Tạo cột category, kiểu varchar(255)
            $table->enum('status', ['Chưa sử dụng', 'Đang sử dụng', 'Đang bảo trì', 'Hỏng hóc']); // Tạo cột status, kiểu enum
            $table->timestamps(); // Tạo các cột created_at và updated_at
        });

        // Bảng phòng học
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // Khóa chính cho bảng
            $table->string('room_name', 255); // Tên phòng học
            $table->integer('capacity'); // Sức chứa của phòng học
            $table->string('location', 255)->nullable(); // Vị trí phòng học (nếu có)
            $table->enum('status', ['Còn trống', 'Đang sử dụng', 'Đang bảo trì']); // Tình trạng phòng học
            $table->timestamps(); // Thời gian tạo và cập nhật
        });

        // Bảng đặt phòng, thiết bị
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Khóa chính cho bảng
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Liên kết với bảng rooms
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Liên kết với bảng users
            $table->foreignId('device_id')->nullable()->constrained('devices')->onDelete('cascade'); // Liên kết với bảng equipment (nếu có mượn thiết bị)
            $table->timestamp('start_time'); // Thời gian bắt đầu sử dụng
            $table->timestamp('end_time'); // Thời gian kết thúc sử dụng
            $table->text('reason'); // Lý do mượn phòng hoặc thiết bị
            $table->enum('status', ['Chờ duyệt', 'Đã duyệt', 'Hủy bỏ']); // Tình trạng của giao dịch
            $table->timestamps(); // Thời gian tạo và cập nhật
        });

        // Bảng lịch sử thuê mượn phòng, thiết bị của người dùng
        Schema::create('borrows', function (Blueprint $table) {
            $table->id(); // Khóa chính cho bảng
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID của người dùng
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); // ID của phòng học (nếu có)
            $table->foreignId('device_id')->constrained()->onDelete('cascade'); // ID của thiết bị (nếu có)
            $table->timestamp('borrowed_at')->nullable(); // Thời gian mượn
            $table->timestamp('returned_at')->nullable(); // Thời gian trả
            $table->enum('status', ['Đang mượn', 'Đã trả', 'Quá hạn trả']); // Tình trạng mượn
            $table->timestamps(); // Thời gian tạo và cập nhật
        });

        // Bảng bảo trì phòng học, thiết bị học
        Schema::create('repairs', function (Blueprint $table) {
            $table->id(); // Khóa chính cho bảng
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Khóa ngoại liên kết với bảng rooms
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade'); // Khóa ngoại liên kết với bảng devices
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng users
            $table->date('request_date'); // Ngày yêu cầu
            $table->enum('status', ['Chờ xử lý', 'Đang xử lý', 'Hoàn thành']); // Trạng thái xử lý yêu cầu
            $table->text('description'); // Mô tả vấn đề
            $table->timestamps(); // Thời gian tạo và cập nhật
        });

    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        // Xóa bảng theo thứ tự ngược lại để tránh lỗi khóa ngoại
        Schema::dropIfExists('repairs');
        Schema::dropIfExists('borrows');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
    
};
