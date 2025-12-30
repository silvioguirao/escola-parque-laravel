<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'subject', 'message', 'status', 'notes', 'submitted_at'];
    protected $casts = ['submitted_at' => 'datetime'];
    
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
