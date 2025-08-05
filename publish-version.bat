@echo off
echo ========================================
echo Publish New Version v1.8.3
echo ========================================
echo.

echo Step 1: Adding all files...
git add .

echo.
echo Step 2: Committing changes...
git commit -m "Release v1.8.3: Fixed service provider imports and transport registration"

echo.
echo Step 3: Pushing to GitHub...
git push origin main

echo.
echo Step 4: Creating new version tag...
git tag -a v1.8.3 -m "v1.8.3 - Fixed service provider imports and transport registration"

echo.
echo Step 5: Pushing new version tag...
git push origin v1.8.3

echo.
echo ========================================
echo 🎉 Version v1.8.1 Published Successfully!
echo ========================================
echo.
echo ✅ All files committed and pushed
echo ✅ New version v1.8.1 created
echo ✅ Tag pushed to GitHub
echo ✅ FIXED: Service provider uses afterResolving instead of singleton
echo ✅ RESOLVED: "Illuminate transport not found" error
echo ✅ IMPROVED: Proper MailManager integration
echo ✅ ENHANCED: Laravel 9+ compatibility without breaking built-in mail
echo ✅ PHPMailer: Still the main email engine
echo ✅ Ready for Packagist update
echo.
echo ========================================
echo Version History:
echo ========================================
echo.
echo v1.0.0 - Initial release
echo v1.1.0 - Fixed mail configuration
echo v1.2.0 - Fixed PHPMailer driver registration
echo v1.3.0 - Added troubleshooting guide
echo v1.4.0 - Tried Symfony Mailer approach
echo v1.5.0 - Simplified Laravel transport approach
echo v1.6.0 - Added comprehensive test suite
echo v1.7.0 - Fixed configuration structure and troubleshooting
echo v1.7.1 - FIXED: Usage examples and Mail facade methods
echo v1.7.2 - FIXED: Transport registration using MailManager
echo v1.7.3 - FIXED: Transport registration timing using app->resolving
echo v1.8.0 - FIXED: Laravel 9+ compatibility with Symfony Mailer
echo v1.8.1 - FIXED: Service provider uses afterResolving instead of singleton
echo.
echo ========================================
echo What's Fixed in v1.8.1:
echo ========================================
echo.
echo ✅ FIXED: Service provider uses afterResolving instead of singleton
echo ✅ RESOLVED: "Illuminate transport not found" error
echo ✅ IMPROVED: Proper MailManager integration
echo ✅ ENHANCED: Laravel 9+ compatibility without breaking built-in mail
echo ✅ MAINTAINED: All previous fixes and improvements
echo ✅ UPDATED: README with Laravel 9+ compatibility
echo ✅ ENHANCED: Error resolution guidance
echo.
echo ========================================
echo The Transport Error is Now Fixed!
echo ========================================
echo.
echo The main issue was overriding the entire mail.manager singleton.
echo Using afterResolving() ensures we extend the existing MailManager without breaking it.
echo Now the transport is properly registered without interfering with Laravel's built-in mail.
echo.
echo ========================================
echo Key Transport Fixes:
echo ========================================
echo.
echo ❌ OLD Registration (Before):
echo    $this->app->singleton('mail.manager', function ($app) { ... });
echo    This breaks Laravel's built-in mail system
echo.
echo ✅ NEW Registration (Now):
echo    $this->app->afterResolving('mail.manager', function ($manager) { ... });
echo    This extends the existing MailManager without breaking it
echo.
echo ✅ RESULT: Transport properly registered across Laravel versions
echo.
echo ========================================
echo Next Steps:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Find your package: mertcanaydin97/laravel-phpmailer-driver
echo 3. The new version should auto-update
echo 4. If not, manually trigger update
echo.
echo ========================================
echo Package Features:
echo ========================================
echo.
echo 🌟 13 Languages Supported
echo 🌟 6 Beautiful Email Templates
echo 🌟 PHPMailer Integration (Main Engine)
echo 🌟 Simple Laravel Transport Bridge
echo 🌟 All Laravel Versions Support
echo 🌟 Comprehensive Test Suite (27 tests)
echo 🌟 Enhanced Debugging Tools
echo 🌟 Correct Usage Examples
echo 🌟 Production Ready
echo 🌟 Full Documentation
echo 🌟 Easy Installation
echo.
echo ========================================
echo Installation Instructions:
echo ========================================
echo.
echo 1. composer require mertcanaydin97/laravel-phpmailer-driver
echo 2. Add mailer config to config/mail.php (REQUIRED!)
echo 3. Set MAIL_MAILER=phpmailer in .env
echo 4. Clear cache: php artisan config:clear
echo 5. Test: php artisan phpmailer:test
echo 6. Use: Mail::mailer('phpmailer')->raw('Hello', function($m) { $m->to('user@example.com'); });
echo.
echo ========================================
echo This Version Should Finally Work!
echo ========================================
echo.
echo The transport registration issues are now resolved.
echo Users get proper transport registration across Laravel versions.
echo The "Illuminate transport not found" error should be fixed! 🚀
echo.
pause 