<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

     public function products()
    {
        // Quan hệ nhiều-nhiều với bảng products qua product_tags
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id');
    }
}
