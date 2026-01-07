<?php

namespace Tests\Unit\Enums;

use App\Enums\EnrollmentStatus;
use PHPUnit\Framework\TestCase;

class EnrollmentStatusTest extends TestCase
{
    public function test_enrollment_status_values_returns_all_statuses(): void
    {
        $values = EnrollmentStatus::values();
        
        $this->assertIsArray($values);
        $this->assertCount(3, $values);
        $this->assertContains('pending', $values);
        $this->assertContains('approved', $values);
        $this->assertContains('rejected', $values);
    }

    public function test_enrollment_status_label_returns_correct_labels(): void
    {
        $this->assertEquals('Pendente', EnrollmentStatus::PENDING->label());
        $this->assertEquals('Aprovado', EnrollmentStatus::APPROVED->label());
        $this->assertEquals('Rejeitado', EnrollmentStatus::REJECTED->label());
    }

    public function test_enrollment_status_badge_class_returns_correct_classes(): void
    {
        $this->assertStringContainsString('yellow', EnrollmentStatus::PENDING->badgeClass());
        $this->assertStringContainsString('green', EnrollmentStatus::APPROVED->badgeClass());
        $this->assertStringContainsString('red', EnrollmentStatus::REJECTED->badgeClass());
    }

    public function test_enrollment_status_enum_values_are_strings(): void
    {
        $this->assertIsString(EnrollmentStatus::PENDING->value);
        $this->assertEquals('pending', EnrollmentStatus::PENDING->value);
    }
}
