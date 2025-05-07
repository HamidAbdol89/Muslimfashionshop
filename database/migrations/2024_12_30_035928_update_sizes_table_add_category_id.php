<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSizesTableAddCategoryId extends Migration
{
    public function up()
    {
        Schema::table('sizes', function (Blueprint $table) {
            // Bước 1: Xóa foreign key trước khi xóa cột
            $table->dropForeign(['product_id']);  // Xóa khóa ngoại của product_id

            // Bước 2: Xóa cột product_id
            $table->dropColumn('product_id');  // Xóa cột product_id

            // Bước 3: Thêm cột category_id
            $table->unsignedBigInteger('category_id')->after('id');

            // Bước 4: Tạo khóa ngoại cho category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('sizes', function (Blueprint $table) {
            // Bước 1: Xóa khóa ngoại của category_id
            $table->dropForeign(['category_id']);

            // Bước 2: Xóa cột category_id
            $table->dropColumn('category_id');

            // Bước 3: Khôi phục lại cột product_id
            $table->unsignedBigInteger('product_id')->after('id');

            // Bước 4: Tạo lại khóa ngoại cho product_id (nếu cần)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
