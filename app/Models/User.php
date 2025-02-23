<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Notifications\ResetPassword; 
use Illuminate\Notifications\Messages\MailMessage; 

class User extends Authenticatable
{
    protected $table = 'users';
    
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   

    public function DonHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'user_id', 'id');
    }


    public function BaiViet(): HasMany
    {
        return $this->hasMany(BaiViet::class, 'user_id', 'id');
    }
    
    public function BinhLuanBaiViet(): HasMany
    {
        return $this->hasMany(BinhLuanBaiViet::class, 'user_id', 'id');
    }
    
    public function favoritess()
    {
        return $this->belongsToMany(Product::class, 'user_favoritess', 'user_id', 'product_id')
                    ->withTimestamps(); // Lấy thông tin thời gian tạo và cập nhật
    }

    public function reviewss()
    {
        return $this->hasMany(Review::class, 'user_name', 'name');  // Hoặc 'user_id', tùy theo cấu trúc bảng
    }
    
     // Kiểm tra xem người dùng đã vote cho review này chưa
     public function hasVoted($reviewId)
     {
         return $this->votes()->where('review_id', $reviewId)->exists();
     }
 
     // Quan hệ với bảng votes (nếu bạn sử dụng bảng trung gian)
     public function votes()
     {
         return $this->hasMany(Review::class);
     }

    
     public function sendPasswordResetNotification($token) 
     { 
         $this->notify(new CustomResetPasswordNotification($token)); 
     } 
 } 
  
 class CustomResetPasswordNotification extends ResetPassword 
 { 
     public function toMail($notifiable) 
     { 
         return (new MailMessage) 
             ->subject('Khôi phục mật khẩu') 
             ->line('Bạn vừa yêu cầu ' . config('app.name') . ' khôi phục mật khẩu của mình.') 
             ->line('Liên kết đặt lại mật khẩu này sẽ hết hạn sau 60 phút.') 
             ->line('Xin vui lòng nhấn vào nút "Khôi phục mật khẩu" bên dưới để tiến hành cấp mật khẩu mới.') 
             ->action('Khôi phục mật khẩu', url(config('app.url') . route('password.reset', $this->token, false))) 
             ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, xin vui lòng không làm gì thêm và báo lại cho quản trị hệ thống về vấn đề này.'); 
     } 
 

   
}

