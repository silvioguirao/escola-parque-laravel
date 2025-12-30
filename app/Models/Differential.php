<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Differential extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'icon', 'order', 'active'];
    protected $casts = ['active' => 'boolean', 'order' => 'integer'];
    
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
