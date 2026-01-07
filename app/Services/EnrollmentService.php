<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\User;
use App\Enums\EnrollmentStatus;
use Illuminate\Support\Facades\Log;

class EnrollmentService
{
    /**
     * Create a new enrollment.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Enrollment
    {
        $data['submitted_at'] = now();
        $data['status'] = EnrollmentStatus::PENDING->value;

        $enrollment = Enrollment::create($data);

        Log::info('New enrollment created', [
            'enrollment_id' => $enrollment->id,
            'student_name' => $enrollment->student_name,
            'parent_email' => $enrollment->parent_email,
        ]);

        // TODO: Send notification to admin
        // TODO: Send confirmation email to parent

        return $enrollment;
    }

    /**
     * Approve an enrollment.
     */
    public function approve(Enrollment $enrollment, User $reviewer): Enrollment
    {
        $enrollment->update([
            'status' => EnrollmentStatus::APPROVED->value,
            'reviewed_at' => now(),
            'reviewed_by' => $reviewer->id,
        ]);

        Log::info('Enrollment approved', [
            'enrollment_id' => $enrollment->id,
            'reviewer_id' => $reviewer->id,
        ]);

        // TODO: Send approval notification to parent

        return $enrollment->fresh();
    }

    /**
     * Reject an enrollment.
     */
    public function reject(Enrollment $enrollment, User $reviewer, ?string $notes = null): Enrollment
    {
        $enrollment->update([
            'status' => EnrollmentStatus::REJECTED->value,
            'reviewed_at' => now(),
            'reviewed_by' => $reviewer->id,
            'notes' => $notes ?? $enrollment->notes,
        ]);

        Log::info('Enrollment rejected', [
            'enrollment_id' => $enrollment->id,
            'reviewer_id' => $reviewer->id,
        ]);

        // TODO: Send rejection notification to parent

        return $enrollment->fresh();
    }

    /**
     * Get pending enrollments count.
     */
    public function getPendingCount(): int
    {
        return Enrollment::pending()->count();
    }

    /**
     * Get enrollments statistics.
     *
     * @return array<string, int>
     */
    public function getStatistics(): array
    {
        return [
            'total' => Enrollment::count(),
            'pending' => Enrollment::pending()->count(),
            'approved' => Enrollment::approved()->count(),
            'rejected' => Enrollment::rejected()->count(),
        ];
    }
}
