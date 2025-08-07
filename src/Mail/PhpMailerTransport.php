<?php

namespace Mertcanaydin97\LaravelPhpMailerDriver\Mail;

use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\Message;
use Symfony\Component\Mime\Part\DataPart;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

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
        $mailer = null;
        
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
            $debugLevel = $this->getConfigValue('debug_level', 0);
            $debugOutput = $this->getConfigValue('debug_output', 'error_log');
            
            if ($debug) {
                $mailer->SMTPDebug = $debugLevel; // Use configured debug level
                $mailer->Debugoutput = $debugOutput; // Use configured debug output
            }
            
            // Configure SSL/TLS verification options
            $sslVerifyPeer = $this->getConfigValue('ssl_verify_peer', true);
            $sslVerifyPeerName = $this->getConfigValue('ssl_verify_peer_name', true);
            $sslAllowSelfSigned = $this->getConfigValue('ssl_allow_self_signed', false);
            
            if (!$sslVerifyPeer || !$sslVerifyPeerName || $sslAllowSelfSigned) {
                $mailer->SMTPOptions = [
                    'ssl' => [
                        'verify_peer'       => $sslVerifyPeer,
                        'verify_peer_name'  => $sslVerifyPeerName,
                        'allow_self_signed' => $sslAllowSelfSigned,
                    ],
                ];
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
                } else {
                    throw new \Symfony\Component\Mailer\Exception\TransportException(
                        'No from address specified and no default from address configured'
                    );
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
                $errorInfo = $mailer->ErrorInfo ?: 'Unknown PHPMailer error';
                Log::error('PHPMailer failed to send email', [
                    'error' => $errorInfo,
                    'to' => $this->getRecipientList($to),
                    'subject' => $subject,
                    'host' => $mailer->Host,
                    'port' => $mailer->Port
                ]);
                
                throw new \Symfony\Component\Mailer\Exception\TransportException(
                    'PHPMailer failed to send email: ' . $errorInfo
                );
            }
            
            // Log successful send
            Log::info('Email sent successfully via PHPMailer', [
                'to' => $this->getRecipientList($to),
                'subject' => $subject,
                'message_id' => $mailer->getLastMessageID()
            ]);
            
            // Set the message ID in the SentMessage
            $messageId = $mailer->getLastMessageID() ?: uniqid('phpmailer_', true);
            $message->setMessageId($messageId);
            
        } catch (Exception $e) {
            $this->logPhpMailerError($e, $mailer);
            throw new \Symfony\Component\Mailer\Exception\TransportException(
                'PHPMailer error: ' . $e->getMessage(),
                previous: $e
            );
        } catch (\Exception $e) {
            $this->logGeneralError($e, $mailer);
            throw new \Symfony\Component\Mailer\Exception\TransportException(
                'General error: ' . $e->getMessage(),
                previous: $e
            );
        }
    }

    /**
     * Add attachments to the email
     */
    private function addAttachments(PHPMailer $mailer, Message $message): void
    {
        // Check if the message has attachments
        if (!$message instanceof \Symfony\Component\Mime\Email) {
            return;
        }

        // Get attachments from the email
        $attachments = $message->getAttachments();
        if (empty($attachments)) {
            return;
        }

        foreach ($attachments as $attachment) {
            if ($attachment instanceof \Symfony\Component\Mime\Part\DataPart) {
                $filename = $attachment->getFilename();
                $content = $attachment->getBody();
                $mediaType = $attachment->getMediaType();
                $mediaSubtype = $attachment->getMediaSubtype();
                
                if ($filename && $content) {
                    $mailer->addStringAttachment(
                        $content,
                        $filename,
                        PHPMailer::ENCODING_BASE64,
                        $mediaType . '/' . $mediaSubtype
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
     * Log PHPMailer specific errors
     */
    private function logPhpMailerError(Exception $e, ?PHPMailer $mailer): void
    {
        $context = [
            'error' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ];

        if ($mailer) {
            $context['host'] = $mailer->Host;
            $context['port'] = $mailer->Port;
            $context['username'] = $mailer->Username;
        }

        Log::error('PHPMailer transport error', $context);
    }

    /**
     * Log general errors
     */
    private function logGeneralError(\Exception $e, ?PHPMailer $mailer): void
    {
        $context = [
            'error' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ];

        if ($mailer) {
            $context['host'] = $mailer->Host;
            $context['port'] = $mailer->Port;
        }

        Log::error('General transport error', $context);
    }

    /**
     * Get recipient list for logging
     */
    private function getRecipientList($recipients): array
    {
        if (empty($recipients)) {
            return [];
        }

        $list = [];
        foreach ($recipients as $recipient) {
            $list[] = $recipient->getAddress();
        }

        return $list;
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
