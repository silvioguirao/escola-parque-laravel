<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::active()->get();

        return view('courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        return view('courses.show', compact('course'));
    }
}
