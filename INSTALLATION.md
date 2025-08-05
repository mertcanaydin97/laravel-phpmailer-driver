# Installation Guide

This guide will help you install and configure the Laravel PHPMailer Driver package.

## Prerequisites

- PHP 8.0 or higher
- Laravel 9.0, 10.0, or 11.0
- Composer

## Step 1: Install the Package

### Option A: Via Composer (Recommended)

```bash
composer require og/laravel-phpmailer-driver
```

### Option B: Manual Installation

1. Clone or download this repository
2. Add the package to your `composer.json`:

```json
{
    "require": {
        "og/laravel-phpmailer-driver": "dev-master"
    },
    "repositories": [
        {
            "type": "path",
            "url": "/path/to/your/package"
        }
    ]
}
```

3. Run `composer install`

## Step 2: Publish Configuration and Templates

Publish the configuration file and email templates to your Laravel application:

```bash
# Publish configuration only

php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider"

# Publish email templates (optional)
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates

php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider"

# Publish email templates (optional)
php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates

```

This will create:
- `config/phpmailer.php` - Configuration file
- `resources/views/vendor/phpmailer/emails/` - Email templates (if you publish templates)

## Step 3: Configure Environment Variables

Add the following variables to your `.env` file:

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

### Gmail Configuration Example

For Gmail, you'll need to:
1. Enable 2-factor authentication
2. Generate an App Password
3. Use the App Password instead of your regular password

```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-digit-app-password
MAIL_ENCRYPTION=tls
```

### Other SMTP Providers

#### Outlook/Hotmail
```env
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

#### Yahoo
```env
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

#### Custom SMTP Server
```env
MAIL_HOST=your-smtp-server.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## Step 4: Test the Installation

Use the provided Artisan command to test your configuration:

```bash
php artisan phpmailer:test your-email@example.com
```

Or with custom options:

```bash
php artisan phpmailer:test your-email@example.com --subject="Custom Subject" --message="Custom message"
```

## Step 5: Usage in Your Application

### Basic Usage

```php
use Illuminate\Support\Facades\Mail;

Mail::to('recipient@example.com')
    ->send(new \App\Mail\WelcomeMail());
```

### Using PHPMailer Driver Explicitly

```php
Mail::mailer('phpmailer')
    ->to('recipient@example.com')
    ->subject('Test Email')
    ->html('<h1>Hello World</h1>')
    ->send();
```

## Step 6: Using Email Templates

The package includes beautiful, responsive email templates that you can use:

### Publishing Templates
```bash
php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates
```

### Using Templates
```php
// Welcome email
use Examples\MailClasses\WelcomeMail;

Mail::mailer('phpmailer')
    ->to('user@example.com')
    ->send(new WelcomeMail('John Doe', 'https://example.com/verify'));

// Password reset email
use Examples\MailClasses\PasswordResetMail;

Mail::mailer('phpmailer')
    ->to('user@example.com')
    ->send(new PasswordResetMail('John Doe', 'https://example.com/reset'));
```

### Available Templates
- Welcome Email
- Password Reset
- Order Confirmation
- Contact Form
- General Notifications

All templates are responsive and compatible with major email clients.

## Troubleshooting

### Common Issues

1. **Authentication Failed**
   - Check your username and password
   - For Gmail, make sure you're using an App Password
   - Verify that 2-factor authentication is enabled (for Gmail)

2. **Connection Timeout**
   - Check your firewall settings
   - Verify the SMTP host and port
   - Try different encryption settings (tls/ssl)

3. **SSL Certificate Issues**
   - Add these to your `.env` file:
   ```env
   MAIL_VERIFY_PEER=false
   MAIL_VERIFY_PEER_NAME=false
   MAIL_ALLOW_SELF_SIGNED=true
   ```

### Debug Mode

To enable debug mode, modify the `PhpMailerTransport.php` file:

```php
// Change this line in configureMailer() method
$this->mailer->SMTPDebug = 2; // 0 = off, 1 = client messages, 2 = client and server messages
```

## Support

If you encounter any issues, please:
1. Check the troubleshooting section above
2. Review your SMTP server documentation
3. Open an issue on GitHub with detailed error messages 
