<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_page_can_be_rendered(): void
    {
        $response = $this->get(route('contact.create'));

        $response->assertStatus(200);
    }

    public function test_contact_can_be_submitted_with_valid_data(): void
    {
        $contactData = [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'phone' => '11999999999',
            'subject' => 'Dúvida sobre matrícula',
            'message' => 'Gostaria de saber mais informações sobre o processo de matrícula.',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'subject' => 'Dúvida sobre matrícula',
            'status' => 'new',
        ]);
    }

    public function test_contact_requires_name(): void
    {
        $contactData = [
            'email' => 'joao@example.com',
            'subject' => 'Test',
            'message' => 'Test message',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertSessionHasErrors('name');
    }

    public function test_contact_requires_valid_email(): void
    {
        $contactData = [
            'name' => 'João Silva',
            'email' => 'invalid-email',
            'subject' => 'Test',
            'message' => 'Test message',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_requires_subject(): void
    {
        $contactData = [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'message' => 'Test message',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertSessionHasErrors('subject');
    }

    public function test_contact_requires_message(): void
    {
        $contactData = [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'subject' => 'Test',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertSessionHasErrors('message');
    }

    public function test_contact_phone_is_optional(): void
    {
        $contactData = [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'subject' => 'Test',
            'message' => 'Test message',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('contacts', [
            'email' => 'joao@example.com',
            'phone' => null,
        ]);
    }

    public function test_contact_submission_is_rate_limited(): void
    {
        $contactData = [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'subject' => 'Test',
            'message' => 'Test message',
        ];

        // Submit contact form 11 times (limit is 10 per minute)
        for ($i = 0; $i < 11; $i++) {
            $response = $this->post(route('contact.store'), $contactData);
        }

        // The 11th request should be rate limited
        $response->assertStatus(429); // Too Many Requests
    }
}
