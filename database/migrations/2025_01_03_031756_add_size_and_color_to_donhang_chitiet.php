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
        Schema::table('donhang_chitiet', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id')->nullable()->after('dongiaban');
            $table->unsignedBigInteger('color_id')->nullable()->after('size_id');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('product_colorss')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donhang_chitiet', function (Blueprint $table) {
            //
        });
    }
};
