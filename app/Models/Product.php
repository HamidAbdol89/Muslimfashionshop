<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'price', 'content', 'user_id', 'category_id', 'feature_image_name', 'feature_image_path'];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    
    public function tags()
    {
        // Quan hệ nhiều-nhiều với bảng tags qua product_tags
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // Accessor để định dạng giá tiền
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price) . ' ₫';
    }



 // app/Models/Product.php

public function favoritess()
{
    return $this->hasMany(UserFavorite::class);
}


    // Kiểm tra sản phẩm có được yêu thích bởi user hiện tại
   // app/Models/Product.php

   public function isFavorite()
   {
       return $this->favoritess()->where('user_id', Auth::id())->exists();
   }
   
   public function reviewss()
{
    return $this->hasMany(Review::class);
}


public function sizes()
{
    return $this->hasMany(Size::class);
}

public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }



    
    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }



    public function vaiChamsoc()
    {
        return $this->hasMany(VaiChamsoc::class, 'product_id');
    }
    

    public function DonHang_ChiTiet()
    {
    return $this->hasMany(DonHang_ChiTiet::class, 'product_id', 'id');
    }

}
