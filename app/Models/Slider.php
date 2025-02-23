<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
	use SoftDeletes;
    protected $table = 'sliders'; // Bảng sliders
    protected $guarded = [];     // Cho phép tất cả các cột được fill
}
