<?php

/**
 * Comprehensive Test Script for Laravel PHPMailer Driver
 * This script tests every aspect of the package
 */

echo "🔍 COMPREHENSIVE PHPMailer Driver Test\n";
echo "=====================================\n\n";

// Test 1: Basic PHP and Laravel Classes
echo "1. Testing Basic Dependencies...\n";
$tests = [
    'PHP Version' => version_compare(PHP_VERSION, '8.0.0', '>='),
    'ServiceProvider Class' => class_exists('Illuminate\Support\ServiceProvider'),
    'MailManager Class' => class_exists('Illuminate\Mail\MailManager'),
    'AbstractTransport Class' => class_exists('Symfony\Component\Mailer\Transport\AbstractTransport'),
    'SentMessage Class' => class_exists('Symfony\Component\Mailer\SentMessage'),
    'Message Class' => class_exists('Symfony\Component\Mime\Message'),
];

foreach ($tests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 2: Package Classes
echo "\n2. Testing Package Classes...\n";
$packageTests = [
    'PhpMailerServiceProvider' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider'),
    'PhpMailerTransport' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport'),
    'SimplePhpMailerTransport' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\SimplePhpMailerTransport'),
    'TestPhpMailerCommand' => class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Console\TestPhpMailerCommand'),
];

foreach ($packageTests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 3: PHPMailer
echo "\n3. Testing PHPMailer...\n";
$phpmailerTests = [
    'PHPMailer Class' => class_exists('PHPMailer\PHPMailer\PHPMailer'),
    'PHPMailer Exception' => class_exists('PHPMailer\PHPMailer\Exception'),
];

foreach ($phpmailerTests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 4: Configuration Files
echo "\n4. Testing Configuration Files...\n";
$configTests = [
    'composer.json exists' => file_exists('composer.json'),
    'config/phpmailer.php exists' => file_exists('config/phpmailer.php'),
    'README.md exists' => file_exists('README.md'),
];

foreach ($configTests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 5: File Structure
echo "\n5. Testing File Structure...\n";
$structureTests = [
    'src/ directory' => is_dir('src'),
    'src/Mail/ directory' => is_dir('src/Mail'),
    'src/Console/ directory' => is_dir('src/Console'),
    'resources/ directory' => is_dir('resources'),
    'tests/ directory' => is_dir('tests'),
];

foreach ($structureTests as $test => $result) {
    echo "   " . ($result ? "✅" : "❌") . " $test\n";
}

// Test 6: Autoloading
echo "\n6. Testing Autoloading...\n";
try {
    $composerJson = json_decode(file_get_contents('composer.json'), true);
    $autoloadTests = [
        'composer.json is valid JSON' => $composerJson !== null,
        'PSR-4 autoload configured' => isset($composerJson['autoload']['psr-4']),
        'Laravel providers configured' => isset($composerJson['extra']['laravel']['providers']),
    ];
    
    foreach ($autoloadTests as $test => $result) {
        echo "   " . ($result ? "✅" : "❌") . " $test\n";
    }
} catch (Exception $e) {
    echo "   ❌ composer.json parsing failed: " . $e->getMessage() . "\n";
}

// Test 7: Service Provider Analysis
echo "\n7. Testing Service Provider...\n";
if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider')) {
    $provider = new ReflectionClass('Mertcanaydin97\LaravelPhpMailerDriver\PhpMailerServiceProvider');
    $methods = $provider->getMethods(ReflectionMethod::IS_PUBLIC);
    
    $methodTests = [
        'register() method exists' => $provider->hasMethod('register'),
        'boot() method exists' => $provider->hasMethod('boot'),
        'extends ServiceProvider' => $provider->isSubclassOf('Illuminate\Support\ServiceProvider'),
    ];
    
    foreach ($methodTests as $test => $result) {
        echo "   " . ($result ? "✅" : "❌") . " $test\n";
    }
} else {
    echo "   ❌ Service provider class not found\n";
}

// Test 8: Transport Analysis
echo "\n8. Testing Transport Classes...\n";
if (class_exists('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport')) {
    $transport = new ReflectionClass('Mertcanaydin97\LaravelPhpMailerDriver\Mail\PhpMailerTransport');
    
    $transportTests = [
        'extends AbstractTransport' => $transport->isSubclassOf('Symfony\Component\Mailer\Transport\AbstractTransport'),
        'has doSend() method' => $transport->hasMethod('doSend'),
        'has constructor' => $transport->hasMethod('__construct'),
    ];
    
    foreach ($transportTests as $test => $result) {
        echo "   " . ($result ? "✅" : "❌") . " $test\n";
    }
} else {
    echo "   ❌ Transport class not found\n";
}

echo "\n=====================================\n";
echo "🎯 RECOMMENDATIONS:\n";
echo "=====================================\n\n";

echo "1. If any classes are missing, run:\n";
echo "   composer dump-autoload\n\n";

echo "2. If transport registration fails, check:\n";
echo "   - config/mail.php has 'phpmailer' mailer config\n";
echo "   - .env has MAIL_MAILER=phpmailer\n";
echo "   - Clear cache: php artisan config:clear\n\n";

echo "3. If PHPMailer is missing, install:\n";
echo "   composer require phpmailer/phpmailer\n\n";

echo "4. Test the driver:\n";
echo "   php artisan phpmailer:test\n\n";

echo "=====================================\n";
echo "Test complete! Check results above.\n";
echo "=====================================\n"; 