# Laravel PHPMailer Driver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
[![Total Downloads](https://img.shields.io/packagist/dt/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
[![License](https://img.shields.io/packagist/l/mertcanaydin97/laravel-phpmailer-driver.svg)](https://github.com/mertcanaydin97/laravel-phpmailer-driver/blob/main/LICENSE.md)
[![PHP Version](https://img.shields.io/packagist/php-v/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)

A powerful and feature-rich Laravel mail driver that seamlessly integrates PHPMailer with Laravel's mail system. This package provides enterprise-grade email functionality with beautiful templates, multi-language support, and extensive customization options.

## ✨ Features

### 🚀 Core Features
- **Custom PHPMailer Integration** - Seamless integration with Laravel's mail system
- **Multiple Transport Support** - SMTP, Sendmail, and Qmail
- **Advanced Security** - SSL/TLS encryption support
- **Rich Email Content** - HTML and plain text email support
- **File Management** - File attachments and inline images
- **Recipient Management** - CC and BCC support
- **Custom Headers** - Full custom headers support

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
- **Production Ready** - Battle-tested in production environments

## 📋 Requirements

- PHP 8.0 or higher
- Laravel 9.0, 10.0, or 11.0
- PHPMailer 6.8 or higher

## 🚀 Installation

### Via Composer (Recommended)

```bash
composer require mertcanaydin97/laravel-phpmailer-driver
```

### Manual Installation

1. Clone this repository
2. Run `composer install`
3. Add the service provider to your `config/app.php`:

```php
'providers' => [
    // ...
    Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider::class,
],
```

## ⚙️ Configuration

### 1. Publish Configuration

```bash
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider"
```

### 2. Publish Email Templates (Optional)

```bash
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates
```

This publishes beautiful, responsive email templates to `resources/views/vendor/phpmailer/emails/`.

### 3. Publish Translations (Optional)

```bash
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-lang
```

This publishes translation files to `resources/lang/vendor/phpmailer/` (13 languages available).

### 4. Configure Mail Settings

Update the `config/phpmailer.php` file with your mail server settings:

```php
return [
    'default' => env('MAIL_MAILER', 'phpmailer'),
    
    'mailers' => [
        'phpmailer' => [
            'transport' => 'phpmailer',
            'host' => env('MAIL_HOST', 'smtp.gmail.com'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => env('MAIL_TIMEOUT', 30),
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
            'verify_peer' => env('MAIL_VERIFY_PEER', true),
            'verify_peer_name' => env('MAIL_VERIFY_PEER_NAME', true),
            'allow_self_signed' => env('MAIL_ALLOW_SELF_SIGNED', false),
        ],
    ],
];
```

### 5. Update Environment Variables

Add to your `.env` file:

```env
MAIL_MAILER=phpmailer
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 📖 Usage

### Basic Usage

```php
use Illuminate\Support\Facades\Mail;

Mail::to('recipient@example.com')
    ->send(new \App\Mail\WelcomeMail());
```

### Advanced Usage

```php
use Illuminate\Support\Facades\Mail;
use Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerTransport;

// Send with custom options
Mail::mailer('phpmailer')
    ->to('recipient@example.com')
    ->cc('cc@example.com')
    ->bcc('bcc@example.com')
    ->subject('Test Email')
    ->html('<h1>Hello World</h1>')
    ->text('Hello World')
    ->send();
```

### Using Built-in Email Templates

The package includes beautiful, responsive email templates that you can use with your mail classes:

#### Welcome Email
```php
use Illuminate\Support\Facades\Mail;
use Examples\MailClasses\WelcomeMail;

Mail::mailer('phpmailer')
    ->to('user@example.com')
    ->send(new WelcomeMail('John Doe', 'https://example.com/verify', 'https://example.com/login'));
```

#### Password Reset Email
```php
use Examples\MailClasses\PasswordResetMail;

Mail::mailer('phpmailer')
    ->to('user@example.com')
    ->send(new PasswordResetMail('John Doe', 'https://example.com/reset', '60 minutes'));
```

#### Order Confirmation Email
```php
use Examples\MailClasses\OrderConfirmationMail;

$mail = new OrderConfirmationMail('John Doe', 'ORD-12345', '$99.99', [
    ['name' => 'Product 1', 'quantity' => 2, 'price' => '$49.99'],
    ['name' => 'Product 2', 'quantity' => 1, 'price' => '$29.99'],
]);

$mail->setShippingAddress('123 Main St, City, State 12345')
     ->setTrackingUrl('https://example.com/track/ORD-12345')
     ->setOrderUrl('https://example.com/orders/ORD-12345');

Mail::mailer('phpmailer')->to('user@example.com')->send($mail);
```

#### Contact Form Email
```php
use Examples\MailClasses\ContactFormMail;

$mail = new ContactFormMail('Admin', 'John Doe', 'john@example.com', 'Hello, I have a question...');
$mail->setPhone('+1234567890')
     ->setSubject('General Inquiry')
     ->addData('company', 'Acme Corp')
     ->setReplyUrl('mailto:john@example.com')
     ->setAdminUrl('https://admin.example.com/contacts/123');

Mail::mailer('phpmailer')->to('admin@example.com')->send($mail);
```

### Creating Custom Mail Classes

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to ' . config('app.name'))
                    ->with([
                        'name' => $this->name,
                    ]);
    }
}
```

## 🌍 Multi-Language Support

The package supports 13 languages out of the box:

- 🇺🇸 **English** (`en`) - Default
- 🇪🇸 **Spanish** (`es`) - Español
- 🇫🇷 **French** (`fr`) - Français
- 🇩🇪 **German** (`de`) - Deutsch
- 🇮🇹 **Italian** (`it`) - Italiano
- 🇵🇹 **Portuguese** (`pt`) - Português
- 🇷🇺 **Russian** (`ru`) - Русский
- 🇯🇵 **Japanese** (`ja`) - 日本語
- 🇨🇳 **Chinese** (`zh`) - 中文
- 🇰🇷 **Korean** (`ko`) - 한국어
- 🇸🇦 **Arabic** (`ar`) - العربية
- 🇮🇳 **Hindi** (`hi`) - हिन्दी
- 🇹🇷 **Turkish** (`tr`) - Türkçe

### Setting Language

```php
// Set language for current request
App::setLocale('es');

// Or in .env file
APP_LOCALE=es
```

## 📧 Email Templates

The package includes a comprehensive set of beautiful, responsive email templates:

### Available Templates

1. **Layout Template** (`layouts/app.blade.php`) - Main layout with header, content area, and footer
2. **Welcome Email** (`welcome.blade.php`) - For new user registrations
3. **Password Reset** (`password-reset.blade.php`) - For password reset requests
4. **Notification** (`notification.blade.php`) - For general notifications
5. **Order Confirmation** (`order-confirmation.blade.php`) - For e-commerce order confirmations
6. **Contact Form** (`contact-form.blade.php`) - For contact form submissions

### Template Features

- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Modern Styling** - Beautiful gradients and clean typography
- **Email Client Compatibility** - Tested across major email clients
- **Fully Customizable** - Publish and override templates as needed
- **Accessible** - Proper contrast ratios and semantic HTML

### Customization

Templates are published to `resources/views/vendor/phpmailer/emails/` and can be fully customized:

```bash
# Publish templates
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates

# Edit templates at: resources/views/vendor/phpmailer/emails/
```

## 🧪 Testing

### Run Tests

```bash
composer test
```

### Test Email Sending

```bash
# Test with default settings
php artisan phpmailer:test user@example.com

# Test with custom subject and message
php artisan phpmailer:test user@example.com --subject="Custom Subject" --message="Custom message"
```

## 📚 Documentation

- **[Email Templates Guide](EMAIL_TEMPLATES.md)** - Detailed template documentation
- **[Translation Guide](TRANSLATIONS.md)** - Multi-language support documentation
- **[Installation Guide](INSTALLATION.md)** - Step-by-step installation instructions

## 🤝 Contributing

We welcome contributions! Please see our contributing guidelines:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Setup

```bash
# Clone the repository
git clone https://github.com/mertcanaydin97/laravel-phpmailer-driver.git

# Install dependencies
composer install

# Run tests
composer test
```

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## 🆘 Support

### Getting Help

- 📖 **Documentation** - Check the documentation files in this repository
- 🐛 **Issues** - Report bugs and request features on [GitHub Issues](https://github.com/mertcanaydin97/laravel-phpmailer-driver/issues)
- 💬 **Discussions** - Join discussions on [GitHub Discussions](https://github.com/mertcanaydin97/laravel-phpmailer-driver/discussions)

### Common Issues

- **SMTP Connection Failed** - Check your mail server settings and credentials
- **Templates Not Found** - Ensure you've published the templates using the artisan command
- **Translations Not Working** - Verify the language files are published and the locale is set correctly

## 🙏 Acknowledgments

- [PHPMailer](https://github.com/PHPMailer/PHPMailer) - The underlying email library
- [Laravel](https://laravel.com/) - The amazing PHP framework
- All contributors and users of this package

## 📊 Statistics

- **Downloads**: [![Total Downloads](https://img.shields.io/packagist/dt/mertcanaydin97/laravel-phpmailer-driver.svg)](https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver)
- **Stars**: [![GitHub stars](https://img.shields.io/github/stars/mertcanaydin97/laravel-phpmailer-driver.svg)](https://github.com/mertcanaydin97/laravel-phpmailer-driver)
- **Forks**: [![GitHub forks](https://img.shields.io/github/forks/mertcanaydin97/laravel-phpmailer-driver.svg)](https://github.com/mertcanaydin97/laravel-phpmailer-driver)

---

**Made with ❤️ by [Mertcan Aydın](https://github.com/mertcanaydin97)**

If this package helps you, please consider giving it a ⭐️ on GitHub! 
