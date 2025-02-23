<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
    
    protected $fillable = ['name', 'parent_id', 'slug'];


    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
