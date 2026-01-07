<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'notes',
        'submitted_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'status' => ContactStatus::class,
        ];
    }
    
    /**
     * Scope a query to only include new contacts.
     */
    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', ContactStatus::NEW);
    }

    /**
     * Scope a query to only include read contacts.
     */
    public function scopeRead(Builder $query): Builder
    {
        return $query->where('status', ContactStatus::READ);
    }

    /**
     * Scope a query to only include replied contacts.
     */
    public function scopeReplied(Builder $query): Builder
    {
        return $query->where('status', ContactStatus::REPLIED);
    }
}
