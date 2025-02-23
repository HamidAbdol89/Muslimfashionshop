<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiChamsoc extends Model
{
    use HasFactory;
    protected $table = 'vai_chamsoc';
    protected $fillable = [
        'product_id', 'vai', 'cham_soc_vai', 'trong_luong_vai', 'ma_vai'
    ];

    // Định nghĩa quan hệ với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
