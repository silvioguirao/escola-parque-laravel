<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'cover_image_url', 'cover_image_key', 'category', 'published', 'published_at', 'author_id'];
    protected $casts = ['published' => 'boolean', 'published_at' => 'datetime'];
    
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function scopePublished($query)
    {
        return $query->where('published', true)->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
