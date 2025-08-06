@echo off
echo ========================================
echo Laravel PHPMailer Driver v1.0.7 Release
echo ========================================
echo.

echo [1/8] Checking current status...
git status
echo.

echo [2/8] Adding all changes...
git add .
echo.

echo [3/8] Committing changes...
git commit -m "Release v1.0.7 - Enhanced transport with attachment support, custom headers, debug mode, and improved error handling"
echo.

echo [4/8] Creating tag v1.0.7...
git tag -a v1.0.7 -m "Version 1.0.7 - Enhanced transport with attachment support, custom headers, debug mode, and improved error handling"
echo.

echo [5/8] Pushing to GitHub...
git push origin main
echo.

echo [6/8] Pushing tag to GitHub...
git push origin v1.0.7
echo.

echo [7/8] Updating composer dependencies...
composer update
echo.

echo [8/8] Publishing to Packagist...
echo Please manually publish to Packagist at: https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver
echo.

echo ========================================
echo Release v1.0.7 completed successfully!
echo ========================================
echo.
echo What's new in v1.0.7:
echo - Enhanced transport with attachment support
echo - Custom headers support for tracking and metadata
echo - Debug mode for SMTP troubleshooting
echo - Improved error handling with descriptive messages
echo - Type safety and null safety checks
echo - Reply-to address support
echo - Automatic fallbacks for missing content
echo - Updated README with comprehensive documentation
echo.
echo Next steps:
echo 1. Wait for Packagist to update (usually 5-10 minutes)
echo 2. Test the new version in a Laravel project
echo 3. Update documentation if needed
echo.
pause
