# Laravel PHPMailer Driver - Installation Guide

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

## 🔧 Common Issues & Solutions

### ❌ Error: "Mailer [phpmailer] not defined"

**Solution**: You forgot to add the mailer configuration to `config/mail.php`

1. Make sure you added the `phpmailer` configuration to the `mailers` array
2. Clear config cache: `php artisan config:clear`
3. Check that `MAIL_MAILER=phpmailer` is set in your `.env`

### ❌ Error: "Illuminate transport not found"

**Solution**: This package is optimized for Laravel 10+

1. Make sure you're using Laravel 10.0 or newer
2. Update to the latest version: `composer update mertcanaydin97/laravel-phpmailer-driver`
3. Clear all caches

### ❌ Error: "Class not found"

**Solution**: Autoload issues

1. Run `composer dump-autoload`
2. Clear all caches: `php artisan config:clear && php artisan cache:clear`

## 📋 Complete Configuration Example

### config/mail.php

```php
<?php

return [
    'default' => env('MAIL_MAILER', 'phpmailer'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
        ],

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

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],
];
```

### .env

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
```

## 🧪 Testing

### Test Email Sending

```bash
# Test with default settings
php artisan phpmailer:test

# Test with custom email
php artisan phpmailer:test user@example.com --subject="Test Email" --message="Hello World"
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
```

## 🎯 Troubleshooting Checklist

If you're still having issues, follow this checklist:

1. ✅ **Package installed**: `composer require mertcanaydin97/laravel-phpmailer-driver`
2. ✅ **Mailer config added**: Added `phpmailer` to `config/mail.php` mailers array
3. ✅ **Environment variables set**: `MAIL_MAILER=phpmailer` and SMTP settings in `.env`
4. ✅ **Caches cleared**: `php artisan config:clear && php artisan cache:clear`
5. ✅ **Autoload refreshed**: `composer dump-autoload`
6. ✅ **Test command works**: `php artisan phpmailer:test`

## 📞 Need Help?

If you're still experiencing issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode: `APP_DEBUG=true` in `.env`
3. Verify your SMTP settings
4. Test with a different email provider (Gmail, Outlook, etc.)

---

**Made with ❤️ by [Mertcan Aydın](https://github.com/mertcanaydin97)** 
