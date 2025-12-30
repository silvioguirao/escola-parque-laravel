<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeroBanner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'image_url', 'image_key', 'cta_text', 'cta_link', 'order', 'active'];
    protected $casts = ['active' => 'boolean', 'order' => 'integer'];
    
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
