<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonHang extends Model
{
    protected $table = 'donhang';

    protected $fillable = [
      'user_id', 
      'tinhtrang_id', 
      'diachigiaohang', 
      'dienthoaigiaohang',
  ];
 
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function TinhTrang(): BelongsTo
    {
      return $this->belongsTo(TinhTrang::class, 'tinhtrang_id', 'id');
    }
    
    public function DonHang_ChiTiet(): HasMany
    {
     return $this->hasMany(DonHang_ChiTiet::class, 'donhang_id', 'id');
    }


    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    // Quan hệ với bảng Size (Kích thước)
  public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    

}
