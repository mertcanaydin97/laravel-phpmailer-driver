<?php

return [
    'console' => [
        'test_command' => [
            'sending' => 'Sending test email to :email...',
            'success' => 'Test email sent successfully!',
            'error' => 'Failed to send test email: :error',
            'default_subject' => 'PHPMailer Test Email',
            'default_message' => 'This is a test email sent using the Laravel PHPMailer Driver.',
        ],
    ],
    'emails' => [
        'welcome' => [
            'subject' => 'Welcome to our platform!',
            'greeting' => 'Welcome :name!',
            'message' => 'Thank you for joining our platform. We\'re excited to have you on board!',
            'cta' => 'Get Started',
        ],
        'password_reset' => [
            'subject' => 'Password Reset Request',
            'greeting' => 'Hello :name,',
            'message' => 'You are receiving this email because we received a password reset request for your account.',
            'cta' => 'Reset Password',
            'expiry' => 'This password reset link will expire in :count minutes.',
            'no_action' => 'If you did not request a password reset, no further action is required.',
        ],
        'notification' => [
            'subject' => 'New Notification',
            'greeting' => 'Hello :name,',
            'message' => 'You have a new notification.',
            'cta' => 'View Notification',
        ],
        'order_confirmation' => [
            'subject' => 'Order Confirmation - Order #:order_number',
            'greeting' => 'Thank you for your order!',
            'message' => 'Your order has been confirmed and is being processed.',
            'order_details' => 'Order Details',
            'order_number' => 'Order Number',
            'order_date' => 'Order Date',
            'total_amount' => 'Total Amount',
            'cta' => 'View Order',
        ],
        'contact_form' => [
            'subject' => 'New Contact Form Submission',
            'greeting' => 'New contact form submission received',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'message' => 'Message',
            'submitted_at' => 'Submitted At',
        ],
    ],
    'errors' => [
        'configuration' => 'PHPMailer configuration error',
        'smtp_connection' => 'SMTP connection failed',
        'authentication' => 'SMTP authentication failed',
        'sending' => 'Failed to send email',
        'invalid_recipient' => 'Invalid recipient email address',
    ],
    'success' => [
        'email_sent' => 'Email sent successfully',
        'configuration_valid' => 'PHPMailer configuration is valid',
    ],
]; 