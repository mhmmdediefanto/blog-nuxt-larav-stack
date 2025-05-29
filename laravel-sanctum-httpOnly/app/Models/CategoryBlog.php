<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    protected $table = 'category_blogs';
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];


    public function posts()
    {
        return $this->hasMany(Blog::class);
    }
}
