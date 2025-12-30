<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_url', 'thumbnail_url', 'thumbnail_key', 'category', 'active', 'order'];
    protected $casts = ['active' => 'boolean', 'order' => 'integer'];
    
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
