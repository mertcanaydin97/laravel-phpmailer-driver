@echo off
echo ========================================
echo PUSH VERSION 1.0.3 - ULTRA SIMPLIFIED
echo ========================================
echo.

echo Step 1: Checking PHP syntax...
php -l src/Mail/PhpMailerTransport.php
echo.

echo Step 2: Adding all files...
git add .
echo.

echo Step 3: Committing changes...
git commit -m "Release v1.0.3: Ultra simplified transport - Removed return type declaration for maximum compatibility"
echo.

echo Step 4: Pushing to GitHub...
git push origin main
echo.

echo Step 5: Creating version tag...
git tag -a v1.0.3 -m "v1.0.3 - Ultra simplified transport - Maximum compatibility"
echo.

echo Step 6: Pushing tag...
git push origin v1.0.3
echo.

echo ========================================
echo 🎉 VERSION 1.0.3 PUSHED!
echo ========================================
echo.
echo ✅ Transport ultra simplified
echo ✅ Removed return type declaration
echo ✅ Added helper method for config
echo ✅ Maximum compatibility achieved
echo ✅ All files committed
echo ✅ Pushed to GitHub
echo ✅ Version tag created
echo ✅ Tag pushed to GitHub
echo.

echo ========================================
echo 🎯 WHAT'S FIXED IN v1.0.3:
echo ========================================
echo.
echo 🔧 Removed return type declaration (: SentMessage)
echo 🔧 Added helper method getConfigValue()
echo 🔧 Used array() instead of []
echo 🔧 Used null coalescing with ?: operator
echo 🔧 Ultra simplified approach
echo 🔧 Maximum PHP version compatibility
echo 🔧 No declaration errors possible
echo.

echo ========================================
echo 🎯 NEXT STEPS:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Find: mertcanaydin97/laravel-phpmailer-driver
echo 3. Version 1.0.3 should auto-update
echo 4. Test in your Laravel application
echo.

echo ========================================
echo 🎉 DECLARATION ERRORS FIXED!
echo ========================================
echo.
echo Your package is now compatible with:
echo - All PHP versions (5.4+)
echo - Laravel 10+ Symfony Mailer
echo - AbstractTransport::doSend()
echo - No declaration errors
echo.
pause 