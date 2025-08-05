<?php

namespace Examples\MailClasses;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName;
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $additionalData;
    public $submittedAt;
    public $replyUrl;
    public $adminUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($recipientName = null, $name = null, $email = null, $message = null)
    {
        $this->recipientName = $recipientName;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->submittedAt = date('F j, Y \a\t g:i A');
        $this->additionalData = [];
    }

    /**
     * Set phone number.
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Set subject.
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Add additional data.
     */
    public function addData($key, $value)
    {
        $this->additionalData[$key] = $value;
        return $this;
    }

    /**
     * Set reply URL.
     */
    public function setReplyUrl($url)
    {
        $this->replyUrl = $url;
        return $this;
    }

    /**
     * Set admin URL.
     */
    public function setAdminUrl($url)
    {
        $this->adminUrl = $url;
        return $this;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Contact Form Submission - ' . config('app.name'))
                    ->view('emails.contact-form')
                    ->with([
                        'recipientName' => $this->recipientName,
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'subject' => $this->subject,
                        'message' => $this->message,
                        'additionalData' => $this->additionalData,
                        'submittedAt' => $this->submittedAt,
                        'replyUrl' => $this->replyUrl,
                        'adminUrl' => $this->adminUrl,
                    ]);
    }
} 