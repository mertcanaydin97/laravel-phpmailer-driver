<?php

<<<<<<< HEAD
namespace Mertcanaydin97\LaravelPhpMailerDriver\Mail;
=======
namespace OG\LaravelPhpMailerDriver\Mail;
>>>>>>> 4aa52fa (Initial release: Laravel PHPMailer Driver with 13 languages and 6 email templates)

use Illuminate\Mail\Transport\Transport;
use Illuminate\Support\Collection;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Swift_Mime_SimpleMessage;

class PhpMailerTransport extends Transport
{
    /**
     * The PHPMailer instance.
     */
    protected PHPMailer $mailer;

    /**
     * The configuration array.
     */
    protected array $config;

    /**
     * Create a new PHPMailer transport instance.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }

    /**
     * Configure the PHPMailer instance.
     */
    protected function configureMailer(): void
    {
        // Set debug mode
        $this->mailer->SMTPDebug = 0;

        // Set mailer
        $this->mailer->isSMTP();

        // Set server settings
        $this->mailer->Host = $this->config['host'] ?? 'localhost';
        $this->mailer->Port = $this->config['port'] ?? 587;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->config['username'] ?? '';
        $this->mailer->Password = $this->config['password'] ?? '';

        // Set encryption
        if (isset($this->config['encryption']) && $this->config['encryption'] === 'ssl') {
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } elseif (isset($this->config['encryption']) && $this->config['encryption'] === 'tls') {
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        // Set timeout
        if (isset($this->config['timeout'])) {
            $this->mailer->Timeout = $this->config['timeout'];
        }

        // Set local domain
        if (isset($this->config['local_domain'])) {
            $this->mailer->Hostname = $this->config['local_domain'];
        }

        // Set SSL verification
        if (isset($this->config['verify_peer'])) {
            $this->mailer->SMTPOptions['ssl']['verify_peer'] = $this->config['verify_peer'];
        }

        if (isset($this->config['verify_peer_name'])) {
            $this->mailer->SMTPOptions['ssl']['verify_peer_name'] = $this->config['verify_peer_name'];
        }

        if (isset($this->config['allow_self_signed'])) {
            $this->mailer->SMTPOptions['ssl']['allow_self_signed'] = $this->config['allow_self_signed'];
        }

        // Set character encoding
        $this->mailer->CharSet = 'UTF-8';
    }

    /**
     * Send the given message.
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null): int
    {
        $this->beforeSendPerformed($message);

        try {
            // Reset the mailer
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            $this->mailer->clearCustomHeaders();
            $this->mailer->clearReplyTos();

            // Set from address
            $from = $message->getFrom();
            if (!empty($from)) {
                $fromAddress = array_keys($from)[0];
                $fromName = $from[$fromAddress];
                $this->mailer->setFrom($fromAddress, $fromName);
            }

            // Set reply-to
            $replyTo = $message->getReplyTo();
            if (!empty($replyTo)) {
                $replyToAddress = array_keys($replyTo)[0];
                $replyToName = $replyTo[$replyToAddress];
                $this->mailer->addReplyTo($replyToAddress, $replyToName);
            }

            // Set recipients
            $to = $message->getTo();
            if (!empty($to)) {
                foreach ($to as $address => $name) {
                    $this->mailer->addAddress($address, $name);
                }
            }

            // Set CC recipients
            $cc = $message->getCc();
            if (!empty($cc)) {
                foreach ($cc as $address => $name) {
                    $this->mailer->addCC($address, $name);
                }
            }

            // Set BCC recipients
            $bcc = $message->getBcc();
            if (!empty($bcc)) {
                foreach ($bcc as $address => $name) {
                    $this->mailer->addBCC($address, $name);
                }
            }

            // Set subject
            $this->mailer->Subject = $message->getSubject();

            // Set body
            $body = $message->getBody();
            if ($message->getContentType() === 'text/html') {
                $this->mailer->isHTML(true);
                $this->mailer->Body = $body;
                $this->mailer->AltBody = $this->getTextBody($message);
            } else {
                $this->mailer->isHTML(false);
                $this->mailer->Body = $body;
            }

            // Add attachments
            $children = $message->getChildren();
            foreach ($children as $child) {
                if ($child instanceof \Swift_Attachment) {
                    $this->mailer->addAttachment(
                        $child->getBody(),
                        $child->getFilename(),
                        $child->getContentType()
                    );
                }
            }

            // Add custom headers
            $headers = $message->getHeaders();
            foreach ($headers->getAll() as $header) {
                if ($header->getFieldName() !== 'Content-Type' && 
                    $header->getFieldName() !== 'Content-Transfer-Encoding' &&
                    $header->getFieldName() !== 'MIME-Version') {
                    $this->mailer->addCustomHeader($header->getFieldName(), $header->getFieldBody());
                }
            }

            // Send the email
            $this->mailer->send();

            $this->sendPerformed($message);

            return $this->numberOfRecipients($message);

        } catch (Exception $e) {
            throw new \Swift_TransportException(
                'PHPMailer Exception: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Get the text body from the message.
     */
    protected function getTextBody(Swift_Mime_SimpleMessage $message): string
    {
        $text = '';

        foreach ($message->getChildren() as $child) {
            if ($child instanceof \Swift_MimePart && $child->getContentType() === 'text/plain') {
                $text = $child->getBody();
                break;
            }
        }

        return $text;
    }

    /**
     * Get the number of recipients.
     */
    protected function numberOfRecipients(Swift_Mime_SimpleMessage $message): int
    {
        return count($message->getTo()) + count($message->getCc()) + count($message->getBcc());
    }
} 
