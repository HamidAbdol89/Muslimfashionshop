<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colorss';
    protected $fillable = ['product_id', 'color', 'image_id', 'image_path'];

    public function product()
    {
        return $this->belongsTo(Product::class);  // Quan hệ với model Product
    }

    public function productImage()
    {
        return $this->belongsTo(ProductImage::class, 'image_path    ');
    }


    public function DonHang_ChiTiet()
{
    return $this->hasMany(DonHang_ChiTiet::class);
}




}
