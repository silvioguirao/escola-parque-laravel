<?php

namespace App\Services;

use App\Models\Contact;
use App\Enums\ContactStatus;
use Illuminate\Support\Facades\Log;

class ContactService
{
    /**
     * Create a new contact message.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Contact
    {
        $data['submitted_at'] = now();
        $data['status'] = ContactStatus::NEW->value;

        $contact = Contact::create($data);

        Log::info('New contact message received', [
            'contact_id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'subject' => $contact->subject,
        ]);

        // TODO: Send notification to admin
        // TODO: Send confirmation email to user

        return $contact;
    }

    /**
     * Mark a contact as read.
     */
    public function markAsRead(Contact $contact): Contact
    {
        $contact->update([
            'status' => ContactStatus::READ->value,
        ]);

        Log::info('Contact marked as read', [
            'contact_id' => $contact->id,
        ]);

        return $contact->fresh();
    }

    /**
     * Mark a contact as replied.
     */
    public function markAsReplied(Contact $contact, ?string $notes = null): Contact
    {
        $contact->update([
            'status' => ContactStatus::REPLIED->value,
            'notes' => $notes ?? $contact->notes,
        ]);

        Log::info('Contact marked as replied', [
            'contact_id' => $contact->id,
        ]);

        return $contact->fresh();
    }

    /**
     * Get new contacts count.
     */
    public function getNewCount(): int
    {
        return Contact::new()->count();
    }

    /**
     * Get contacts statistics.
     *
     * @return array<string, int>
     */
    public function getStatistics(): array
    {
        return [
            'total' => Contact::count(),
            'new' => Contact::new()->count(),
            'read' => Contact::read()->count(),
            'replied' => Contact::replied()->count(),
        ];
    }
}
