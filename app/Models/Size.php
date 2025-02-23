<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'size', 'description'];

    // Quan hệ với bảng ProductSize
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviewss()
    {
        return $this->hasMany(Review::class);
    }

    public function DonHang_ChiTiet()
    {
        return $this->hasMany(DonHang_ChiTiet::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes');
    }

}
