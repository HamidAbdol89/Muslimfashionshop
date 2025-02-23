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
         if (!Schema::hasTable('user_favoritess')) {
             Schema::create('user_favoritess', function (Blueprint $table) {
                 $table->id();
                 $table->foreignId('user_id')->constrained()->onDelete('cascade');
                 $table->foreignId('product_id')->constrained()->onDelete('cascade');
                 $table->timestamps();
                 $table->unique(['user_id', 'product_id']);
             });
         }
     }
     
     public function down()
     {
         Schema::dropIfExists('user_favoritess');
     }
    
};
