<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver\Mail;

use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\Message;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PhpMailerTransport extends AbstractTransport
{
    protected array $config;

    public function __construct(array $config)
    {
        parent::__construct();
        $this->config = $config;
    }

    protected function doSend(Message $message): SentMessage
    {
        try {
            $mailer = new PHPMailer(true);
            
            // Configure SMTP
            $mailer->isSMTP();
            $mailer->Host = $this->config['host'] ?? 'localhost';
            $mailer->Port = $this->config['port'] ?? 587;
            $mailer->SMTPAuth = true;
            $mailer->Username = $this->config['username'] ?? '';
            $mailer->Password = $this->config['password'] ?? '';
            
            // Set encryption
            if (isset($this->config['encryption'])) {
                if ($this->config['encryption'] === 'ssl') {
                    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                } elseif ($this->config['encryption'] === 'tls') {
                    $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                }
            }
            
            // Set timeout
            if (isset($this->config['timeout'])) {
                $mailer->Timeout = $this->config['timeout'];
            }
            
            // Set character encoding
            $mailer->CharSet = 'UTF-8';
            
            // Set from address
            $from = $message->getFrom();
            if (!empty($from)) {
                $fromAddress = $from[0]->getAddress();
                $fromName = $from[0]->getName();
                $mailer->setFrom($fromAddress, $fromName);
            }
            
            // Set recipients
            $to = $message->getTo();
            if (!empty($to)) {
                foreach ($to as $address) {
                    $mailer->addAddress($address->getAddress(), $address->getName());
                }
            }
            
            // Set CC recipients
            $cc = $message->getCc();
            if (!empty($cc)) {
                foreach ($cc as $address) {
                    $mailer->addCC($address->getAddress(), $address->getName());
                }
            }
            
            // Set BCC recipients
            $bcc = $message->getBcc();
            if (!empty($bcc)) {
                foreach ($bcc as $address) {
                    $mailer->addBCC($address->getAddress(), $address->getName());
                }
            }
            
            // Set subject
            $mailer->Subject = $message->getSubject();
            
            // Set body
            $htmlBody = $message->getHtmlBody();
            $textBody = $message->getTextBody();
            
            if (!empty($htmlBody)) {
                $mailer->isHTML(true);
                $mailer->Body = $htmlBody;
                $mailer->AltBody = $textBody;
            } else {
                $mailer->isHTML(false);
                $mailer->Body = $textBody;
            }
            
            // Send the email
            $mailer->send();
            
            return new SentMessage($message, $mailer->getLastMessageID() ?: uniqid('phpmailer_', true));
            
        } catch (Exception $e) {
            throw new \Symfony\Component\Mailer\Exception\TransportException(
                'PHPMailer error: ' . $e->getMessage(),
                previous: $e
            );
        }
    }
} 
