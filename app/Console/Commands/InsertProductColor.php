<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertProductColor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:product-color {color} {image_id} {product_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert product color into product_colorss table without foreign key constraint';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $color = $this->argument('color');
        $image_id = $this->argument('image_id');
        $product_id = $this->argument('product_id');

        // Tắt kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Chèn dữ liệu vào bảng product_colorss
        DB::table('product_colorss')->insert([
            'color' => $color,
            'image_id' => $image_id,
            'product_id' => $product_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Dữ liệu đã được chèn thành công vào bảng product_colorss!');
    }
}
