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
]; 