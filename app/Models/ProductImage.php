<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_name', 'image_path'];

    // Mối quan hệ inverse
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function colors()
{
    return $this->belongsTo(ProductColor::class);
}
}
