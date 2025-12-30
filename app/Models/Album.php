<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'event_date', 'cover_image_url', 'cover_image_key', 'published'];
    protected $casts = ['published' => 'boolean', 'event_date' => 'datetime'];
    
    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('order');
    }
    
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
