<?php

namespace Examples\MailClasses;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $resetUrl;
    public $expiresIn;

    /**
     * Create a new message instance.
     */
    public function __construct($name = null, $resetUrl = null, $expiresIn = '60 minutes')
    {
        $this->name = $name;
        $this->resetUrl = $resetUrl;
        $this->expiresIn = $expiresIn;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Reset Your Password - ' . config('app.name'))
                    ->view('emails.password-reset')
                    ->with([
                        'name' => $this->name,
                        'resetUrl' => $this->resetUrl,
                        'expiresIn' => $this->expiresIn,
                    ]);
    }
} 