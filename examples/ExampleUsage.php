<?php

/**
 * Example usage of the Laravel PHPMailer Driver
 * 
 * This file demonstrates how to use the custom PHPMailer mail driver
 * in a Laravel application.
 */

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

// Example 1: Basic usage with default mailer
Mail::to('recipient@example.com')
    ->send(new WelcomeMail());

// Example 2: Using the PHPMailer driver explicitly
Mail::mailer('phpmailer')
    ->to('recipient@example.com')
    ->send(new WelcomeMail());

// Example 3: Sending with custom options
Mail::mailer('phpmailer')
    ->to('recipient@example.com')
    ->cc('cc@example.com')
    ->bcc('bcc@example.com')
    ->subject('Test Email')
    ->html('<h1>Hello World</h1><p>This is a test email sent using PHPMailer.</p>')
    ->text('Hello World - This is a test email sent using PHPMailer.')
    ->send();

// Example 4: Sending with attachments
Mail::mailer('phpmailer')
    ->to('recipient@example.com')
    ->subject('Email with Attachment')
    ->html('<h1>Email with Attachment</h1>')
    ->attach('/path/to/file.pdf', [
        'as' => 'document.pdf',
        'mime' => 'application/pdf',
    ])
    ->send();

// Example 5: Using a custom mail class
class CustomMail extends \Illuminate\Mail\Mailable
{
    use \Illuminate\Bus\Queueable, \Illuminate\Queue\SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.custom')
                    ->subject('Custom Email')
                    ->with([
                        'name' => $this->data['name'],
                        'message' => $this->data['message'],
                    ]);
    }
}

// Send the custom mail
$data = [
    'name' => 'John Doe',
    'message' => 'Welcome to our application!'
];

Mail::mailer('phpmailer')
    ->to('recipient@example.com')
    ->send(new CustomMail($data)); 