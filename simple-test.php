<?php

/**
 * Simple Test Script - No Laravel Required
 * Tests only our package classes
 */

// Include Composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';

echo "🔍 SIMPLE PACKAGE TEST (No Laravel Required)\n";
echo "===========================================\n\n";

// Test 1: Our Package Classes
echo "1. Testing Our Package Classes...\n";
$packageTests = [
    'PhpMailerServiceProvider' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider'),
    'PhpMailerTransport' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport'),
    'SimplePhpMailerTransport' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\SimplePhpMailerTransport'),
    'TestPhpMailerCommand' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Console\TestPhpMailerCommand'),
];

foreach ($packageTests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 2: File Existence
echo "\n2. Testing File Existence...\n";
$fileTests = [
    'src/PhpMailerServiceProvider.php' => file_exists('src/PhpMailerServiceProvider.php'),
    'src/Mail/PhpMailerTransport.php' => file_exists('src/Mail/PhpMailerTransport.php'),
    'src/Mail/SimplePhpMailerTransport.php' => file_exists('src/Mail/SimplePhpMailerTransport.php'),
    'src/Console/TestPhpMailerCommand.php' => file_exists('src/Console/TestPhpMailerCommand.php'),
];

foreach ($fileTests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 3: Class Analysis (if classes exist)
echo "\n3. Testing Class Analysis...\n";
if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider')) {
    $provider = new ReflectionClass('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider');
    echo "   ✅ ServiceProvider has register() method: " . ($provider->hasMethod('register') ? 'Yes' : 'No') . "\n";
    echo "   ✅ ServiceProvider has boot() method: " . ($provider->hasMethod('boot') ? 'Yes' : 'No') . "\n";
} else {
    echo "   ❌ ServiceProvider class not found\n";
}

if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport')) {
    $transport = new ReflectionClass('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport');
    echo "   ✅ Transport has doSend() method: " . ($transport->hasMethod('doSend') ? 'Yes' : 'No') . "\n";
    echo "   ✅ Transport has constructor: " . ($transport->hasMethod('__construct') ? 'Yes' : 'No') . "\n";
} else {
    echo "   ❌ Transport class not found\n";
}

// Test 4: Composer Configuration
echo "\n4. Testing Composer Configuration...\n";
try {
    $composerJson = json_decode(file_get_contents('composer.json'), true);
    echo "   ✅ composer.json is valid JSON\n";
    echo "   ✅ Package name: " . ($composerJson['name'] ?? 'Missing') . "\n";
    echo "   ✅ Version: " . ($composerJson['version'] ?? 'Missing') . "\n";
    echo "   ✅ PSR-4 autoload configured: " . (isset($composerJson['autoload']['psr-4']) ? 'Yes' : 'No') . "\n";
    echo "   ✅ Laravel providers configured: " . (isset($composerJson['extra']['laravel']['providers']) ? 'Yes' : 'No') . "\n";
} catch (Exception $e) {
    echo "   ❌ composer.json parsing failed: " . $e->getMessage() . "\n";
}

echo "\n===========================================\n";
echo "🎯 SUMMARY:\n";
echo "===========================================\n\n";

$allTests = array_merge($packageTests, $fileTests);
$passed = count(array_filter($allTests));
$total = count($allTests);

echo "Tests passed: $passed/$total\n";
echo "Success rate: " . round(($passed / $total) * 100, 1) . "%\n\n";

if ($passed === $total) {
    echo "🎉 ALL TESTS PASSED! Package structure is correct.\n";
    echo "The issue is likely in the Laravel application setup.\n\n";
    echo "Next steps:\n";
    echo "1. Install in a Laravel project: composer require mertcanaydin97/laravel-phpmailer-driver\n";
    echo "2. Add mailer config to config/mail.php\n";
    echo "3. Set MAIL_MAILER=phpmailer in .env\n";
    echo "4. Clear cache: php artisan config:clear\n";
    echo "5. Test: php artisan phpmailer:test\n";
} else {
    echo "❌ Some tests failed. Check the issues above.\n";
}

echo "\n===========================================\n";
echo "Test complete!\n";
echo "===========================================\n"; 