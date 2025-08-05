# Email Templates Guide

This guide explains how to use and customize the beautiful email templates included with the Laravel PHPMailer Driver package.

## 📧 Available Templates

The package includes 6 professionally designed email templates:

### 1. **Main Layout** (`layouts/app.blade.php`)
- Base template with header, content area, and footer
- Responsive design with modern styling
- Configurable branding and social links

### 2. **Welcome Email** (`welcome.blade.php`)
- For new user registrations
- Includes verification and login links
- Professional onboarding experience

### 3. **Password Reset** (`password-reset.blade.php`)
- Secure password reset functionality
- Expiration time display
- Fallback link for button issues

### 4. **Order Confirmation** (`order-confirmation.blade.php`)
- E-commerce order confirmations
- Product details and pricing
- Shipping and tracking information

### 5. **Contact Form** (`contact-form.blade.php`)
- Contact form submissions
- Detailed contact information
- Admin and reply links

### 6. **General Notifications** (`notification.blade.php`)
- Flexible notification system
- Action buttons and additional info
- Customizable content areas

## 🚀 Publishing Templates

### Step 1: Publish Templates
```bash
<<<<<<< HEAD
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates
=======
php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)
```

### Step 2: Templates Location
After publishing, templates will be available at:
```
resources/views/vendor/phpmailer/emails/
├── layouts/
│   └── app.blade.php
├── welcome.blade.php
├── password-reset.blade.php
├── notification.blade.php
├── order-confirmation.blade.php
└── contact-form.blade.php
```

## 🎨 Customizing Templates

### Basic Customization

1. **Edit the published templates** in `resources/views/vendor/phpmailer/emails/`
2. **Modify colors, fonts, and layout** as needed
3. **Add your branding** and company information

### Layout Customization

Edit `layouts/app.blade.php` to customize:

```php
// Header branding
<h1>{{ config('app.name') }}</h1>
<p>{{ config('app.description', 'Your Application Description') }}</p>

// Footer social links
@if(config('app.social.facebook'))
<a href="{{ config('app.social.facebook') }}">Facebook</a>
@endif
```

### Color Scheme

Modify the CSS variables in the layout:

```css
/* Primary colors */
.email-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

### Adding Custom Templates

1. **Create new template files** in `resources/views/vendor/phpmailer/emails/`
2. **Extend the main layout**:
```php
@extends('vendor.phpmailer.emails.layouts.app')

@section('content')
    <!-- Your custom content here -->
@endsection
```

## 📱 Template Features

### Responsive Design
- **Mobile-first approach** with responsive breakpoints
- **Flexible layouts** that adapt to different screen sizes
- **Touch-friendly buttons** and interactive elements

### Email Client Compatibility
- **Inline CSS** for maximum compatibility
- **Table-based layouts** for Outlook support
- **Web-safe fonts** for consistent rendering
- **Fallback styles** for older email clients

### Accessibility
- **High contrast ratios** for readability
- **Semantic HTML** structure
- **Alt text support** for images
- **Keyboard navigation** friendly

## 🔧 Configuration

### App Configuration

Add these to your `config/app.php`:

```php
'name' => env('APP_NAME', 'Your App Name'),
'description' => env('APP_DESCRIPTION', 'Your App Description'),

'social' => [
    'facebook' => env('SOCIAL_FACEBOOK_URL'),
    'twitter' => env('SOCIAL_TWITTER_URL'),
    'linkedin' => env('SOCIAL_LINKEDIN_URL'),
],
```

### Environment Variables

Add to your `.env` file:

```env
APP_NAME="Your App Name"
APP_DESCRIPTION="Your App Description"
SOCIAL_FACEBOOK_URL="https://facebook.com/yourapp"
SOCIAL_TWITTER_URL="https://twitter.com/yourapp"
SOCIAL_LINKEDIN_URL="https://linkedin.com/company/yourapp"
```

## 📋 Usage Examples

### Welcome Email
```php
use Examples\MailClasses\WelcomeMail;

Mail::mailer('phpmailer')
    ->to('user@example.com')
    ->send(new WelcomeMail(
        'John Doe',
        'https://example.com/verify',
        'https://example.com/login'
    ));
```

### Order Confirmation
```php
use Examples\MailClasses\OrderConfirmationMail;

$mail = new OrderConfirmationMail(
    'John Doe',
    'ORD-12345',
    '$99.99',
    [
        ['name' => 'Product 1', 'quantity' => 2, 'price' => '$49.99'],
        ['name' => 'Product 2', 'quantity' => 1, 'price' => '$29.99'],
    ]
);

$mail->setShippingAddress('123 Main St, City, State 12345')
     ->setTrackingUrl('https://example.com/track/ORD-12345')
     ->setOrderUrl('https://example.com/orders/ORD-12345');

Mail::mailer('phpmailer')->to('user@example.com')->send($mail);
```

### Contact Form
```php
use Examples\MailClasses\ContactFormMail;

$mail = new ContactFormMail('Admin', 'John Doe', 'john@example.com', 'Hello...');
$mail->setPhone('+1234567890')
     ->setSubject('General Inquiry')
     ->addData('company', 'Acme Corp')
     ->setReplyUrl('mailto:john@example.com')
     ->setAdminUrl('https://admin.example.com/contacts/123');

Mail::mailer('phpmailer')->to('admin@example.com')->send($mail);
```

## 🎯 Best Practices

### Template Design
1. **Keep it simple** - Avoid complex layouts
2. **Use web-safe fonts** - Arial, Helvetica, Times New Roman
3. **Limit images** - Many email clients block images by default
4. **Test thoroughly** - Use email testing services

### Content Guidelines
1. **Clear call-to-action** - Make buttons prominent
2. **Concise messaging** - Keep content brief and focused
3. **Personalization** - Use recipient names when possible
4. **Mobile optimization** - Ensure readability on small screens

### Technical Considerations
1. **Inline CSS only** - External stylesheets are often blocked
2. **Table-based layouts** - Better email client support
3. **Alt text for images** - Improves accessibility
4. **Fallback fonts** - Specify multiple font options

## 🧪 Testing Templates

### Email Testing Services
- **Litmus** - Comprehensive email testing
- **Email on Acid** - Cross-client testing
- **Mailtrap** - Safe email testing environment
- **PutsMail** - Free email testing tool

### Manual Testing
1. **Send test emails** to different email clients
2. **Check mobile rendering** on various devices
3. **Verify links and buttons** work correctly
4. **Test with images disabled**

## 🔄 Updating Templates

### When Package Updates Include New Templates

1. **Backup your customizations**:
```bash
cp -r resources/views/vendor/phpmailer/emails/ my-custom-templates/
```

2. **Republish templates**:
```bash
<<<<<<< HEAD
php artisan vendor:publish --provider="Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates --force
=======
php artisan vendor:publish --provider="OG\LaravelPhpMailerDriver\PhpMailerServiceProvider" --tag=phpmailer-templates --force
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)
```

3. **Reapply your customizations** from the backup

### Version Control
- **Track your customizations** in version control
- **Document changes** for team members
- **Create template variants** for different use cases

## 🆘 Troubleshooting

### Common Issues

1. **Templates not found**
   - Ensure templates are published correctly
   - Check the view path in your mail classes

2. **Styling not applied**
   - Verify inline CSS is used
   - Check email client compatibility

3. **Images not displaying**
   - Use absolute URLs for images
   - Provide alt text for accessibility

4. **Layout broken in Outlook**
   - Use table-based layouts
   - Avoid CSS Grid and Flexbox

### Getting Help

If you encounter issues:
1. Check the troubleshooting section in the main README
2. Review email client compatibility guides
3. Test with different email clients
4. Open an issue on GitHub with details

## 📚 Additional Resources

- [Email Client Support](https://www.campaignmonitor.com/css/)
- [Email Design Best Practices](https://www.litmus.com/blog/)
- [Responsive Email Design](https://www.emailonacid.com/blog/)
- [PHPMailer Documentation](https://github.com/PHPMailer/PHPMailer)

---

**Note**: These templates are designed to work with the Laravel PHPMailer Driver package. Make sure you have the package properly installed and configured before using the templates. 
