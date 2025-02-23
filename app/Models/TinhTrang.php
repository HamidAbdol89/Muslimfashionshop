<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinhTrang extends Model
{
    use HasFactory;

    // Tên bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'tinhtrang';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = ['tinhtrang'];

    public function DonHang()
    {
        return $this->hasMany(DonHang::class, 'tinhtrang_id', 'id');
    }
}
