<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentCommunication extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id', 'title', 'content', 'type', 'priority', 'read', 'read_at'];
    protected $casts = ['read' => 'boolean', 'read_at' => 'datetime'];
    
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
    
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}
