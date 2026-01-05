<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function create()
    {
        $courses = Course::active()->get();

        return view('enrollment.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:200'],
            'birth_date' => ['required', 'date', 'before:today'],
            'parent_name' => ['required', 'string', 'max:200'],
            'parent_email' => ['required', 'email', 'max:320'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'level' => ['required', 'in:infantil,fundamental1,fundamental2,medio'],
        ]);

        $enrollment = Enrollment::create($validated);

        return redirect()
            ->route('home')
            ->with('success', 'Matrícula enviada com sucesso! Em breve entraremos em contato.');
    }
}
