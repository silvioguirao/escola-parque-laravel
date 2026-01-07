# Security Best Practices - Escola Parque Laravel

## Overview
This document outlines the security measures implemented in the Escola Parque Laravel application and best practices for maintaining security.

## Implemented Security Measures

### 1. Authentication & Authorization

#### Laravel Fortify
- **Two-Factor Authentication (2FA)**: Available for all users
- **Email Verification**: Configurable per user by admin
- **Password Reset**: Secure token-based password reset via email
- **Rate Limiting**: Automatic throttling on authentication endpoints

#### Role-Based Access Control (RBAC)
```php
// User roles: admin, parent, user
$user->isAdmin()   // Check admin role
$user->isParent()  // Check parent role
```

#### Middleware Protection
- `EnsureUserIsAdmin`: Protects all admin routes
- `auth`: Ensures user is authenticated
- `verified`: Ensures email is verified (when required)

### 2. Input Validation & Sanitization

#### Form Request Validation
All public forms use dedicated Form Request classes:
- `StoreEnrollmentRequest`: Validates enrollment submissions
- `StoreContactRequest`: Validates contact form submissions

#### Validation Rules Applied
- **Email Validation**: All email fields validated with `email` rule
- **String Length Limits**: Maximum lengths enforced on all text inputs
- **Date Validation**: Birth dates validated with `before:today` rule
- **Foreign Key Validation**: Uses `exists` rule for database references
- **Enum Validation**: Status fields validated against defined enums

#### Blade Template Escaping
Laravel automatically escapes output in Blade templates:
```php
{{ $variable }}  // Automatically escaped (safe)
{!! $variable !!}  // Raw output (use with caution)
```

### 3. CSRF Protection

#### Automatic CSRF Protection
Laravel includes CSRF protection by default for all POST, PUT, PATCH, DELETE requests.

#### Usage in Forms
```blade
<form method="POST" action="{{ route('contact.store') }}">
    @csrf
    <!-- form fields -->
</form>
```

**Important**: Never disable CSRF protection except for specific API routes that use other authentication methods.

### 4. Rate Limiting

#### Public Form Endpoints
```php
// Enrollment form: 5 submissions per minute
Route::post('/matricula', [EnrollmentController::class, 'store'])
    ->middleware('throttle:5,1');

// Contact form: 10 submissions per minute  
Route::post('/contato', [ContactController::class, 'store'])
    ->middleware('throttle:10,1');
```

#### Authentication Endpoints
Laravel's built-in authentication includes automatic rate limiting:
- Login attempts: Limited to prevent brute force attacks
- Password reset: Limited to prevent email flooding

### 5. SQL Injection Prevention

#### Eloquent ORM
All database queries use Eloquent ORM which automatically prevents SQL injection:
```php
// Safe - Uses parameter binding
User::where('email', $email)->first();

// Safe - Mass assignment protected by $fillable
User::create($validatedData);
```

#### Query Builder
When using raw queries, always use parameter binding:
```php
// Safe
DB::select('SELECT * FROM users WHERE email = ?', [$email]);

// UNSAFE - Never do this
DB::select("SELECT * FROM users WHERE email = '$email'");
```

### 6. XSS (Cross-Site Scripting) Prevention

#### Blade Escaping
Default Blade syntax `{{ }}` automatically escapes HTML:
```blade
{{ $userInput }}  <!-- Automatically escaped -->
```

#### Content Security Policy (CSP)
Consider implementing CSP headers in production for additional protection.

### 7. Password Security

#### Hashing
All passwords are hashed using bcrypt:
```php
protected function casts(): array
{
    return [
        'password' => 'hashed',  // Automatically hashed
    ];
}
```

#### Password Requirements
Implement strong password requirements in production:
- Minimum 8 characters
- Include uppercase, lowercase, numbers, and symbols
- Use `Rules\Password::defaults()` for enforcement

### 8. Sensitive Data Protection

#### Environment Variables
All sensitive configuration stored in `.env` file:
```env
APP_KEY=base64:...
DB_PASSWORD=...
MAIL_PASSWORD=...
```

**Never commit `.env` file to version control!**

#### Hidden Model Attributes
Sensitive fields automatically hidden from JSON responses:
```php
protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
];
```

### 9. File Upload Security (When Implemented)

#### Validation Rules to Implement
```php
'file' => ['required', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
```

#### Storage Best Practices
- Store uploads outside public directory when possible
- Generate unique filenames to prevent overwrites
- Validate file types both by extension and MIME type
- Scan files for malware if handling sensitive uploads

### 10. Session Security

#### Configuration
Ensure secure session configuration in `config/session.php`:
```php
'secure' => env('SESSION_SECURE_COOKIE', true),  // HTTPS only
'http_only' => true,  // Prevent JavaScript access
'same_site' => 'lax',  // CSRF protection
```

### 11. Logging & Monitoring

#### Security Event Logging
All critical operations are logged:
- Enrollment submissions
- Contact form submissions
- Enrollment approvals/rejections
- Contact status changes

#### Log Levels
- `info`: Normal operations
- `warning`: Suspicious activity
- `error`: Failed operations

## Security Checklist for Production

### Before Deployment
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate new `APP_KEY`
- [ ] Use HTTPS for all traffic
- [ ] Enable secure session cookies
- [ ] Configure proper CORS settings
- [ ] Set up firewall rules
- [ ] Configure database user with minimal privileges
- [ ] Enable query logging for monitoring
- [ ] Set up automated backups
- [ ] Configure email notifications for errors

### Regular Maintenance
- [ ] Update Laravel and dependencies regularly
- [ ] Review and rotate API keys/secrets quarterly
- [ ] Monitor logs for suspicious activity
- [ ] Review user permissions and access
- [ ] Test backup restoration process
- [ ] Update SSL certificates before expiration
- [ ] Review and update security policies

## Common Vulnerabilities to Avoid

### 1. Mass Assignment
Always define `$fillable` or `$guarded` in models:
```php
protected $fillable = ['name', 'email', 'phone'];
```

### 2. Unvalidated Redirects
Always validate redirect destinations:
```php
// Safe
return redirect()->route('home');

// Potentially unsafe
return redirect($request->input('redirect'));
```

### 3. Exposed Sensitive Data in Logs
Never log passwords or tokens:
```php
// Bad
Log::info('User login', ['password' => $password]);

// Good
Log::info('User login', ['email' => $email]);
```

### 4. Inadequate Authorization Checks
Always verify user permissions:
```php
// In controller
if (!$request->user()->isAdmin()) {
    abort(403);
}
```

## Reporting Security Issues

If you discover a security vulnerability, please email:
- **Security Email**: security@escolaparque.com.br

Do not create public GitHub issues for security vulnerabilities.

## Additional Resources

- [Laravel Security Documentation](https://laravel.com/docs/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Best Practices](https://laravel.com/docs/deployment#optimization)

## Updates to This Document

This document should be reviewed and updated:
- When new security features are added
- After security incidents
- Quarterly as part of security review
- When Laravel is upgraded to new major versions

Last Updated: 2026-01-07
