<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;

    protected $table = 'dia_chi';

    protected $fillable = [
        'user_id',
        'ten_nguoi_nhan',
        'dia_chi',
        'so_dien_thoai',
        'thanh_pho',
    ];

    // Liên kết với model NguoiDung
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
