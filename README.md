# Laravel PHPMailer Driver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
[![Total Downloads](https://img.shields.io/packagist/dt/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
[![License](https://img.shields.io/packagist/l/mertcanaydin97/laravel-phpmailer-driver.svg)](https://github.com/mertcanaydin97/laravel-phpmailer-driver/blob/main/LICENSE.md)
[![PHP Version](https://img.shields.io/packagist/php-v/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)

> **❗️ IMPORTANT: This package is optimized for Laravel 10+ with Symfony Mailer. If you see "Mailer [phpmailer] not defined", you MUST add the PHPMailer mailer config to your `config/mail.php` (see below) and clear your config cache!**

A powerful and feature-rich Laravel mail driver that seamlessly integrates PHPMailer with Laravel's mail system. This package provides enterprise-grade email functionality with comprehensive attachment support, custom headers, and extensive debugging capabilities.

## ✨ Features

### 🚀 Core Features
- **Custom PHPMailer Integration** - Seamless integration with Laravel's mail system
- **Laravel 10+ Optimized** - Full support for Symfony Mailer with enhanced transport
- **Advanced SMTP Support** - SSL/TLS encryption, authentication, and timeout configuration
- **Rich Email Content** - HTML and plain text email support with automatic fallbacks
- **File Attachments** - Full support for file attachments with proper MIME types
- **Recipient Management** - TO, CC, BCC, and Reply-To support
- **Custom Headers** - Complete custom headers support for tracking and metadata
- **Debug Mode** - Built-in SMTP debugging for troubleshooting

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

### Debug Mode

Enable debug mode to troubleshoot SMTP issues:

```env
MAIL_DEBUG=true
```

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
- **Newsletter** - `resources/views/vendor/phpmailer/emails/newsletter.blade.php`

### Using Templates

```php
Mail::mailer('phpmailer')->send(new \Illuminate\Mail\Message([
    'view' => 'vendor.phpmailer.emails.welcome',
    'data' => [
        'name' => 'John Doe',
        'company' => 'Your Company'
    ]
]));
```

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
Mail::mailer('phpmailer')->send(new WelcomeEmail());
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

## 📞 Need Help?

If you're still experiencing issues:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode: `MAIL_DEBUG=true` in `.env`
3. Verify your SMTP settings
4. Test with a different email provider (Gmail, Outlook, etc.)
5. Check the test command output for specific error messages

## 📄 License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📊 Version History

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
