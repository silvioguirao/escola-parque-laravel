<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    /**
     * Show the enrollment form.
     */
    public function create(): View
    {
        $courses = Course::active()->get();

        return view('enrollment.create', compact('courses'));
    }

    /**
     * Store a new enrollment.
     */
    public function store(StoreEnrollmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['submitted_at'] = now();
        $validated['status'] = 'pending';

        Enrollment::create($validated);

        return redirect()
            ->route('home')
            ->with('success', 'Matrícula enviada com sucesso! Em breve entraremos em contato.');
    }
}
