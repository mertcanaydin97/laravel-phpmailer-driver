<?php

/**
 * Template Usage Examples for Laravel PHPMailer Driver
 * 
 * This file shows the correct ways to use templates with the PHPMailer driver
 * and how to avoid the "Class Illuminate\Mail\Transport\Transport not found" error.
 */

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

// ============================================================================
// ✅ CORRECT WAYS TO USE TEMPLATES
// ============================================================================

// Method 1: Using Mailable Class (Recommended)
class WelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to ' . config('app.name'))
                    ->with([
                        'name' => 'John Doe',
                        'company' => 'Your Company',
                        'verificationUrl' => 'https://yourapp.com/verify/123',
                        'loginUrl' => 'https://yourapp.com/login'
                    ]);
    }
}

Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmail());

// Method 1b: Using HTML with template rendering
$html = view('emails.welcome', [
    'name' => 'John Doe',
    'company' => 'Your Company',
    'verificationUrl' => 'https://yourapp.com/verify/123',
    'loginUrl' => 'https://yourapp.com/login'
])->render();

Mail::mailer('phpmailer')->html($html, function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});

// Method 2: Using Mailable Class with Constructor (Best for complex emails)
class WelcomeEmailWithData extends Mailable
{
    public $user;
    public $verificationUrl;

    public function __construct($user, $verificationUrl = null)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to ' . config('app.name'))
                    ->with([
                        'name' => $this->user->name,
                        'company' => config('app.name'),
                        'verificationUrl' => $this->verificationUrl,
                        'loginUrl' => url('/login')
                    ]);
    }
}

// Send using Mailable class with constructor
$user = (object)['name' => 'John Doe'];
Mail::mailer('phpmailer')->to('user@example.com')->send(new WelcomeEmailWithData($user, 'https://yourapp.com/verify/123'));

// Method 3: Simple HTML email (No template needed)
Mail::mailer('phpmailer')->html('<h1>Welcome!</h1><p>Hello John Doe, welcome to our platform!</p>', function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});

// Method 4: Raw text email (No template needed)
Mail::mailer('phpmailer')->raw('Hello John Doe, welcome to our platform!', function ($message) {
    $message->to('user@example.com')->subject('Welcome Email');
});

// ============================================================================
// ❌ WRONG WAYS (Will cause errors)
// ============================================================================

// ❌ DON'T DO THIS - Old Laravel approach
// Mail::send('emails.welcome', $data, function($message) {
//     $message->to('user@example.com')->subject('Welcome');
// });

// ❌ DON'T DO THIS - Missing mailer specification
// Mail::send(new WelcomeEmail());

// ❌ DON'T DO THIS - Wrong approach (This will cause the Transport error)
// Mail::mailer('phpmailer')->send(new \Illuminate\Mail\Message([
//     'view' => 'emails.welcome',
//     'data' => $data
// ]));

// ❌ DON'T DO THIS - Wrong template path
// Mail::mailer('phpmailer')->send(new \Illuminate\Mail\Message([
//     'view' => 'welcome', // Missing 'emails.' prefix
//     'data' => $data
// ]));

// ============================================================================
// TEMPLATE SETUP CHECKLIST
// ============================================================================

/*
1. Make sure your template exists:
   - resources/views/emails/welcome.blade.php
   - resources/views/emails/password-reset.blade.php
   - etc.

2. Or publish package templates:
   php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates

3. Check your mailer configuration in config/mail.php:
   'mailers' => [
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

4. Set your environment variables:
   MAIL_MAILER=phpmailer
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"

5. Clear caches:
   php artisan config:clear
   php artisan cache:clear
   composer dump-autoload
*/

// ============================================================================
// TESTING EXAMPLES
// ============================================================================

// Test 1: Simple template test using HTML rendering
try {
    $html = view('emails.welcome', [
        'name' => 'Test User',
        'company' => 'Test Company'
    ])->render();
    
    Mail::mailer('phpmailer')->html($html, function ($message) {
        $message->to('test@example.com')->subject('Test Template Email');
    });
    echo "✅ Template email sent successfully!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

// Test 2: Mailable class test
try {
    Mail::mailer('phpmailer')->to('test@example.com')->send(new WelcomeEmail());
    echo "✅ Mailable email sent successfully!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

// Test 3: Raw email test
try {
    Mail::mailer('phpmailer')->raw('Test email content', function ($message) {
        $message->to('test@example.com')->subject('Test Email');
    });
    echo "✅ Raw email sent successfully!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
