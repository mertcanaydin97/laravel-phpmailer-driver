<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class TestPhpMailerCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'phpmailer:test {--to= : Email address to send test to}';

    /**
     * The console command description.
     */
    protected $description = 'Test the PHPMailer driver configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Testing PHPMailer Driver Configuration...');
        $this->newLine();

        // Check if PHPMailer class exists
        if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            $this->error('❌ PHPMailer class not found! Make sure phpmailer/phpmailer is installed.');
            return 1;
        }
        $this->info('✅ PHPMailer class found');

        // Check mail configuration
        $mailConfig = config('mail');
        if (!$mailConfig) {
            $this->error('❌ Mail configuration not found!');
            return 1;
        }
        $this->info('✅ Mail configuration found');

        // Check if phpmailer mailer exists
        $mailers = isset($mailConfig['mailers']) ? $mailConfig['mailers'] : array();
        if (!isset($mailers['phpmailer'])) {
            $this->warn('⚠️  PHPMailer mailer not found in config/mail.php');
            $this->info('   You need to add this to your config/mail.php:');
            $this->newLine();
            $this->line('   "mailers" => [');
            $this->line('       // ... other mailers ...');
            $this->line('       "phpmailer" => [');
            $this->line('           "transport" => "phpmailer",');
            $this->line('           "host" => env("MAIL_HOST", "localhost"),');
            $this->line('           "port" => env("MAIL_PORT", 587),');
            $this->line('           "username" => env("MAIL_USERNAME"),');
            $this->line('           "password" => env("MAIL_PASSWORD"),');
            $this->line('           "encryption" => env("MAIL_ENCRYPTION", "tls"),');
            $this->line('           "timeout" => env("MAIL_TIMEOUT", 30),');
            $this->line('       ],');
            $this->line('   ],');
            $this->newLine();
            return 1;
        }
        $this->info('✅ PHPMailer mailer found in config');

        // Check environment variables
        $this->info('📧 Checking environment variables:');
        $envVars = [
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        ];

        foreach ($envVars as $key => $value) {
            if ($value) {
                $this->line("   ✅ {$key}: " . ($key === 'MAIL_PASSWORD' ? '***' : $value));
            } else {
                $this->line("   ⚠️  {$key}: Not set");
            }
        }

        // Try to get the mailer
        try {
            $mailer = Mail::mailer('phpmailer');
            $this->info('✅ PHPMailer mailer created successfully');
        } catch (\Exception $e) {
            $this->error('❌ Failed to create PHPMailer mailer: ' . $e->getMessage());
            return 1;
        }

        // Check if we should send a test email
        $toEmail = $this->option('to');
        if ($toEmail) {
            $this->newLine();
            $this->info("📤 Sending test email to: {$toEmail}");
            
            try {
                // Use the correct way to send a simple email
                Mail::mailer('phpmailer')->raw('This is a test email from your PHPMailer driver!', function ($message) use ($toEmail) {
                    $message->to($toEmail)
                            ->subject('PHPMailer Test Email');
                });
                
                $this->info('✅ Test email sent successfully!');
            } catch (\Exception $e) {
                $this->error('❌ Failed to send test email: ' . $e->getMessage());
                return 1;
            }
        } else {
            $this->newLine();
            $this->info('💡 To send a test email, use: php artisan phpmailer:test --to=your@email.com');
        }

        $this->newLine();
        $this->info('🎉 PHPMailer driver is properly configured!');
        
        return 0;
    }
} 
