<?php

namespace App\Models;

use App\Enums\EnrollmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_name',
        'birth_date',
        'parent_name',
        'parent_email',
        'parent_phone',
        'address',
        'course_id',
        'level',
        'status',
        'notes',
        'submitted_at',
        'reviewed_at',
        'reviewed_by'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'status' => EnrollmentStatus::class,
        ];
    }
    
    /**
     * Get the course that this enrollment is for.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    
    /**
     * Get the user who reviewed this enrollment.
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
    
    /**
     * Get the parent-student relations for this enrollment.
     */
    public function parentRelations(): HasMany
    {
        return $this->hasMany(ParentStudentRelation::class);
    }
    
    /**
     * Get the student progress records for this enrollment.
     */
    public function progress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }
    
    /**
     * Get the communications for this enrollment.
     */
    public function communications(): HasMany
    {
        return $this->hasMany(ParentCommunication::class);
    }
    
    /**
     * Scope a query to only include pending enrollments.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', EnrollmentStatus::PENDING);
    }

    /**
     * Scope a query to only include approved enrollments.
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', EnrollmentStatus::APPROVED);
    }

    /**
     * Scope a query to only include rejected enrollments.
     */
    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', EnrollmentStatus::REJECTED);
    }
}
