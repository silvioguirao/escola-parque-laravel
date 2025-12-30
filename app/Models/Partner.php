<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo_url', 'logo_key', 'website', 'order', 'active'];
    protected $casts = ['active' => 'boolean', 'order' => 'integer'];
    
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
