<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\DifferentialController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\EnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Parent\DashboardController as ParentDashboardController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/cursos', [CourseController::class, 'index'])->name('courses.index');
Route::get('/cursos/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeria/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Enrollment form
Route::get('/matricula', [EnrollmentController::class, 'create'])->name('enrollment.create');
Route::post('/matricula', [EnrollmentController::class, 'store'])->name('enrollment.store');

// Contact form
Route::get('/contato', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contato', [ContactController::class, 'store'])->name('contact.store');

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isParent()) {
            return redirect()->route('parent.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'verified', App\Http\Middleware\EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Content management
    Route::resource('hero-banners', HeroBannerController::class);
    Route::resource('differentials', DifferentialController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('courses', AdminCourseController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('videos', VideoController::class);
    
    // Enrollments management
    Route::resource('enrollments', AdminEnrollmentController::class);
    Route::patch('enrollments/{enrollment}/approve', [AdminEnrollmentController::class, 'approve'])->name('enrollments.approve');
    Route::patch('enrollments/{enrollment}/reject', [AdminEnrollmentController::class, 'reject'])->name('enrollments.reject');
    
    // Contacts management
    Route::resource('contacts', AdminContactController::class);
    Route::patch('contacts/{contact}/mark-read', [AdminContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::patch('contacts/{contact}/mark-replied', [AdminContactController::class, 'markAsReplied'])->name('contacts.mark-replied');
    
    // User management
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-email-verification', [UserController::class, 'toggleEmailVerification'])->name('users.toggle-email-verification');
});

// Parent routes
Route::middleware(['auth', 'verified'])->prefix('parent')->name('parent.')->group(function () {
    Route::get('/dashboard', [ParentDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
