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
    Schema::table('reviewss', function (Blueprint $table) {
        $table->integer('likes')->default(0);
        $table->integer('dislikes')->default(0);
    });
}

public function down()
{
    Schema::table('reviewss', function (Blueprint $table) {
        $table->dropColumn('likes');
        $table->dropColumn('dislikes');
    });
}

};
