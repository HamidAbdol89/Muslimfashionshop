<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;
    protected $table = 'user_favoritess'; 
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    // Khai báo mối quan hệ với bảng users và products
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope kiểm tra yêu thích của người dùng
    public function scopeFavoriteByUser($query, $userId, $productId)
    {
        return $query->where('user_id', $userId)
                     ->where('product_id', $productId);
    }

    
}
