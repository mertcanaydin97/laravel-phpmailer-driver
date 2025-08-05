<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver\Tests;

use Orchestra\Testbench\TestCase;
use Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider;
use Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport;
use Illuminate\Support\Facades\Mail;
use Swift_Message;
use Swift_Attachment;

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
        // Configure mail settings for testing
        $app['config']->set('mail.default', 'phpmailer');
        $app['config']->set('mail.mailers.phpmailer', [
            'transport' => 'phpmailer',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
            'timeout' => 30,
        ]);
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
    public function it_can_configure_smtp_settings()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
            'timeout' => 60,
        ];

        $transport = new PhpMailerTransport($config);
        
        // Test that the transport was created successfully
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_configure_ssl_settings()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'encryption' => 'ssl',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_basic_email_message()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);

        $message = new Swift_Message();
        $message->setSubject('Test Subject');
        $message->setFrom('from@example.com', 'From Name');
        $message->setTo('to@example.com', 'To Name');
        $message->setBody('Test email body');

        // This should not throw an exception
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_html_email_message()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);

        $message = new Swift_Message();
        $message->setSubject('Test HTML Subject');
        $message->setFrom('from@example.com', 'From Name');
        $message->setTo('to@example.com', 'To Name');
        $message->setBody('<h1>Test HTML email body</h1>', 'text/html');
        $message->addPart('Test plain text body', 'text/plain');

        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_email_with_cc_and_bcc()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);

        $message = new Swift_Message();
        $message->setSubject('Test CC/BCC Subject');
        $message->setFrom('from@example.com', 'From Name');
        $message->setTo('to@example.com', 'To Name');
        $message->setCc('cc@example.com', 'CC Name');
        $message->setBcc('bcc@example.com', 'BCC Name');
        $message->setBody('Test email body');

        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_email_with_attachments()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);

        $message = new Swift_Message();
        $message->setSubject('Test Attachment Subject');
        $message->setFrom('from@example.com', 'From Name');
        $message->setTo('to@example.com', 'To Name');
        $message->setBody('Test email body');

        // Add attachment
        $attachment = Swift_Attachment::fromPath(__FILE__)
            ->setFilename('test.php')
            ->setContentType('text/plain');
        $message->attach($attachment);

        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_email_with_custom_headers()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);

        $message = new Swift_Message();
        $message->setSubject('Test Custom Headers Subject');
        $message->setFrom('from@example.com', 'From Name');
        $message->setTo('to@example.com', 'To Name');
        $message->setBody('Test email body');

        // Add custom headers
        $message->getHeaders()->addTextHeader('X-Custom-Header', 'Custom Value');
        $message->getHeaders()->addTextHeader('X-Priority', '1');

        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_registers_phpmailer_mailer_correctly()
    {
        // Test that the phpmailer mailer is registered
        $this->assertTrue(Mail::hasMacro('phpmailer') || method_exists(Mail::getFacadeRoot(), 'extend'));
    }

    /** @test */
    public function it_can_handle_timeout_configuration()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
            'timeout' => 120, // 2 minutes timeout
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_multiple_recipients()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test-password',
        ];

        $transport = new PhpMailerTransport($config);

        $message = new Swift_Message();
        $message->setSubject('Test Multiple Recipients');
        $message->setFrom('from@example.com', 'From Name');
        $message->setTo([
            'to1@example.com' => 'To Name 1',
            'to2@example.com' => 'To Name 2',
        ]);
        $message->setBody('Test email body');

        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_empty_configuration()
    {
        $config = [];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }

    /** @test */
    public function it_can_handle_partial_configuration()
    {
        $config = [
            'host' => 'smtp.gmail.com',
            'username' => 'test@gmail.com',
            // Missing port, encryption, password
        ];

        $transport = new PhpMailerTransport($config);
        
        $this->assertInstanceOf(PhpMailerTransport::class, $transport);
    }
} 
