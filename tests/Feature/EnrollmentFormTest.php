<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_enrollment_form_page_can_be_rendered(): void
    {
        $response = $this->get(route('enrollment.create'));

        $response->assertStatus(200);
    }

    public function test_enrollment_can_be_submitted_with_valid_data(): void
    {
        $course = Course::factory()->create();

        $enrollmentData = [
            'student_name' => 'Maria Silva',
            'birth_date' => '2015-05-15',
            'parent_name' => 'João Silva',
            'parent_email' => 'joao@example.com',
            'parent_phone' => '11999999999',
            'address' => 'Rua Exemplo, 123',
            'course_id' => $course->id,
            'level' => 'infantil',
        ];

        $response = $this->post(route('enrollment.store'), $enrollmentData);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('enrollments', [
            'student_name' => 'Maria Silva',
            'parent_email' => 'joao@example.com',
            'status' => 'pending',
        ]);
    }

    public function test_enrollment_requires_student_name(): void
    {
        $enrollmentData = [
            'birth_date' => '2015-05-15',
            'parent_name' => 'João Silva',
            'parent_email' => 'joao@example.com',
            'parent_phone' => '11999999999',
            'level' => 'infantil',
        ];

        $response = $this->post(route('enrollment.store'), $enrollmentData);

        $response->assertSessionHasErrors('student_name');
    }

    public function test_enrollment_requires_valid_birth_date(): void
    {
        $enrollmentData = [
            'student_name' => 'Maria Silva',
            'birth_date' => 'invalid-date',
            'parent_name' => 'João Silva',
            'parent_email' => 'joao@example.com',
            'parent_phone' => '11999999999',
            'level' => 'infantil',
        ];

        $response = $this->post(route('enrollment.store'), $enrollmentData);

        $response->assertSessionHasErrors('birth_date');
    }

    public function test_enrollment_birth_date_must_be_in_past(): void
    {
        $enrollmentData = [
            'student_name' => 'Maria Silva',
            'birth_date' => now()->addDay()->format('Y-m-d'),
            'parent_name' => 'João Silva',
            'parent_email' => 'joao@example.com',
            'parent_phone' => '11999999999',
            'level' => 'infantil',
        ];

        $response = $this->post(route('enrollment.store'), $enrollmentData);

        $response->assertSessionHasErrors('birth_date');
    }

    public function test_enrollment_requires_valid_level(): void
    {
        $enrollmentData = [
            'student_name' => 'Maria Silva',
            'birth_date' => '2015-05-15',
            'parent_name' => 'João Silva',
            'parent_email' => 'joao@example.com',
            'parent_phone' => '11999999999',
            'level' => 'invalid-level',
        ];

        $response = $this->post(route('enrollment.store'), $enrollmentData);

        $response->assertSessionHasErrors('level');
    }

    public function test_enrollment_accepts_valid_education_levels(): void
    {
        $levels = ['infantil', 'fundamental1', 'fundamental2', 'medio'];

        foreach ($levels as $level) {
            $enrollmentData = [
                'student_name' => 'Maria Silva',
                'birth_date' => '2015-05-15',
                'parent_name' => 'João Silva',
                'parent_email' => 'joao@example.com',
                'parent_phone' => '11999999999',
                'level' => $level,
            ];

            $response = $this->post(route('enrollment.store'), $enrollmentData);
            $response->assertRedirect(route('home'));
        }

        $this->assertDatabaseCount('enrollments', 4);
    }

    public function test_enrollment_submission_is_rate_limited(): void
    {
        $enrollmentData = [
            'student_name' => 'Maria Silva',
            'birth_date' => '2015-05-15',
            'parent_name' => 'João Silva',
            'parent_email' => 'joao@example.com',
            'parent_phone' => '11999999999',
            'level' => 'infantil',
        ];

        // Submit enrollment form 6 times (limit is 5 per minute)
        for ($i = 0; $i < 6; $i++) {
            $response = $this->post(route('enrollment.store'), $enrollmentData);
        }

        // The 6th request should be rate limited
        $response->assertStatus(429); // Too Many Requests
    }
}
