<?php

<<<<<<< HEAD
namespace Mertcanaydin97\LaravelPhpMailerDriver;
=======
namespace OG\LaravelPhpMailerDriver;
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
<<<<<<< HEAD
use Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
use Mertcanaydin97\LaravelPhpMailerDriver\Console\TestPhpMailerCommand;
=======
use OG\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
use OG\LaravelPhpMailerDriver\Console\TestPhpMailerCommand;
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)

class PhpMailerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/phpmailer.php', 'phpmailer'
        );
        
        // Load package translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'phpmailer');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/phpmailer.php' => config_path('phpmailer.php'),
            ], 'phpmailer-config');
            
            // Publish email templates
            $this->publishes([
                __DIR__.'/../resources/views/emails' => resource_path('views/vendor/phpmailer/emails'),
            ], 'phpmailer-templates');
            
            // Publish language files
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/phpmailer'),
            ], 'phpmailer-lang');
        }

        // Register the custom mail driver
        Mail::extend('phpmailer', function (array $config) {
            return new PhpMailerTransport($config);
        });

        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestPhpMailerCommand::class,
            ]);
        }
    }
} 
