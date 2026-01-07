<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'level',
        'age_range',
        'curriculum',
        'image_url',
        'image_key',
        'active',
        'order'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'order' => 'integer',
            'curriculum' => 'array',
        ];
    }
    
    /**
     * Get the enrollments for this course.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
    
    /**
     * Scope a query to only include active courses, ordered by position.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true)->orderBy('order');
    }

    /**
     * Scope a query to only include courses for a specific level.
     */
    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }
}
