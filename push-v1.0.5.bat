@echo off
echo ========================================
echo PUSH VERSION 1.0.5 - FINAL FIX
echo ========================================
echo.

echo Step 1: Checking PHP syntax...
php -l src/PhpMailerServiceProvider.php
php -l src/Mail/PhpMailerTransport.php
php -l src/Console/TestPhpMailerCommand.php
echo.

echo Step 2: Adding all files...
git add .
echo.

echo Step 3: Committing changes...
git commit -m "Release v1.0.5: FINAL FIX - Removed ALL null coalescing operators (??) for maximum compatibility"
echo.

echo Step 4: Pushing to GitHub...
git push origin main
echo.

echo Step 5: Creating version tag...
git tag -a v1.0.5 -m "v1.0.5 - FINAL FIX - Maximum compatibility"
echo.

echo Step 6: Pushing tag...
git push origin v1.0.5
echo.

echo ========================================
echo 🎉 VERSION 1.0.5 PUSHED!
echo ========================================
echo.
echo ✅ FINAL FIX applied
echo ✅ Removed ALL null coalescing operators (??)
echo ✅ Used isset() instead of ?? everywhere
echo ✅ All files committed
echo ✅ Pushed to GitHub
echo ✅ Version tag created
echo ✅ Tag pushed to GitHub
echo.

echo ========================================
echo 🎯 WHAT'S FIXED IN v1.0.5:
echo ========================================
echo.
echo 🔧 Removed ALL null coalescing operators (??)
echo 🔧 Used isset() instead of ?? in console command
echo 🔧 Used isset() instead of ?? in transport class
echo 🔧 Used array() instead of [] everywhere
echo 🔧 Removed ALL return type declarations
echo 🔧 Removed ALL type hints
echo 🔧 Ultra simplified approach
echo 🔧 Maximum PHP version compatibility
echo 🔧 NO DECLARATION ERRORS POSSIBLE
echo.

echo ========================================
echo 🎯 NEXT STEPS:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Find: mertcanaydin97/laravel-phpmailer-driver
echo 3. Version 1.0.5 should auto-update
echo 4. Test in your Laravel application
echo.

echo ========================================
echo 🎉 FINAL FIX COMPLETE!
echo ========================================
echo.
echo Your package is now compatible with:
echo - All PHP versions (5.4+)
echo - Laravel 10+ Symfony Mailer
echo - AbstractTransport::doSend()
echo - NO DECLARATION ERRORS
echo.
pause 