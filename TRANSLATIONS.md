# Translation Support Guide

This guide explains how to use and customize the translation system included with the Laravel PHPMailer Driver package.

## 🌍 Available Languages

The package includes translations for the following languages:

- **English** (`en`) - Default language
- **Spanish** (`es`) - Español
- **French** (`fr`) - Français
- **German** (`de`) - Deutsch
- **Italian** (`it`) - Italiano
- **Portuguese** (`pt`) - Português
- **Russian** (`ru`) - Русский
- **Japanese** (`ja`) - 日本語
- **Chinese** (`zh`) - 中文
- **Korean** (`ko`) - 한국어
- **Arabic** (`ar`) - العربية
- **Hindi** (`hi`) - हिन्दी
- **Turkish** (`tr`) - Türkçe

## 📁 Translation Files Structure

```
resources/lang/
├── en/
│   └── phpmailer.php          # English translations
├── es/
│   └── phpmailer.php          # Spanish translations
├── fr/
│   └── phpmailer.php          # French translations
├── de/
│   └── phpmailer.php          # German translations
├── it/
│   └── phpmailer.php          # Italian translations
├── pt/
│   └── phpmailer.php          # Portuguese translations
├── ru/
│   └── phpmailer.php          # Russian translations
├── ja/
│   └── phpmailer.php          # Japanese translations
├── zh/
│   └── phpmailer.php          # Chinese translations
├── ko/
│   └── phpmailer.php          # Korean translations
├── ar/
│   └── phpmailer.php          # Arabic translations
├── hi/
│   └── phpmailer.php          # Hindi translations
└── tr/
    └── phpmailer.php          # Turkish translations
```

## 🚀 Publishing Translations

### Step 1: Publish Language Files

```bash
<<<<<<< HEAD
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-lang
=======
php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-lang
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)
```

### Step 2: Translation Files Location

After publishing, translation files will be available at:
```
resources/lang/vendor/phpmailer/
├── en/
│   └── phpmailer.php
├── es/
│   └── phpmailer.php
├── fr/
│   └── phpmailer.php
├── de/
│   └── phpmailer.php
├── it/
│   └── phpmailer.php
├── pt/
│   └── phpmailer.php
├── ru/
│   └── phpmailer.php
├── ja/
│   └── phpmailer.php
├── zh/
│   └── phpmailer.php
├── ko/
│   └── phpmailer.php
├── ar/
│   └── phpmailer.php
├── hi/
│   └── phpmailer.php
└── tr/
    └── phpmailer.php
```

## 🎯 Translation Categories

### 1. **Common Elements** (`common`)
Used across all email templates:
- Welcome, Hello, Best regards
- Copyright, Email sent to
- Unsubscribe, View in browser

### 2. **Welcome Email** (`welcome`)
Welcome email specific translations:
- Title, Thank you message
- Get started steps
- Verification and access buttons

### 3. **Password Reset** (`password_reset`)
Password reset email translations:
- Title, Security notices
- Reset button, Fallback text
- Expiration warnings

### 4. **Order Confirmation** (`order_confirmation`)
E-commerce order emails:
- Order information labels
- Status, Shipping details
- Track and view buttons

### 5. **Contact Form** (`contact_form`)
Contact form submission emails:
- Contact information labels
- Message details
- Reply and admin buttons

### 6. **Notifications** (`notification`)
General notification emails:
- Title, Details sections
- Action buttons
- Additional information

### 7. **Layout Elements** (`layout`)
Email layout components:
- App description
- Social media links

### 8. **Console Commands** (`console`)
Artisan command messages:
- Test command descriptions
- Success/error messages

### 9. **Error Messages** (`errors`)
Package error messages:
- Configuration errors
- SMTP connection issues
- Validation failures

### 10. **Success Messages** (`success`)
Package success messages:
- Email sent confirmations
- Configuration validations

### 11. **Validation Messages** (`validation`)
Form validation messages:
- Required field messages
- Email validation errors

## 🔧 Using Translations

### In Email Templates

```php
// Basic translation
{{ __('phpmailer.common.hello') }}

// Translation with parameters
{{ __('phpmailer.welcome.title', ['app_name' => config('app.name')]) }}

// Nested translations
{{ __('phpmailer.welcome.steps.complete_profile') }}
```

### In PHP Code

```php
// In mail classes
use Illuminate\Support\Facades\Lang;

$title = Lang::get('phpmailer.welcome.title', ['app_name' => config('app.name')]);

// In controllers
$message = __('phpmailer.success.email_sent');

// With parameters
$error = __('phpmailer.errors.email_send_failed', ['error' => $exception->getMessage()]);
```

### In Console Commands

```php
// In Artisan commands
$this->info(__('phpmailer.console.test_command.sending', ['email' => $email]));
$this->error(__('phpmailer.console.test_command.error', ['error' => $error]));
```

## 🌐 Setting Application Language

### Method 1: Environment Variable

Add to your `.env` file:
```env
APP_LOCALE=es
```

### Method 2: Runtime Configuration

```php
// Set language for current request
App::setLocale('es');

// Set language for specific user
$user->locale = 'es';
$user->save();
```

### Method 3: Middleware

Create a middleware to set language based on user preference:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            app()->setLocale(auth()->user()->locale ?? 'en');
        }
        
        return $next($request);
    }
}
```

## ✏️ Customizing Translations

### Adding New Languages

1. **Create new language file**:
```bash
mkdir -p resources/lang/vendor/phpmailer/de
touch resources/lang/vendor/phpmailer/de/phpmailer.php
```

2. **Copy English file and translate**:
```php
<?php

return [
    'common' => [
        'welcome' => 'Willkommen',
        'hello' => 'Hallo',
        'best_regards' => 'Mit freundlichen Grüßen',
        // ... translate all keys
    ],
    // ... translate all sections
];
```

### Modifying Existing Translations

Edit the published files in `resources/lang/vendor/phpmailer/`:

```php
// resources/lang/vendor/phpmailer/en/phpmailer.php
return [
    'common' => [
        'welcome' => 'Welcome to Our Platform', // Customized
        'hello' => 'Hi there', // Customized
        // ...
    ],
];
```

### Adding Custom Translation Keys

```php
// Add to your language file
'custom' => [
    'special_message' => 'This is a custom message',
    'company_info' => 'Company Information',
],

// Use in templates
{{ __('phpmailer.custom.special_message') }}
```

## 📋 Translation Parameters

### Common Parameters

- `:app_name` - Application name from config
- `:email` - Email address
- `:expires_in` - Expiration time
- `:error` - Error message

### Using Parameters

```php
// In translation file
'welcome' => [
    'title' => 'Welcome to :app_name!',
    'thank_you' => 'Thank you for joining :app_name!',
],

// In template
{{ __('phpmailer.welcome.title', ['app_name' => config('app.name')]) }}
```

## 🔄 Updating Translations

### When Package Updates Include New Translations

1. **Backup your customizations**:
```bash
cp -r resources/lang/vendor/phpmailer/ my-custom-translations/
```

2. **Republish translations**:
```bash
<<<<<<< HEAD
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-lang --force
=======
php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-lang --force
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)
```

3. **Reapply your customizations** from the backup

### Version Control

- **Track your customizations** in version control
- **Document changes** for team members
- **Create translation variants** for different regions

## 🧪 Testing Translations

### Testing Different Languages

```php
// Test Spanish translations
App::setLocale('es');
$message = __('phpmailer.welcome.title', ['app_name' => 'Mi App']);

// Test French translations
App::setLocale('fr');
$message = __('phpmailer.welcome.title', ['app_name' => 'Mon App']);
```

### Console Command Testing

```bash
# Test with different locales
APP_LOCALE=es php artisan phpmailer:test user@example.com
APP_LOCALE=fr php artisan phpmailer:test user@example.com
```

## 🌍 Best Practices

### Translation Guidelines

1. **Keep it simple** - Use clear, concise language
2. **Be consistent** - Use consistent terminology
3. **Consider context** - Ensure translations fit the context
4. **Test thoroughly** - Test with native speakers when possible

### Technical Considerations

1. **Use parameters** - Avoid hardcoding values
2. **Escape properly** - Use proper HTML escaping
3. **Maintain structure** - Keep translation keys organized
4. **Document changes** - Document any custom translations

### Localization Tips

1. **Date formats** - Use locale-specific date formats
2. **Number formats** - Consider decimal and thousand separators
3. **Currency** - Use appropriate currency symbols
4. **Direction** - Consider RTL languages if needed

## 🆘 Troubleshooting

### Common Issues

1. **Translations not found**
   - Ensure language files are published correctly
   - Check the translation key path
   - Verify the language is set correctly

2. **Parameters not working**
   - Check parameter names match exactly
   - Ensure parameters are passed correctly
   - Verify parameter syntax

3. **Language not changing**
   - Check APP_LOCALE in .env
   - Verify middleware is working
   - Clear application cache

### Debugging

```php
// Check current locale
dd(app()->getLocale());

// Check if translation exists
dd(__('phpmailer.welcome.title'));

// Check all available translations
dd(__('phpmailer'));
```

## 📚 Additional Resources

- [Laravel Localization Documentation](https://laravel.com/docs/localization)
- [Laravel Translation Best Practices](https://laravel.com/docs/localization#pluralization)
- [PHP gettext Documentation](https://www.php.net/manual/en/book.gettext.php)
- [Unicode CLDR](http://cldr.unicode.org/) - Common Locale Data Repository

## 🤝 Contributing Translations

To contribute new language translations:

1. **Fork the repository**
2. **Create new language file** following the existing structure
3. **Translate all keys** in the phpmailer.php file
4. **Test thoroughly** with the package
5. **Submit a pull request** with your translations

### Translation Checklist

- [ ] All common elements translated
- [ ] All email templates translated
- [ ] Console commands translated
- [ ] Error messages translated
- [ ] Success messages translated
- [ ] Validation messages translated
- [ ] Parameters properly handled
- [ ] Context appropriate for target language
- [ ] Tested with package functionality

---

**Note**: These translations are designed to work with the Laravel PHPMailer Driver package. Make sure you have the package properly installed and configured before using the translations. 
