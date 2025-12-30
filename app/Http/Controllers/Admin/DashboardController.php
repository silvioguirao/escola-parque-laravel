<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Contact;
use App\Models\News;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_enrollments' => Enrollment::where('status', 'pending')->count(),
            'new_contacts' => Contact::where('status', 'new')->count(),
            'published_news' => News::where('published', true)->count(),
            'active_courses' => Course::where('active', true)->count(),
        ];

        $recentEnrollments = Enrollment::with('course')->latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentEnrollments', 'recentContacts'));
    }
}
