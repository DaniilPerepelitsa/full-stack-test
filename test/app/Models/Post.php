<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 *
 * @property Collection $categories
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'media'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'post_categories');
    }
}
