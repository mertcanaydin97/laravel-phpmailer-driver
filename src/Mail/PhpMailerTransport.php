<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver\Mail;

use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\Message;
use Symfony\Component\Mime\Part\DataPart;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PhpMailerTransport extends AbstractTransport
{
    private $config;

    public function __construct($config = null)
    {
        parent::__construct();
        $this->config = $config ?: array();
    }

    protected function doSend(SentMessage $message): void
    {
        try {
            $mailer = new PHPMailer(true);
            
            // Configure SMTP
            $mailer->isSMTP();
            $mailer->Host = $this->getConfigValue('host', 'localhost');
            $mailer->Port = (int) $this->getConfigValue('port', 587);
            $mailer->SMTPAuth = true;
            $mailer->Username = $this->getConfigValue('username', '');
            $mailer->Password = $this->getConfigValue('password', '');
            
            // Set encryption
            $encryption = $this->getConfigValue('encryption', 'tls');
            if ($encryption === 'ssl') {
                $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } elseif ($encryption === 'tls') {
                $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            
            // Set timeout
            $timeout = $this->getConfigValue('timeout', 30);
            if ($timeout) {
                $mailer->Timeout = (int) $timeout;
            }
            
            // Set character encoding
            $mailer->CharSet = 'UTF-8';
            
            // Enable debug if configured
            $debug = $this->getConfigValue('debug', false);
            if ($debug) {
                $mailer->SMTPDebug = 2; // Enable verbose debug output
            }
            
            // Get the original message from SentMessage
            $originalMessage = $message->getOriginalMessage();
            
            // Set from address
            $from = $originalMessage->getFrom();
            if (!empty($from)) {
                $fromAddress = $from[0]->getAddress();
                $fromName = $from[0]->getName() ?: '';
                $mailer->setFrom($fromAddress, $fromName);
            } else {
                // Use default from address if none provided
                $defaultFrom = $this->getConfigValue('from_address');
                $defaultFromName = $this->getConfigValue('from_name', '');
                if ($defaultFrom) {
                    $mailer->setFrom($defaultFrom, $defaultFromName);
                }
            }
            
            // Set recipients
            $to = $originalMessage->getTo();
            if (!empty($to)) {
                foreach ($to as $address) {
                    $mailer->addAddress($address->getAddress(), $address->getName() ?: '');
                }
            } else {
                throw new \Symfony\Component\Mailer\Exception\TransportException(
                    'No recipients specified for the email'
                );
            }
            
            // Set CC recipients
            $cc = $originalMessage->getCc();
            if (!empty($cc)) {
                foreach ($cc as $address) {
                    $mailer->addCC($address->getAddress(), $address->getName() ?: '');
                }
            }
            
            // Set BCC recipients
            $bcc = $originalMessage->getBcc();
            if (!empty($bcc)) {
                foreach ($bcc as $address) {
                    $mailer->addBCC($address->getAddress(), $address->getName() ?: '');
                }
            }
            
            // Set reply-to
            $replyTo = $originalMessage->getReplyTo();
            if (!empty($replyTo)) {
                foreach ($replyTo as $address) {
                    $mailer->addReplyTo($address->getAddress(), $address->getName() ?: '');
                }
            }
            
            // Set subject
            $subject = $originalMessage->getSubject();
            if ($subject) {
                $mailer->Subject = $subject;
            }
            
            // Set body
            $htmlBody = $originalMessage->getHtmlBody();
            $textBody = $originalMessage->getTextBody();
            
            if (!empty($htmlBody)) {
                $mailer->isHTML(true);
                $mailer->Body = $htmlBody;
                $mailer->AltBody = $textBody ?: strip_tags($htmlBody);
            } else {
                $mailer->isHTML(false);
                $mailer->Body = $textBody ?: '';
            }
            
            // Handle attachments
            $this->addAttachments($mailer, $originalMessage);
            
            // Handle custom headers
            $this->addCustomHeaders($mailer, $originalMessage);
            
            // Send the email
            if (!$mailer->send()) {
                throw new \Symfony\Component\Mailer\Exception\TransportException(
                    'PHPMailer failed to send email: ' . $mailer->ErrorInfo
                );
            }
            
            // Set the message ID in the SentMessage
            $messageId = $mailer->getLastMessageID() ?: uniqid('phpmailer_', true);
            $message->setMessageId($messageId);
            
        } catch (Exception $e) {
            throw new \Symfony\Component\Mailer\Exception\TransportException(
                'PHPMailer error: ' . $e->getMessage(),
                previous: $e
            );
        }
    }

    /**
     * Add attachments to the email
     */
    private function addAttachments(PHPMailer $mailer, Message $message): void
    {
        $parts = $message->getParts();
        if (empty($parts)) {
            return;
        }

        foreach ($parts as $part) {
            if ($part instanceof DataPart) {
                $filename = $part->getFilename();
                $content = $part->getBody();
                
                if ($filename && $content) {
                    $mailer->addStringAttachment(
                        $content,
                        $filename,
                        PHPMailer::ENCODING_BASE64,
                        $part->getMediaType() . '/' . $part->getMediaSubtype()
                    );
                }
            }
        }
    }

    /**
     * Add custom headers to the email
     */
    private function addCustomHeaders(PHPMailer $mailer, Message $message): void
    {
        $headers = $message->getHeaders();
        if (empty($headers)) {
            return;
        }

        foreach ($headers->all() as $header) {
            $name = $header->getName();
            $value = $header->getBodyAsString();
            
            // Skip standard headers that PHPMailer handles automatically
            $skipHeaders = ['from', 'to', 'cc', 'bcc', 'reply-to', 'subject', 'content-type', 'mime-version'];
            if (!in_array(strtolower($name), $skipHeaders)) {
                $mailer->addCustomHeader($name, $value);
            }
        }
    }

    /**
     * Get a string representation of the transport
     */
    public function __toString(): string
    {
        $host = $this->getConfigValue('host', 'localhost');
        $port = $this->getConfigValue('port', 587);
        $encryption = $this->getConfigValue('encryption', 'tls');
        
        return sprintf('phpmailer://%s:%d?encryption=%s', $host, $port, $encryption);
    }

    private function getConfigValue($key, $default = null)
    {
        return isset($this->config[$key]) ? $this->config[$key] : $default;
    }
} 
