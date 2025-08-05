<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver\Tests;

use Orchestra\Testbench\TestCase;
use Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider;
use Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
use Mertcanaydin97\LaravelPhpMailerDriver\Console\TestPhpMailerCommand;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class PhpMailerServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PhpMailerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Configure mail settings for testing
        $app['config']->set('mail.default', 'phpmailer');
        $app['config']->set('mail.mailers.phpmailer', [
            'transport' => 'phpmailer',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ]);
    }

    /** @test */
    public function it_registers_phpmailer_transport()
    {
        // Test that the phpmailer transport is registered
        $this->assertTrue(Mail::getDefaultDriver() === 'phpmailer');
    }

    /** @test */
    public function it_can_create_phpmailer_transport_instance()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_registers_console_commands()
    {
        // Test that the console command is registered
        $commands = Artisan::all();
        
        $this->assertArrayHasKey('phpmailer:test', $commands);
    }

    /** @test */
    public function it_can_load_translations()
    {
        // Test that translations are loaded
        $this->assertTrue(app('translator')->has('phpmailer::messages.welcome'));
    }

    /** @test */
    public function it_can_publish_configuration()
    {
        // Test that configuration can be published
        $this->artisan('vendor:publish', ['--tag' => 'phpmailer-config']);
        
        $this->assertFileExists(config_path('phpmailer.php'));
    }

    /** @test */
    public function it_can_publish_email_templates()
    {
        // Test that email templates can be published
        $this->artisan('vendor:publish', ['--tag' => 'phpmailer-templates']);
        
        $this->assertDirectoryExists(resource_path('views/vendor/phpmailer/emails'));
    }

    /** @test */
    public function it_can_publish_language_files()
    {
        // Test that language files can be published
        $this->artisan('vendor:publish', ['--tag' => 'phpmailer-lang']);
        
        $this->assertDirectoryExists(resource_path('lang/vendor/phpmailer'));
    }

    /** @test */
    public function it_has_correct_service_provider_structure()
    {
        $provider = new PhpMailerServiceProvider($this->app);
        
        $this->assertInstanceOf(PhpMailerServiceProvider::class, $provider);
        $this->assertTrue(method_exists($provider, 'register'));
        $this->assertTrue(method_exists($provider, 'boot'));
    }

    /** @test */
    public function it_can_handle_mail_configuration()
    {
        $config = config('mail.mailers.phpmailer');
        
        $this->assertIsArray($config);
        $this->assertEquals('phpmailer', $config['transport']);
        $this->assertEquals('smtp.gmail.com', $config['host']);
        $this->assertEquals(587, $config['port']);
        $this->assertEquals('tls', $config['encryption']);
    }

    /** @test */
    public function it_can_use_phpmailer_mailer()
    {
        // Test that we can use the phpmailer mailer
        $mailer = Mail::mailer('phpmailer');
        
        $this->assertNotNull($mailer);
    }

    /** @test */
    public function it_has_required_dependencies()
    {
        // Test that required dependencies are available
        $this->assertTrue(class_exists('PHPMailer\PHPMailer\PHPMailer'));
        $this->assertTrue(class_exists('Illuminate\Support\Facades\Mail'));
        $this->assertTrue(class_exists('Illuminate\Support\ServiceProvider'));
    }

    /** @test */
    public function it_can_handle_multiple_mail_configurations()
    {
        // Test multiple mail configurations
        $configs = [
            [
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'encryption' => 'tls',
            ],
            [
                'host' => 'smtp.mailgun.org',
                'port' => 587,
                'encryption' => 'tls',
            ],
            [
                'host' => 'smtp.sendgrid.net',
                'port' => 587,
                'encryption' => 'tls',
            ],
        ];

        foreach ($configs as $config) {
            $transport = new PhpMailerTransport($config);
            $this->assertInstanceOf(PhpMailerTransport::class, $transport);
        }
    }
} 