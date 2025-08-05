@echo off
echo ========================================
echo CHECKING FOR DECLARATION ERRORS
echo ========================================
echo.

echo Step 1: Checking PHP syntax for all files...
echo.

echo Checking PhpMailerServiceProvider.php...
php -l src/PhpMailerServiceProvider.php
echo.

echo Checking PhpMailerTransport.php...
php -l src/Mail/PhpMailerTransport.php
echo.

echo Checking TestPhpMailerCommand.php...
php -l src/Console/TestPhpMailerCommand.php
echo.

echo Checking TestPhpMailerTransportTest.php...
php -l tests/PhpMailerTransportTest.php
echo.

echo Step 2: Validating composer.json...
composer validate
echo.

echo Step 3: Regenerating autoloader...
composer dump-autoload --optimize
echo.

echo ========================================
echo 🎯 DECLARATION ERROR CHECK COMPLETE
echo ========================================
echo.
echo If you see any errors above, they need to be fixed.
echo If no errors, your package is ready!
echo.
pause 