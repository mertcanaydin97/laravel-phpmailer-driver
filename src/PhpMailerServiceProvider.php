<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
use Mertcanaydin97\LaravelPhpMailerDriver\Console\TestPhpMailerCommand;

class PhpMailerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Load package translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'phpmailer');
        
        // Register the custom mail driver for Laravel 10
        $this->app->afterResolving('mail.manager', function ($manager) {
            $manager->extend('phpmailer', function (array $config) {
                return new PhpMailerTransport($config);
            });
        });
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

        // Transport registration moved to register() method for better compatibility

        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestPhpMailerCommand::class,
            ]);
        }
    }
} 
