<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_name', 'birth_date', 'parent_name', 'parent_email', 'parent_phone', 'address', 'course_id', 'level', 'status', 'notes', 'submitted_at', 'reviewed_at', 'reviewed_by'];
    protected $casts = ['birth_date' => 'date', 'submitted_at' => 'datetime', 'reviewed_at' => 'datetime'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
    
    public function parentRelations()
    {
        return $this->hasMany(ParentStudentRelation::class);
    }
    
    public function progress()
    {
        return $this->hasMany(StudentProgress::class);
    }
    
    public function communications()
    {
        return $this->hasMany(ParentCommunication::class);
    }
    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
