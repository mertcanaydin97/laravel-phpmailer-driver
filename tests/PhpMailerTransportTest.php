<?php

<<<<<<< HEAD
namespace Mertcanaydin97\LaravelPhpMailerDriver\Tests;

use Orchestra\Testbench\TestCase;
use Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider;
use Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
=======
namespace OG\LaravelPhpMailerDriver\Tests;

use Orchestra\Testbench\TestCase;
use OG\LaravelPhpMailerDriver\PhpMailerServiceProvider;
use OG\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)
use Illuminate\Support\Facades\Mail;
use Swift_Message;

class PhpMailerTransportTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PhpMailerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('mail.default', 'phpmailer');
        $app['config']->set('mail.mailers.phpmailer', [
            'transport' => 'phpmailer',
            'host' => 'smtp.test.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@test.com',
            'password' => 'password',
            'timeout' => 30,
        ]);
    }

    /** @test */
    public function it_can_register_phpmailer_transport()
    {
        $this->assertTrue(Mail::getDefaultDriver() === 'phpmailer');
    }

    /** @test */
    public function it_can_create_phpmailer_transport_instance()
    {
        $config = [
            'host' => 'smtp.test.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@test.com',
            'password' => 'password',
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_configure_smtp_settings()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'encryption' => 'ssl',
            'username' => 'test@gmail.com',
            'password' => 'password',
            'timeout' => 60,
        ];

        $transport = new PhpMailerTransport($config);
        
        // Test that the transport was created successfully
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_ssl_encryption()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'encryption' => 'ssl',
            'username' => 'test@gmail.com',
            'password' => 'password',
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_tls_encryption()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'password',
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_ssl_verification_settings()
    {
        $config = [
            'host' => 'smtp.test.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@test.com',
            'password' => 'password',
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }
} 
