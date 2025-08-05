<?php

<<<<<<< HEAD
namespace Mertcanaydin97\LaravelPhpMailerDriver\Console;
=======
namespace OG\LaravelPhpMailerDriver\Console;
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestPhpMailerCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'phpmailer:test {email} {--subject=} {--message=}';

    /**
     * The console command description.
     */
    protected $description = 'Test the PHPMailer driver by sending a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $subject = $this->option('subject') ?: __('phpmailer.console.test_command.default_subject');
        $message = $this->option('message') ?: __('phpmailer.console.test_command.default_message');

        $this->info(__('phpmailer.console.test_command.sending', ['email' => $email]));

        try {
            Mail::mailer('phpmailer')
                ->to($email)
                ->subject($subject)
                ->html("<h1>Test Email</h1><p>{$message}</p>")
                ->text($message)
                ->send();

            $this->info(__('phpmailer.console.test_command.success'));

        } catch (\Exception $e) {
            $this->error(__('phpmailer.console.test_command.error', ['error' => $e->getMessage()]));
            
            return 1;
        }

        return 0;
    }
} 
