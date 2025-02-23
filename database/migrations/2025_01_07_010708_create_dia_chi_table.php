<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dia_chi', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->unsignedBigInteger('user_id'); // ID người dùng (khóa ngoại)
            $table->string('ten_nguoi_nhan', 100); // Tên người nhận
            $table->text('dia_chi'); // Địa chỉ
            $table->string('so_dien_thoai', 15); // Số điện thoại
            $table->string('thanh_pho', 100); // Thành phố
            $table->timestamps(); // Ngày tạo và ngày cập nhật

            // Tạo khóa ngoại liên kết với bảng nguoi_dung
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_chi');
    }
};
