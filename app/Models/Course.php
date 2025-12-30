<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'level', 'age_range', 'curriculum', 'image_url', 'image_key', 'active', 'order'];
    protected $casts = ['active' => 'boolean', 'order' => 'integer', 'curriculum' => 'array'];
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('active', true)->orderBy('order');
    }
}
