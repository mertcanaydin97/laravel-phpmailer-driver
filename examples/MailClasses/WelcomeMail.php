<?php

namespace Examples\MailClasses;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $verificationUrl;
    public $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($name = null, $verificationUrl = null, $loginUrl = null)
    {
        $this->name = $name;
        $this->verificationUrl = $verificationUrl;
        $this->loginUrl = $loginUrl;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to ' . config('app.name'))
                    ->view('emails.welcome')
                    ->with([
                        'name' => $this->name,
                        'verificationUrl' => $this->verificationUrl,
                        'loginUrl' => $this->loginUrl,
                    ]);
    }
} 