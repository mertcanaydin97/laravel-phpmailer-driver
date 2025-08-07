<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PHPMailer Driver Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the PHPMailer driver.
    | These settings will be used when the PHPMailer transport is created.
    | Simplified for Laravel 10+ compatibility.
    |
    */

    'host' => env('MAIL_HOST', 'localhost'),
    'port' => env('MAIL_PORT', 587),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'timeout' => env('MAIL_TIMEOUT', 30),
    
    // Debug mode for troubleshooting
    'debug' => env('MAIL_DEBUG', false),
    
    // Default from address and name (used if not specified in the message)
    'from_address' => env('MAIL_FROM_ADDRESS'),
    'from_name' => env('MAIL_FROM_NAME'),
    
    // SSL/TLS verification options
    'ssl_verify_peer' => env('MAIL_SSL_VERIFY_PEER', true),
    'ssl_verify_peer_name' => env('MAIL_SSL_VERIFY_PEER_NAME', true),
    'ssl_allow_self_signed' => env('MAIL_SSL_ALLOW_SELF_SIGNED', false),
    
    // Additional debug options
    'debug_output' => env('MAIL_DEBUG_OUTPUT', 'error_log'), // 'echo', 'error_log', or 'html'
    'debug_level' => env('MAIL_DEBUG_LEVEL', 0), // 0=off, 1=client messages, 2=client and server messages, 3=connection, 4=low-level data
]; 