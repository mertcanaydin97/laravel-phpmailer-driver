@echo off
echo ========================================
echo Laravel PHPMailer Driver v1.0.9 Release
echo ========================================
echo.

echo [1/8] Checking current status...
git status
echo.

echo [2/8] Adding all changes...
git add .
echo.

echo [3/8] Committing changes...
git commit -m "Release v1.0.9 - Fixed attachment handling with correct Symfony Mailer methods"
echo.

echo [4/8] Creating tag v1.0.9...
git tag -a v1.0.9 -m "Version 1.0.9 - Fixed attachment handling with correct Symfony Mailer methods"
echo.

echo [5/8] Pushing to GitHub...
git push origin main
echo.

echo [6/8] Pushing tag to GitHub...
git push origin v1.0.9
echo.

echo [7/8] Updating composer dependencies...
composer update
echo.

echo [8/8] Publishing to Packagist...
echo Please manually publish to Packagist at: https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver
echo.

echo ========================================
echo Release v1.0.9 completed successfully!
echo ========================================
echo.
echo What's new in v1.0.9:
echo - Fixed attachment handling with correct Symfony Mailer methods
echo - Replaced getParts() with getAttachments() method
echo - Added proper type checking for Email instances
echo - Enhanced attachment processing with proper MIME types
echo.
echo Previous v1.0.8 features:
echo - Fixed Stringable interface implementation
echo - Added __toString() method for proper Symfony Mailer compatibility
echo - Resolved abstract method declaration error
echo.
echo Previous v1.0.7 features:
echo - Enhanced transport with attachment support
echo - Custom headers support for tracking and metadata
echo - Debug mode for SMTP troubleshooting
echo - Improved error handling with descriptive messages
echo - Type safety and null safety checks
echo - Reply-to address support
echo - Automatic fallbacks for missing content
echo.
echo Next steps:
echo 1. Wait for Packagist to update (usually 5-10 minutes)
echo 2. Test the new version in a Laravel project
echo 3. Update documentation if needed
echo.
pause
