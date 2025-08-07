# Laravel PHPMailer Driver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
[![Total Downloads](https://img.shields.io/packagist/dt/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
[![License](https://img.shields.io/packagist/l/mertcanaydin97/laravel-phpmailer-driver.svg)](https://github.com/mertcanaydin97/laravel-phpmailer-driver/blob/main/LICENSE.md)
[![PHP Version](https://img.shields.io/packagist/php-v/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)

> **❗️ IMPORTANT: This package is optimized for Laravel 10+ with Symfony Mailer. If you see "Mailer [phpmailer] not defined", you MUST add the PHPMailer mailer config to your `config/mail.php` (see below) and clear your config cache!**

A powerful and feature-rich Laravel mail driver that seamlessly integrates PHPMailer with Laravel's mail system. This package provides enterprise-grade email functionality with comprehensive attachment support, custom headers, SSL verification options, and extensive debugging capabilities.

## ✨ Features

### 🚀 Core Features
- **Custom PHPMailer Integration** - Seamless integration with Laravel's mail system
- **Laravel 10+ Optimized** - Full support for Symfony Mailer with enhanced transport
- **Advanced SMTP Support** - SSL/TLS encryption, authentication, and timeout configuration
- **Rich Email Content** - HTML and plain text email support with automatic fallbacks
- **File Attachments** - Full support for file attachments with proper MIME types
- **Recipient Management** - TO, CC, BCC, and Reply-To support
- **Custom Headers** - Complete custom headers support for tracking and metadata
- **SSL Verification Control** - Configurable SSL certificate verification options

### 🔧 Enhanced Features
- **Type Safety** - Proper type casting and null safety checks
- **Error Handling** - Comprehensive error handling with descriptive messages
- **Fallback Support** - Automatic fallbacks for missing content and addresses
- **Production Ready** - Battle-tested in production environments
- **Clean Architecture** - Well-organized, maintainable code structure

### 🌍 Internationalization
- **13 Languages Supported** - English, Spanish, French, German, Italian, Portuguese, Russian, Japanese, Chinese, Korean, Arabic, Hindi, Turkish
- **Localized Templates** - All email templates support translation
- **RTL Language Support** - Full support for Arabic and other RTL languages
- **Culture-Specific Formatting** - Date, time, and number formatting

### 📧 Email Templates
- **6 Beautiful Templates** - Welcome, Password Reset, Notification, Order Confirmation, Contact Form
- **Responsive Design** - Perfect display on desktop, tablet, and mobile
- **Modern Styling** - Beautiful gradients and clean typography
- **Email Client Compatible** - Tested across major email clients
- **Fully Customizable** - Publish and override templates as needed
- **Accessible** - Proper contrast ratios and semantic HTML

### 🛠 Developer Experience
- **Artisan Commands** - Built-in testing and utility commands
- **Comprehensive Testing** - Full test suite with PHPUnit
- **Detailed Documentation** - Extensive guides and examples
- **Easy Configuration** - Simple setup and configuration
- **Debug Tools** - Built-in debugging and troubleshooting commands

## 📋 Requirements

- PHP 7.4 or higher
- Laravel 9.0, 10.0, 11.0, or newer
- PHPMailer 6.8 or higher

## 🚀 Quick Installation for Laravel 10+

### Step 1: Install the Package

```bash
composer require mertcanaydin97/laravel-phpmailer-driver
```

### Step 2: Configure Mail Settings

**CRITICAL**: You MUST add the PHPMailer mailer to your `config/mail.php` file.

1. Open your `config/mail.php` file
2. Find the `mailers` array
3. Add this configuration:

```php
'mailers' => [
    // ... existing mailers ...
    
    // Add this PHPMailer configuration
    'phpmailer' => [
        'transport' => 'phpmailer',
        'host' => env('MAIL_HOST', 'localhost'),
        'port' => env('MAIL_PORT', 587),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'timeout' => env('MAIL_TIMEOUT', 30),
    ],
],
```

**See `examples/config-mail.php` for a complete example.**

### Step 3: Set Environment Variables

Add these to your `.env` file:

```env
MAIL_MAILER=phpmailer
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_TIMEOUT=30
MAIL_DEBUG=false
MAIL_DEBUG_LEVEL=0
MAIL_DEBUG_OUTPUT=error_log
MAIL_SSL_VERIFY_PEER=true
MAIL_SSL_VERIFY_PEER_NAME=true
MAIL_SSL_ALLOW_SELF_SIGNED=false
```

### Step 4: Clear All Caches

```bash
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

### Step 5: Test the Installation

```bash
php artisan phpmailer:test
```

## 📖 Usage

### Basic Email Sending

```php
use Illuminate\Support\Facades\Mail;

// Simple text email
Mail::mailer('phpmailer')->raw('Hello World', function ($message) {
    $message->to('user@example.com')
            ->subject('Test Email');
});

// HTML email
Mail::mailer('phpmailer')->html('<h1>Hello World</h1>', function ($message) {
    $message->to('user@example.com')
            ->subject('Test HTML Email');
});
```

### Advanced Email Features

```php
// Multiple recipients with CC, BCC, and Reply-To
Mail::mailer('phpmailer')->raw('Hello World', function ($message) {
    $message->to(['user1@example.com', 'user2@example.com'])
            ->cc('cc@example.com')
            ->bcc('bcc@example.com')
            ->replyTo('reply@example.com', 'Reply Name')
            ->subject('Test Email');
});

// With attachments
Mail::mailer('phpmailer')->raw('Hello World', function ($message) {
    $message->to('user@example.com')
            ->subject('Test Email')
            ->attach('/path/to/file.pdf')
            ->attach('/path/to/image.jpg');
});

// With custom headers
Mail::mailer('phpmailer')->raw('Hello World', function ($message) {
    $message->to('user@example.com')
            ->subject('Test Email')
            ->getHeaders()
            ->addTextHeader('X-Custom-Header', 'Custom Value')
            ->addTextHeader('X-Priority', '1');
});
```

### Using Mailable Classes

```php
use Illuminate\Mail\Mailable;

class WelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to Our App')
                    ->attach('/path/to/welcome.pdf');
    }
}

// Send using PHPMailer
Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail());
```

## 🔧 Configuration Options

### Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `MAIL_MAILER` | Mail driver to use | `phpmailer` |
| `MAIL_HOST` | SMTP host | `localhost` |
| `MAIL_PORT` | SMTP port | `587` |
| `MAIL_USERNAME` | SMTP username | - |
| `MAIL_PASSWORD` | SMTP password | - |
| `MAIL_ENCRYPTION` | Encryption type (`tls` or `ssl`) | `tls` |
| `MAIL_FROM_ADDRESS` | Default from address | - |
| `MAIL_FROM_NAME` | Default from name | - |
| `MAIL_TIMEOUT` | SMTP timeout in seconds | `30` |
| `MAIL_DEBUG` | Enable SMTP debugging | `false` |
| `MAIL_DEBUG_LEVEL` | Debug level (0-4) | `0` |
| `MAIL_DEBUG_OUTPUT` | Debug output method | `error_log` |
| `MAIL_SSL_VERIFY_PEER` | Verify SSL peer certificate | `true` |
| `MAIL_SSL_VERIFY_PEER_NAME` | Verify SSL peer name | `true` |
| `MAIL_SSL_ALLOW_SELF_SIGNED` | Allow self-signed certificates | `false` |

### Debug Mode

Enable debug mode to troubleshoot SMTP issues:

```env
MAIL_DEBUG=true
MAIL_DEBUG_LEVEL=2
MAIL_DEBUG_OUTPUT=error_log
```

#### **Debug Levels**
- `0` - No debug output
- `1` - Client messages
- `2` - Client and server messages
- `3` - Connection information
- `4` - Low-level data

#### **Debug Output Methods**
- `error_log` - Output to PHP error log (default)
- `echo` - Output to browser/console
- `html` - Output as HTML

#### **SSL Verification Options**

For development or self-signed certificates, you can disable SSL verification:

```env
MAIL_SSL_VERIFY_PEER=false
MAIL_SSL_VERIFY_PEER_NAME=false
MAIL_SSL_ALLOW_SELF_SIGNED=true
```

**⚠️ Warning**: Only disable SSL verification in development environments. In production, always use proper SSL certificates.

This will show detailed SMTP communication in your logs.

## 🔧 Common Issues & Solutions

### ❌ Error: "Mailer [phpmailer] not defined"

**Solution**: You forgot to add the mailer configuration to `config/mail.php`

1. Make sure you added the `phpmailer` configuration to the `mailers` array
2. Clear config cache: `php artisan config:clear`
3. Check that `MAIL_MAILER=phpmailer` is set in your `.env`

### ❌ Error: "No recipients specified for the email"

**Solution**: Make sure you're setting recipients in your email

```php
// Correct way
Mail::mailer('phpmailer')->raw('Hello', function ($message) {
    $message->to('user@example.com')->subject('Test');
});

// Wrong way - no recipients
Mail::mailer('phpmailer')->raw('Hello', function ($message) {
    $message->subject('Test'); // Missing to() method
});
```

### ❌ Error: "PHPMailer failed to send email"

**Solution**: Check your SMTP configuration

1. Verify your SMTP credentials
2. Check if your email provider requires app passwords
3. Enable debug mode: `MAIL_DEBUG=true`
4. Check firewall/network restrictions

### ❌ Error: "Class not found"

**Solution**: Autoload issues

1. Run `composer dump-autoload`
2. Clear all caches: `php artisan config:clear && php artisan cache:clear`

### ❌ Error: "Class Illuminate\Mail\Transport\Transport not found"

**Solution**: You're using an incorrect approach. Use one of these correct methods:

```php
// ❌ WRONG - This causes the Transport error
Mail::mailer('phpmailer')->send(new \Illuminate\Mail\Message([
    'view' => 'emails.welcome',
    'data' => ['name' => 'John Doe']
]));

// ✅ CORRECT - Using Mailable class (Recommended)
class WelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome')
                    ->with([
                        'name' => 'John Doe',
                        'company' => 'Your Company'
                    ]);
    }
}

Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail());

// ✅ CORRECT - Using HTML with template rendering
$html = view('emails.welcome', [
    'name' => 'John Doe',
    'company' => 'Your Company'
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});

// ✅ CORRECT - Simple raw email
Mail::mailer('phpmailer')->raw('Hello John Doe!', function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});
```

**Alternative Solutions**:

1. **Use raw email sending**:
```php
Mail::mailer('phpmailer')->raw('Hello World', function ($message) {
    $message->to('user@example.com')->subject('Test Email');
});
```

2. **Use HTML email**:
```php
Mail::mailer('phpmailer')->html('<h1>Hello World</h1>', function ($message) {
    $message->to('user@example.com')->subject('Test HTML Email');
});
```

3. **Check your template path**:
```php
// Make sure your template exists at: resources/views/emails/welcome.blade.php
// Or publish the package templates first:
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates
```

## 🛡️ Error Handling & Responses

### Laravel's Native Error Handling

The PHPMailer driver integrates seamlessly with Laravel's native error handling system:

#### **Automatic Logging**
All email operations are automatically logged to Laravel's log system:

```php
// Successful email sends are logged as INFO
Log::info('Email sent successfully via PHPMailer', [
    'to' => ['user@example.com'],
    'subject' => 'Welcome Email',
    'message_id' => 'phpmailer_abc123'
]);

// Failed email sends are logged as ERROR
Log::error('PHPMailer failed to send email', [
    'error' => 'SMTP connect() failed',
    'to' => ['user@example.com'],
    'subject' => 'Welcome Email',
    'host' => 'smtp.gmail.com',
    'port' => 587
]);
```

#### **Exception Handling**
The driver throws proper Symfony Mailer exceptions that Laravel can handle:

```php
use Symfony\Component\Mailer\Exception\TransportException;

try {
    Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail());
} catch (TransportException $e) {
    // Handle email sending errors
    Log::error('Email sending failed: ' . $e->getMessage());
    
    // You can also notify administrators
    // or implement retry logic
}
```

#### **Queue Integration**
When using Laravel's queue system, failed jobs are automatically handled:

```php
// Queue the email
Mail::mailer('phpmailer')->to('user@example.com')->queue(new WelcomeEmail());

// Failed jobs will be retried according to your queue configuration
// You can monitor failed jobs with: php artisan queue:failed
```

### **Error Types & Responses**

#### **1. Configuration Errors**
```php
// Missing SMTP credentials
TransportException: "PHPMailer error: SMTP connect() failed"

// Missing from address
TransportException: "No from address specified and no default from address configured"

// Missing recipients
TransportException: "No recipients specified for the email"
```

#### **2. SMTP Errors**
```php
// Authentication failed
TransportException: "PHPMailer error: SMTP Error: Could not authenticate"

// Connection timeout
TransportException: "PHPMailer error: SMTP connect() failed"

// Invalid credentials
TransportException: "PHPMailer error: SMTP Error: Authentication failed"
```

#### **3. Content Errors**
```php
// Invalid email format
TransportException: "PHPMailer error: Invalid address: invalid-email"

// Attachment issues
TransportException: "PHPMailer error: Could not access file: /path/to/file"
```

### **Debugging & Troubleshooting**

#### **Enable Debug Mode**
```env
MAIL_DEBUG=true
```

This will show detailed SMTP communication in your logs.

#### **Check Laravel Logs**
```bash
# View recent logs
tail -f storage/logs/laravel.log

# Search for PHPMailer errors
grep "PHPMailer" storage/logs/laravel.log
```

#### **Test SMTP Connection**
```bash
# Use the built-in test command
php artisan phpmailer:test --to=your@email.com
```

#### **Monitor Queue Jobs**
```bash
# Check failed jobs
php artisan queue:failed

# Retry failed jobs
php artisan queue:retry all
```

### **Custom Error Handling**

#### **Global Exception Handler**
```php
// app/Exceptions/Handler.php
public function register(): void
{
    $this->reportable(function (TransportException $e) {
        // Custom handling for email transport errors
        if (str_contains($e->getMessage(), 'PHPMailer')) {
            // Notify administrators
            // Log to external service
            // Send alert to monitoring system
        }
    });
}
```

#### **Middleware for Email Errors**
```php
// Create custom middleware to handle email errors
class EmailErrorMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (TransportException $e) {
            // Handle email errors in web requests
            return response()->json([
                'error' => 'Email service temporarily unavailable',
                'message' => 'Please try again later'
            ], 503);
        }
    }
}
```

#### **Event Listeners**
```php
// Listen for email events
Event::listen('mailer.sending', function ($message) {
    Log::info('Attempting to send email', [
        'to' => $message->getTo(),
        'subject' => $message->getSubject()
    ]);
});

Event::listen('mailer.sent', function ($message) {
    Log::info('Email sent successfully', [
        'to' => $message->getTo(),
        'subject' => $message->getSubject()
    ]);
});
```

### **Response Handling**

#### **Synchronous Responses**
```php
// Check if email was sent successfully
try {
    Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail());
    return response()->json(['message' => 'Email sent successfully']);
} catch (TransportException $e) {
    return response()->json(['error' => 'Failed to send email'], 500);
}
```

#### **Asynchronous Responses**
```php
// Queue the email and return immediately
Mail::mailer('phpmailer')->to('user@example.com')->queue(new WelcomeEmail());

return response()->json(['message' => 'Email queued for delivery']);
```

#### **Batch Email Handling**
```php
$results = [];
$emails = ['user1@example.com', 'user2@example.com', 'user3@example.com'];

foreach ($emails as $email) {
    try {
        Mail::mailer('phpmailer')->to($email)->send(new NewsletterEmail());
        $results[$email] = 'sent';
    } catch (TransportException $e) {
        $results[$email] = 'failed: ' . $e->getMessage();
    }
}

return response()->json(['results' => $results]);
```

## 🧪 Testing

### Test Email Sending

```bash
# Test with default settings
php artisan phpmailer:test

# Test with custom email
php artisan phpmailer:test --to=your@email.com
```

### Test in Code

```php
use Illuminate\Support\Facades\Mail;

// Simple test
Mail::mailer('phpmailer')
    ->to('test@example.com')
    ->raw('Test email from Laravel PHPMailer Driver', function ($message) {
        $message->subject('Test Email');
    });

// Test with attachments
Mail::mailer('phpmailer')
    ->to('test@example.com')
    ->raw('Test email with attachment', function ($message) {
        $message->subject('Test Email')
                ->attach('/path/to/test.pdf');
    });
```

## 📧 Email Templates

### Publishing Templates

```bash
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates
```

### Available Templates

- **Welcome Email** - `resources/views/vendor/phpmailer/emails/welcome.blade.php`
- **Password Reset** - `resources/views/vendor/phpmailer/emails/password-reset.blade.php`
- **Notification** - `resources/views/vendor/phpmailer/emails/notification.blade.php`
- **Order Confirmation** - `resources/views/vendor/phpmailer/emails/order-confirmation.blade.php`
- **Contact Form** - `resources/views/vendor/phpmailer/emails/contact-form.blade.php`

### Using Built-in Templates

#### **Basic Template Usage**

```php
use Illuminate\Support\Facades\Mail;

// ✅ CORRECT - Using Mailable class (Recommended)
class WelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('vendor.phpmailer.emails.welcome')
                    ->subject('Welcome to ' . config('app.name'))
                    ->with([
                        'name' => 'John Doe',
                        'company' => 'Your Company',
                        'activation_link' => 'https://yourapp.com/activate/123'
                    ]);
    }
}

// Send the email
Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail());

// ✅ CORRECT - Using raw HTML with template rendering
$html = view('vendor.phpmailer.emails.welcome', [
    'name' => 'John Doe',
    'company' => 'Your Company',
    'activation_link' => 'https://yourapp.com/activate/123'
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});

// ✅ CORRECT - Simple approach without templates
Mail::mailer('phpmailer')->raw('Hello John Doe, welcome to Your Company!', function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});
```

#### **Using Mailable Classes with Templates**

```php
use Illuminate\Mail\Mailable;

class WelcomeEmail extends Mailable
{
    public $user;
    public $activationLink;

    public function __construct($user, $activationLink)
    {
        $this->user = $user;
        $this->activationLink = $activationLink;
    }

    public function build()
    {
        return $this->view('vendor.phpmailer.emails.welcome')
                    ->subject('Welcome to ' . config('app.name'))
                    ->with([
                        'name' => $this->user->name,
                        'company' => config('app.name'),
                        'activation_link' => $this->activationLink
                    ]);
    }
}

// Send the email
Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail($user, $activationLink));
```

#### **Password Reset Template**

```php
use Illuminate\Support\Facades\Mail;

// ✅ CORRECT - Using Mailable class
class PasswordResetEmail extends Mailable
{
    public function build()
    {
        return $this->view('vendor.phpmailer.emails.password-reset')
                    ->subject('Password Reset Request')
                    ->with([
                        'name' => 'John Doe',
                        'reset_link' => 'https://yourapp.com/reset-password?token=abc123',
                        'expires_in' => '60 minutes'
                    ]);
    }
}

Mail::mailer('phpmailer')->to('user@example.com')->send(new PasswordResetEmail());

// ✅ CORRECT - Using HTML with template rendering
$html = view('vendor.phpmailer.emails.password-reset', [
    'name' => 'John Doe',
    'reset_link' => 'https://yourapp.com/reset-password?token=abc123',
    'expires_in' => '60 minutes'
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Password Reset Request');
});
```

#### **Order Confirmation Template**

```php
// ✅ CORRECT - Using Mailable class
class OrderConfirmationEmail extends Mailable
{
    public function build()
    {
        return $this->view('vendor.phpmailer.emails.order-confirmation')
                    ->subject('Order Confirmation - ORD-2024-001')
                    ->with([
                        'name' => 'John Doe',
                        'order_number' => 'ORD-2024-001',
                        'order_date' => now()->format('F j, Y'),
                        'total_amount' => '$99.99',
                        'items' => [
                            ['name' => 'Product 1', 'price' => '$49.99'],
                            ['name' => 'Product 2', 'price' => '$50.00']
                        ]
                    ]);
    }
}

Mail::mailer('phpmailer')->to('user@example.com')->send(new OrderConfirmationEmail());

// ✅ CORRECT - Using HTML with template rendering
$html = view('vendor.phpmailer.emails.order-confirmation', [
    'name' => 'John Doe',
    'order_number' => 'ORD-2024-001',
    'order_date' => now()->format('F j, Y'),
    'total_amount' => '$99.99',
    'items' => [
        ['name' => 'Product 1', 'price' => '$49.99'],
        ['name' => 'Product 2', 'price' => '$50.00']
    ]
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Order Confirmation - ORD-2024-001');
});
```

### Creating Custom Templates

#### **Template Structure**

Create your custom template in `resources/views/emails/`:

```php
// resources/views/emails/custom-welcome.blade.php
@extends('vendor.phpmailer.emails.layouts.base')

@section('content')
<div class="email-container">
    <div class="header">
        <h1>Welcome to {{ $company }}</h1>
    </div>
    
    <div class="content">
        <p>Hello {{ $name }},</p>
        <p>Thank you for joining {{ $company }}! We're excited to have you on board.</p>
        
        @if(isset($activation_link))
        <div class="cta-button">
            <a href="{{ $activation_link }}" class="button">Activate Your Account</a>
        </div>
        @endif
        
        <p>If you have any questions, feel free to contact our support team.</p>
    </div>
    
    <div class="footer">
        <p>Best regards,<br>The {{ $company }} Team</p>
    </div>
</div>
@endsection
```

#### **Using Custom Templates**

```php
// Or using Mailable class
class CustomWelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('emails.custom-welcome')
                    ->subject('Welcome to ' . config('app.name'))
                    ->with([
                        'name' => $this->user->name,
                        'company' => config('app.name'),
                        'activation_link' => $this->activationLink
                    ]);
    }
}
```

### Template Variables & Data

#### **Common Template Variables**

```php
// Available variables in all templates
$data = [
    'name' => 'John Doe',                    // User's name
    'company' => 'Your Company',             // Company name
    'app_name' => config('app.name'),        // Application name
    'app_url' => config('app.url'),          // Application URL
    'support_email' => 'support@company.com', // Support email
    'logo_url' => 'https://company.com/logo.png', // Company logo
    'year' => date('Y'),                     // Current year
    'date' => now()->format('F j, Y'),       // Current date
];
```

#### **Conditional Content in Templates**

```php
{{-- resources/views/emails/dynamic-content.blade.php --}}
@extends('vendor.phpmailer.emails.layouts.base')

@section('content')
<div class="email-container">
    <h1>Hello {{ $name }}!</h1>
    
    @if(isset($welcome_message))
        <p>{{ $welcome_message }}</p>
    @endif
    
    @if(isset($features) && count($features) > 0)
        <h2>Key Features:</h2>
        <ul>
            @foreach($features as $feature)
                <li>{{ $feature }}</li>
            @endforeach
        </ul>
    @endif
    
    @if(isset($cta_button))
        <div class="cta-button">
            <a href="{{ $cta_button['url'] }}" class="button">
                {{ $cta_button['text'] }}
            </a>
        </div>
    @endif
</div>
@endsection
```

#### **Using Dynamic Content**

```php
$html = view('emails.dynamic-content', [
    'name' => 'John Doe',
    'welcome_message' => 'Welcome to our platform!',
    'features' => [
        'Feature 1: Easy to use',
        'Feature 2: Secure',
        'Feature 3: Fast'
    ],
    'cta_button' => [
        'text' => 'Get Started',
        'url' => 'https://yourapp.com/dashboard'
    ]
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});
```

### Template Styling & Layouts

#### **Base Layout Template**

```php
{{-- resources/views/vendor/phpmailer/emails/layouts/base.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Email from ' . config('app.name') }}</title>
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
            background: #ffffff;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        @yield('content')
    </div>
</body>
</html>
```

#### **Custom Styling**

```php
{{-- resources/views/emails/styled-template.blade.php --}}
@extends('vendor.phpmailer.emails.layouts.base')

@section('content')
<style>
    .custom-header {
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
        border-radius: 10px 10px 0 0;
    }
    .custom-content {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    .custom-button {
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
</style>

<div class="custom-header">
    <h1>{{ $title }}</h1>
</div>

<div class="custom-content">
    <p>{{ $message }}</p>
    
    @if(isset($action_url))
    <a href="{{ $action_url }}" class="button custom-button">
        {{ $action_text ?? 'Click Here' }}
    </a>
    @endif
</div>
@endsection
```

### Template Localization

#### **Multi-language Templates**

```php
{{-- resources/views/emails/localized-welcome.blade.php --}}
@extends('vendor.phpmailer.emails.layouts.base')

@section('content')
<div class="email-container">
    <div class="header">
        <h1>{{ __('emails.welcome.title', ['company' => $company]) }}</h1>
    </div>
    
    <div class="content">
        <p>{{ __('emails.welcome.greeting', ['name' => $name]) }}</p>
        <p>{{ __('emails.welcome.message') }}</p>
        
        @if(isset($activation_link))
        <div class="cta-button">
            <a href="{{ $activation_link }}" class="button">
                {{ __('emails.welcome.activate_button') }}
            </a>
        </div>
        @endif
    </div>
    
    <div class="footer">
        <p>{{ __('emails.welcome.footer', ['company' => $company]) }}</p>
    </div>
</div>
@endsection
```

#### **Language Files**

```php
// resources/lang/en/emails.php
return [
    'welcome' => [
        'title' => 'Welcome to :company',
        'greeting' => 'Hello :name,',
        'message' => 'Thank you for joining our platform!',
        'activate_button' => 'Activate Your Account',
        'footer' => 'Best regards, The :company Team'
    ]
];

// resources/lang/es/emails.php
return [
    'welcome' => [
        'title' => 'Bienvenido a :company',
        'greeting' => 'Hola :name,',
        'message' => '¡Gracias por unirte a nuestra plataforma!',
        'activate_button' => 'Activar Tu Cuenta',
        'footer' => 'Saludos, El Equipo de :company'
    ]
];
```

#### **Sending Localized Emails**

```php
// Set locale before sending
app()->setLocale('es');

$html = view('emails.localized-welcome', [
    'name' => 'Juan Pérez',
    'company' => 'Mi Empresa'
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});
```

### Template Testing

#### **Testing Templates in Development**

```php
// Create a test route for template preview
Route::get('/test-email-template', function () {
    return view('emails.custom-welcome', [
        'name' => 'Test User',
        'company' => 'Test Company',
        'activation_link' => 'https://example.com/activate'
    ]);
});
```

#### **Template Validation**

```php
// Validate template data before sending
class EmailTemplateValidator
{
    public static function validateWelcomeEmail($data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'activation_link' => 'required|url'
        ];
        
        return Validator::make($data, $rules);
    }
}

// Usage
$data = [
    'name' => 'John Doe',
    'company' => 'Your Company',
    'activation_link' => 'https://yourapp.com/activate/123'
];

$validator = EmailTemplateValidator::validateWelcomeEmail($data);

if ($validator->fails()) {
    // Handle validation errors
    return response()->json(['errors' => $validator->errors()], 422);
}

// Send email if validation passes
$html = view('emails.custom-welcome', $data)->render();
Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});
```

### Advanced Template Features

#### **Template Inheritance**

```php
{{-- resources/views/emails/layouts/advanced.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Email from ' . config('app.name'))</title>
    @yield('styles')
</head>
<body>
    @yield('header')
    
    <main>
        @yield('content')
    </main>
    
    @yield('footer')
    
    @yield('scripts')
</body>
</html>
```

#### **Component-based Templates**

```php
{{-- resources/views/emails/components/header.blade.php --}}
<div class="email-header">
    <img src="{{ $logo_url ?? config('app.logo_url') }}" alt="{{ $company }}" class="logo">
    <h1>{{ $title }}</h1>
</div>

{{-- resources/views/emails/components/footer.blade.php --}}
<div class="email-footer">
    <p>{{ $footer_text ?? 'Thank you for using our service.' }}</p>
    <div class="social-links">
        @if(isset($social_links))
            @foreach($social_links as $platform => $url)
                <a href="{{ $url }}">{{ ucfirst($platform) }}</a>
            @endforeach
        @endif
    </div>
</div>

{{-- Using components in templates --}}
@extends('vendor.phpmailer.emails.layouts.advanced')

@section('content')
    @include('emails.components.header', [
        'title' => 'Welcome!',
        'company' => $company,
        'logo_url' => $logo_url
    ])
    
    <div class="main-content">
        <p>Hello {{ $name }},</p>
        <p>{{ $message }}</p>
    </div>
    
    @include('emails.components.footer', [
        'footer_text' => 'Best regards, The ' . $company . ' Team',
        'social_links' => [
            'facebook' => 'https://facebook.com/company',
            'twitter' => 'https://twitter.com/company'
        ]
    ])
@endsection
```

This comprehensive template usage guide covers everything from basic template usage to advanced features like localization, component-based templates, and testing strategies!

## 🌍 Internationalization

### Publishing Translations

```bash
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-lang
```

### Supported Languages

- English (en)
- Spanish (es)
- French (fr)
- German (de)
- Italian (it)
- Portuguese (pt)
- Russian (ru)
- Japanese (ja)
- Chinese (zh)
- Korean (ko)
- Arabic (ar)
- Hindi (hi)
- Turkish (tr)

### Using Translations

```php
// Set locale
app()->setLocale('es');

// Send email with Spanish translations
$html = view('emails.localized-welcome', [
    'name' => 'Juan Pérez',
    'company' => 'Mi Empresa'
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});
```

## 🎯 Troubleshooting Checklist

If you're still having issues, follow this checklist:

1. ✅ **Package installed**: `composer require mertcanaydin97/laravel-phpmailer-driver`
2. ✅ **Mailer config added**: Added `phpmailer` to `config/mail.php` mailers array
3. ✅ **Environment variables set**: `MAIL_MAILER=phpmailer` and SMTP settings in `.env`
4. ✅ **Caches cleared**: `php artisan config:clear && php artisan cache:clear`
5. ✅ **Autoload refreshed**: `composer dump-autoload`
6. ✅ **Test command works**: `php artisan phpmailer:test`
7. ✅ **Debug mode enabled**: Set `MAIL_DEBUG=true` for detailed logs
8. ✅ **SSL verification**: Check SSL settings for your SMTP provider
9. ✅ **Template paths**: Verify template paths and publish if needed

## 📞 Need Help?

If you're still experiencing issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode: `MAIL_DEBUG=true` in `.env`
3. Verify your SMTP settings
4. Test with a different email provider (Gmail, Outlook, etc.)
5. Check the test command output for specific error messages
6. Review SSL verification settings for your environment

## 📄 License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📊 Version History

- **v1.1.3** - Comprehensive README update and documentation fixes
- **v1.1.2** - Added SSL verification options and enhanced debug settings
- **v1.1.1** - Added comprehensive template usage documentation and fixed template errors
- **v1.1.0** - Added comprehensive error handling, logging, and Laravel native integration
- **v1.0.9** - Fixed attachment handling with correct Symfony Mailer methods
- **v1.0.8** - Fixed Stringable interface implementation with __toString() method
- **v1.0.7** - Enhanced transport with attachment support, custom headers, debug mode, and improved error handling
- **v1.0.6** - Fixed Symfony Mailer compatibility and method signatures
- **v1.0.5** - Laravel 10+ configuration improvements
- **v1.0.4** - Simplified transport registration
- **v1.0.3** - Fixed service provider registration
- **v1.0.2** - Added comprehensive test suite
- **v1.0.1** - Initial Laravel 10+ compatibility
- **v1.0.0** - Initial Release

---

**Made with ❤️ by [Mertcan Aydın](https://github.com/mertcanaydin97)** 
