<?php

/**
 * Debug script to test transport registration
 * Run this in a Laravel application to see what's happening
 */

echo "🔍 Debugging PHPMailer Transport Registration\n";
echo "=============================================\n\n";

// Test 1: Check if the transport class exists
echo "1. Testing transport class existence...\n";
if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\SimplePhpMailerTransport')) {
    echo "   ✅ SimplePhpMailerTransport class found\n";
} else {
    echo "   ❌ SimplePhpMailerTransport class not found\n";
}

if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport')) {
    echo "   ✅ PhpMailerTransport class found\n";
} else {
    echo "   ❌ PhpMailerTransport class not found\n";
}

// Test 2: Check if service provider exists
echo "\n2. Testing service provider existence...\n";
if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider')) {
    echo "   ✅ PhpMailerServiceProvider class found\n";
} else {
    echo "   ❌ PhpMailerServiceProvider class not found\n";
}

// Test 3: Check if PHPMailer exists
echo "\n3. Testing PHPMailer existence...\n";
if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "   ✅ PHPMailer class found\n";
} else {
    echo "   ❌ PHPMailer class not found\n";
}

// Test 4: Check Symfony Mailer classes
echo "\n4. Testing Symfony Mailer classes...\n";
if (class_exists('Symfony\Component\Mailer\Transport\AbstractTransport')) {
    echo "   ✅ AbstractTransport class found\n";
} else {
    echo "   ❌ AbstractTransport class not found\n";
}

if (class_exists('Symfony\Component\Mailer\SentMessage')) {
    echo "   ✅ SentMessage class found\n";
} else {
    echo "   ❌ SentMessage class not found\n";
}

if (class_exists('Symfony\Component\Mime\Message')) {
    echo "   ✅ Message class found\n";
} else {
    echo "   ❌ Message class not found\n";
}

echo "\n=============================================\n";
echo "Debug complete. Check the results above.\n";
echo "If any classes are missing, that's the issue!\n"; 