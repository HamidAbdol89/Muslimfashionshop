<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviewss', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Đảm bảo kiểu dữ liệu unsignedBigInteger
            $table->string('user_name');
            $table->integer('rating')->comment('Đánh giá từ 1 đến 5 sao');
            $table->text('comment')->nullable();
            $table->timestamps();
        
            // Khóa ngoại
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviewss');
    }
};
