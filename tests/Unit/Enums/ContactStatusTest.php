<?php

namespace Tests\Unit\Enums;

use App\Enums\ContactStatus;
use PHPUnit\Framework\TestCase;

class ContactStatusTest extends TestCase
{
    public function test_contact_status_values_returns_all_statuses(): void
    {
        $values = ContactStatus::values();
        
        $this->assertIsArray($values);
        $this->assertCount(3, $values);
        $this->assertContains('new', $values);
        $this->assertContains('read', $values);
        $this->assertContains('replied', $values);
    }

    public function test_contact_status_label_returns_correct_labels(): void
    {
        $this->assertEquals('Novo', ContactStatus::NEW->label());
        $this->assertEquals('Lido', ContactStatus::READ->label());
        $this->assertEquals('Respondido', ContactStatus::REPLIED->label());
    }

    public function test_contact_status_badge_class_returns_correct_classes(): void
    {
        $this->assertStringContainsString('blue', ContactStatus::NEW->badgeClass());
        $this->assertStringContainsString('gray', ContactStatus::READ->badgeClass());
        $this->assertStringContainsString('green', ContactStatus::REPLIED->badgeClass());
    }
}
