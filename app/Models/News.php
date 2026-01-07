<?php

namespace App\Models;

use App\Enums\NewsCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image_url',
        'cover_image_key',
        'category',
        'published',
        'published_at',
        'author_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published' => 'boolean',
            'published_at' => 'datetime',
            'category' => NewsCategory::class,
        ];
    }
    
    /**
     * Get the author of the news article.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    /**
     * Scope a query to only include published news.
     * Published news must have published=true, published_at set, and published_at <= now.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include news by category.
     */
    public function scopeByCategory(Builder $query, NewsCategory $category): Builder
    {
        return $query->where('category', $category);
    }
}
