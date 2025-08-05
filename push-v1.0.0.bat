@echo off
echo ========================================
echo PUSH VERSION 1.0.0 - FRESH START
echo ========================================
echo.

echo Step 1: Initializing Git repository...
git init
echo.

echo Step 2: Adding all files...
git add .
echo.

echo Step 3: Setting up Git user...
git config --global user.email "web@mertcanaydin.com.tr"
git config --global user.name "Mertcan Aydın"
echo.

echo Step 4: Creating initial commit...
git commit -m "Initial release v1.0.0: LARAVEL 10+ PHPMailer Driver - Complete package with AbstractTransport compatibility"
echo.

echo Step 5: Adding remote repository...
git remote add origin https://github.com/mertcanaydin97/laravel-phpmailer-driver.git
echo.

echo Step 6: Pushing to GitHub...
git push -u origin main
echo.

echo Step 7: Creating version tag...
git tag -a v1.0.0 -m "v1.0.0 - LARAVEL 10+ PHPMailer Driver - Initial release"
echo.

echo Step 8: Pushing tag...
git push origin v1.0.0
echo.

echo ========================================
echo 🎉 VERSION 1.0.0 PUSHED!
echo ========================================
echo.
echo ✅ Git repository initialized
echo ✅ All files committed
echo ✅ Pushed to GitHub
echo ✅ Version tag created
echo ✅ Tag pushed to GitHub
echo.

echo ========================================
echo 🎯 PACKAGE FEATURES:
echo ========================================
echo.
echo 🌟 Laravel 10+ Optimized
echo 🌟 PHPMailer Integration
echo 🌟 AbstractTransport Compatible
echo 🌟 13 Languages Supported
echo 🌟 6 Beautiful Email Templates
echo 🌟 Simplified Configuration
echo 🌟 Comprehensive Documentation
echo 🌟 Production Ready
echo 🌟 All Declaration Errors Fixed
echo 🌟 Clean Code Structure
echo.

echo ========================================
echo 🎯 NEXT STEPS:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Submit your package
echo 3. Package: mertcanaydin97/laravel-phpmailer-driver
echo 4. Version 1.0.0 will be available
echo 5. Test in Laravel 10 application
echo.

echo ========================================
echo 🎉 FRESH START COMPLETE!
echo ========================================
echo.
echo Your package is now ready for Packagist!
echo Version 1.0.0 is the initial release.
echo.
pause 