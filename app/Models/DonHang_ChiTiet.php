<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonHang_ChiTiet extends Model
{
    protected $table = 'donhang_chitiet';

    protected $fillable = [
        'donhang_id',
        'product_id',
        'soluongban',
        'dongiaban',
        'size_id',
        'color_id',
    ];

    public function DonHang(): BelongsTo
    {
        return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
    }
 
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }


    // Quan hệ với bảng product_colors
    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }
    
}