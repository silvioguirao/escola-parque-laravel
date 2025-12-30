<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentProgress extends Model
{
    use HasFactory;

    protected $fillable = ['enrollment_id', 'subject', 'grade', 'attendance', 'behavior', 'notes', 'reported_at'];
    protected $casts = ['attendance' => 'integer', 'reported_at' => 'datetime'];
    
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
