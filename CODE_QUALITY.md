# Code Quality Guide - Escola Parque Laravel

## Overview
This document outlines code quality standards, recent improvements, and recommendations for maintaining high-quality code in the Escola Parque Laravel project.

## Recent Improvements Implemented

### 1. Type Safety with Enums (PHP 8.1+)

#### Why?
- Eliminates magic strings
- Provides IDE autocomplete
- Type-safe status values
- Easier refactoring

#### Implemented Enums
```php
App\Enums\EnrollmentStatus
App\Enums\ContactStatus
App\Enums\NewsCategory
App\Enums\EducationLevel
```

#### Usage Example
```php
// Before (magic strings)
$enrollment->status = 'pending';

// After (type-safe enum)
$enrollment->status = EnrollmentStatus::PENDING;
```

#### Enum Methods
All enums provide:
- `values()`: Get array of all valid values
- `label()`: Get human-readable label
- Additional helpers like `badgeClass()`, `icon()`, etc.

### 2. Form Request Validation

#### Why?
- Separates validation logic from controllers
- Reusable validation rules
- Cleaner controllers
- Custom error messages

#### Implemented Request Classes
```php
App\Http\Requests\StoreEnrollmentRequest
App\Http\Requests\StoreContactRequest
```

#### Benefits
- Automatic validation before controller method
- Custom error messages in Portuguese
- Centralized validation logic
- Easy to test

### 3. Service Layer Pattern

#### Why?
- Separates business logic from controllers
- Reusable across multiple controllers/commands
- Easier to test
- Better logging and monitoring
- Single Responsibility Principle

#### Implemented Services
```php
App\Services\EnrollmentService
App\Services\ContactService
```

#### Service Responsibilities
- Business logic execution
- Logging critical operations
- Preparing data for models
- Sending notifications (planned)

#### Usage Example
```php
// In Controller
public function __construct(
    private EnrollmentService $enrollmentService
) {}

public function store(StoreEnrollmentRequest $request)
{
    $this->enrollmentService->create($request->validated());
    return redirect()->route('home')->with('success', '...');
}
```

### 4. Type Hints & Documentation

#### Why?
- Better IDE support
- Prevents type-related bugs
- Self-documenting code
- Easier maintenance

#### Standards Applied
```php
// Return types
public function index(): View
public function store(Request $request): RedirectResponse

// Parameter types
public function create(array $data): Enrollment

// Property types
public function __construct(
    private EnrollmentService $enrollmentService
) {}
```

#### DocBlocks
All methods now include:
- Description of purpose
- Parameter types and descriptions
- Return type documentation
- Important notes/warnings

### 5. Eager Loading for Performance

#### Why?
- Prevents N+1 query problems
- Reduces database queries
- Improves page load times
- Better resource utilization

#### Implementation
```php
// Before - N+1 problem
$news = News::published()->get();
foreach ($news as $article) {
    echo $article->author->name; // Extra query per article!
}

// After - Eager loading
$news = News::with('author')->published()->get();
foreach ($news as $article) {
    echo $article->author->name; // No extra queries
}
```

### 6. Rate Limiting for Security

#### Why?
- Prevents spam submissions
- Protects against abuse
- Reduces server load
- Improves user experience

#### Configuration
```php
// Enrollment: 5 submissions per minute
->middleware('throttle:5,1')

// Contact: 10 submissions per minute
->middleware('throttle:10,1')
```

## Code Style Standards

### Naming Conventions

#### Controllers
```php
// Resource controllers (plural)
UserController
NewsController
CourseController

// Single action controllers (singular + action)
ProcessPaymentController
SendEmailController
```

#### Models
```php
// Singular, PascalCase
User
News (singular of News)
Course
Enrollment
```

#### Services
```php
// Noun + Service suffix
EnrollmentService
ContactService
PaymentService
```

#### Enums
```php
// Singular noun describing what it represents
EnrollmentStatus
ContactStatus
NewsCategory
```

### Method Naming

#### Controllers
```php
// RESTful resource methods
index()    // List resources
create()   // Show creation form
store()    // Save new resource
show()     // Display single resource
edit()     // Show edit form
update()   // Update existing resource
destroy()  // Delete resource
```

#### Services
```php
// Descriptive action verbs
create()
update()
delete()
approve()
reject()
markAsRead()
getPendingCount()
getStatistics()
```

#### Scopes (in Models)
```php
// Prefix with 'scope', use camelCase
public function scopePublished($query)
public function scopeActive($query)
public function scopePending($query)
```

### File Organization

```
app/
├── Enums/              # PHP Enums (8.1+)
├── Http/
│   ├── Controllers/    # HTTP controllers
│   ├── Middleware/     # Custom middleware
│   └── Requests/       # Form request validators
├── Models/             # Eloquent models
├── Services/           # Business logic services
└── View/              # View composers
```

## Best Practices

### 1. Always Use Form Requests for Validation
```php
// Good
public function store(StoreEnrollmentRequest $request)
{
    $enrollment = Enrollment::create($request->validated());
}

// Avoid
public function store(Request $request)
{
    $validated = $request->validate([...]);
}
```

### 2. Use Services for Business Logic
```php
// Good
public function store(StoreEnrollmentRequest $request)
{
    $this->enrollmentService->create($request->validated());
}

// Avoid
public function store(StoreEnrollmentRequest $request)
{
    $enrollment = Enrollment::create([..]);
    Log::info('...');
    // Send email
    // Send notification
    // etc.
}
```

### 3. Use Enums Instead of Magic Strings
```php
// Good
$enrollment->status = EnrollmentStatus::PENDING;
if ($enrollment->status === EnrollmentStatus::APPROVED) {...}

// Avoid
$enrollment->status = 'pending';
if ($enrollment->status === 'approved') {...}
```

### 4. Always Use Type Hints
```php
// Good
public function create(array $data): Enrollment
public function index(): View

// Avoid
public function create($data)
public function index()
```

### 5. Use Eloquent Relationships
```php
// Good
$enrollment = Enrollment::with('course', 'reviewer')->find($id);
$courseName = $enrollment->course->name;

// Avoid
$enrollment = Enrollment::find($id);
$course = Course::find($enrollment->course_id);
$courseName = $course->name;
```

### 6. Keep Controllers Thin
Controllers should:
- Receive requests
- Delegate to services
- Return responses

Controllers should NOT:
- Contain business logic
- Directly manipulate models extensively
- Send emails/notifications
- Perform complex calculations

### 7. Use Scopes for Common Queries
```php
// Good
$news = News::published()->latest()->take(10)->get();

// Avoid
$news = News::where('published', true)
    ->whereNotNull('published_at')
    ->where('published_at', '<=', now())
    ->latest()
    ->take(10)
    ->get();
```

## Testing Standards

### Unit Tests
- Test individual methods in isolation
- Mock dependencies
- Focus on business logic

### Feature Tests
- Test complete user flows
- Test API endpoints
- Test form submissions
- Test authentication flows

### Test Naming
```php
// Good test names
test_user_can_submit_enrollment_form()
test_admin_can_approve_enrollment()
test_unauthenticated_user_cannot_access_admin_dashboard()

// Avoid
test1()
test_enrollment()
testAdmin()
```

## Performance Optimization

### 1. Database Queries
- Use eager loading (`with()`)
- Add indexes to foreign keys
- Use pagination for large datasets
- Cache frequently accessed data

### 2. Caching Strategy
```php
// Cache frequently accessed data
$banners = Cache::remember('hero-banners', 3600, function () {
    return HeroBanner::active()->get();
});
```

### 3. Query Optimization
```php
// Good - Single query with conditions
$stats = [
    'total' => User::count(),
    'admins' => User::where('role', 'admin')->count(),
];

// Better - Use DB query builder for multiple counts
$stats = DB::table('users')
    ->selectRaw('
        COUNT(*) as total,
        COUNT(CASE WHEN role = "admin" THEN 1 END) as admins
    ')
    ->first();
```

## Code Review Checklist

Before submitting code for review, ensure:
- [ ] All methods have type hints
- [ ] DocBlocks are present and accurate
- [ ] No magic strings (use enums)
- [ ] Validation uses Form Requests
- [ ] Business logic is in Services
- [ ] Eager loading is used where needed
- [ ] No N+1 query problems
- [ ] Tests are written and passing
- [ ] Security best practices followed
- [ ] Code follows naming conventions
- [ ] No commented-out code
- [ ] Logging added for critical operations

## Tools for Code Quality

### Laravel Pint (Code Style)
```bash
./vendor/bin/pint
```

### PHPStan (Static Analysis)
Consider adding PHPStan for advanced static analysis:
```bash
composer require --dev phpstan/phpstan
./vendor/bin/phpstan analyse
```

### Laravel Telescope (Debugging)
For development debugging and optimization:
```bash
composer require laravel/telescope --dev
```

## Future Improvements to Consider

### 1. API Resources
Transform model data for API responses:
```php
class EnrollmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'student_name' => $this->student_name,
            'status' => $this->status->label(),
            // ...
        ];
    }
}
```

### 2. Events & Listeners
Decouple actions from business logic:
```php
event(new EnrollmentSubmitted($enrollment));
// Multiple listeners can respond
```

### 3. Jobs & Queues
Async processing for long-running tasks:
```php
SendEnrollmentNotification::dispatch($enrollment);
```

### 4. Repository Pattern
Abstract data access layer:
```php
interface EnrollmentRepositoryInterface
{
    public function getPending(): Collection;
    public function findById(int $id): ?Enrollment;
}
```

## Resources

- [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices)
- [PHP The Right Way](https://phptherightway.com/)
- [Clean Code PHP](https://github.com/jupeter/clean-code-php)
- [Laravel Documentation](https://laravel.com/docs)

---

Last Updated: 2026-01-07
Version: 1.0
