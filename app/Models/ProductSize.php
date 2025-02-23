<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size_id'];

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ với Size
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function reviewss()
    {
        return $this->hasMany(Review::class);
    }
}
