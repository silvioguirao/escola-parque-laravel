<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Services\EnrollmentService;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private EnrollmentService $enrollmentService
    ) {}

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
        $this->enrollmentService->create($request->validated());

        return redirect()
            ->route('home')
            ->with('success', 'Matrícula enviada com sucesso! Em breve entraremos em contato.');
    }
}
