<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private ContactService $contactService
    ) {}

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
        $this->contactService->create($request->validated());

        return redirect()
            ->route('home')
            ->with('success', 'Mensagem enviada com sucesso! Retornaremos em breve.');
    }
}
