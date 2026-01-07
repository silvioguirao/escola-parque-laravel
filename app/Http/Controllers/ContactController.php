<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function create(): View
    {
        return view('contact.create');
    }

    /**
     * Store a new contact message.
     */
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['submitted_at'] = now();
        $validated['status'] = 'new';

        Contact::create($validated);

        return redirect()
            ->route('home')
            ->with('success', 'Mensagem enviada com sucesso! Retornaremos em breve.');
    }
}
