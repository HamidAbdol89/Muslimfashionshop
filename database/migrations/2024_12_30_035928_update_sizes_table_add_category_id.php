<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSizesTableAddCategoryId extends Migration
{
    public function up()
    {
        Schema::table('sizes', function (Blueprint $table) {
            // Thêm cột category_id vào bảng sizes
            $table->unsignedBigInteger('category_id')->after('id');

            // Nếu bạn muốn loại bỏ cột product_id, thực hiện như sau:
            $table->dropColumn('product_id');

            // Tạo khóa ngoại cho category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('sizes', function (Blueprint $table) {
            // Xóa khóa ngoại
            $table->dropForeign(['category_id']);

            // Xóa cột category_id
            $table->dropColumn('category_id');

            // Khôi phục lại cột product_id
            $table->unsignedBigInteger('product_id')->after('id');
        });
    }
}

