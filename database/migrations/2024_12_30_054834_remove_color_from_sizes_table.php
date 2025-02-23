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
    Schema::table('sizes', function (Blueprint $table) {
        $table->dropColumn('color'); // Xóa cột color
    });
}

public function down()
{
    Schema::table('sizes', function (Blueprint $table) {
        $table->string('color')->nullable(); // Nếu cần, bạn có thể thêm lại cột này trong phương thức down
    });
}

};
