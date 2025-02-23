<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaiChamsocTable extends Migration
{
    public function up()
    {
        Schema::create('vai_chamsoc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Khóa ngoại liên kết với bảng sản phẩm
            $table->string('vai');
            $table->text('cham_soc_vai');
            $table->decimal('trong_luong_vai', 10, 2);
            $table->string('ma_vai', 50);
            $table->timestamps();

            // Tạo khóa ngoại
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vai_chamsoc');
    }
}
