<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToSizesTable extends Migration
{
    public function up()
    {
        Schema::table('sizes', function (Blueprint $table) {
            $table->string('color')->nullable()->after('size'); // Thêm cột 'color' vào bảng 'sizes'
        });
    }

    public function down()
    {
        Schema::table('sizes', function (Blueprint $table) {
            $table->dropColumn('color'); // Nếu rollback migration, xóa cột 'color'
        });
    }
}
