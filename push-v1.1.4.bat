@echo off
echo ========================================
echo Laravel PHPMailer Driver v1.1.4 Release
echo ========================================
echo.

echo [1/8] Checking current status...
git status
echo.

echo [2/8] Adding all changes...
git add .
echo.

echo [3/8] Committing changes...
git commit -m "Release v1.1.4 - Enhanced configuration section with complete environment variables mapping"
echo.

echo [4/8] Creating tag v1.1.4...
git tag -a v1.1.4 -m "Version 1.1.4 - Enhanced configuration section with complete environment variables mapping"
echo.

echo [5/8] Pushing to GitHub...
git push origin main
echo.

echo [6/8] Pushing tag to GitHub...
git push origin v1.1.4
echo.

echo [7/8] Updating composer dependencies...
composer update
echo.

echo [8/8] Publishing to Packagist...
echo Please manually publish to Packagist at: https://packagist.org/packages/mertcanaydin97/laravel-phpmailer-driver
echo.

echo ========================================
echo Release v1.1.4 completed successfully!
echo ========================================
echo.
echo What's new in v1.1.4:
echo - Enhanced configuration section with complete environment variables mapping
echo - Added Config Key column to environment variables table
echo - Added complete configuration file structure documentation
echo - Added publish command for configuration file
echo - Added detailed comments for each configuration option
echo - Improved configuration management documentation
echo - Added clear mapping between env vars and config keys
echo - Enhanced debugging and SSL configuration documentation
echo - Added configuration file customization instructions
echo - Updated configuration examples with all available options
echo.
echo Previous v1.1.3 features:
echo - Comprehensive README update with accurate package information
echo - Fixed template usage examples (removed incorrect Message class usage)
echo - Added accurate feature list based on actual implementation
echo - Updated SSL verification and debug options documentation
echo - Corrected template count (5 templates, not 6)
echo - Enhanced troubleshooting section with SSL and template path checks
echo - Updated environment variables table with all new options
echo - Fixed internationalization examples with correct syntax
echo - Added proper template inheritance and component examples
echo - Updated version history to reflect actual package state
echo.
echo Previous v1.1.2 features:
echo - Added SSL verification options (verify_peer, verify_peer_name, allow_self_signed)
echo - Enhanced debug settings with configurable levels and output methods
echo - Added debug level configuration (0-4) for different verbosity levels
echo - Added debug output method configuration (error_log, echo, html)
echo - Added SSL options for development environments with self-signed certificates
echo - Updated configuration file with new SSL and debug options
echo - Updated documentation with SSL verification examples and warnings
echo - Added environment variables for all new SSL and debug options
echo.
echo Previous v1.1.1 features:
echo - Comprehensive template usage documentation
echo - Fixed "Class Illuminate\Mail\Transport\Transport not found" error
echo - Added correct template usage examples with Mailable classes
echo - Added template inheritance and component-based templates
echo - Added template localization and multi-language support
echo - Added template testing and validation examples
echo - Added advanced template features and styling
echo - Updated troubleshooting section with template-specific solutions
echo.
echo Previous v1.1.0 features:
echo - Comprehensive error handling and logging
echo - Laravel native integration with automatic logging
echo - Detailed error types and responses
echo - Queue integration with failed job handling
echo - Custom error handling examples
echo - Response handling for sync and async operations
echo - Enhanced debugging and troubleshooting
echo.
echo Previous v1.0.9 features:
echo - Fixed attachment handling with correct Symfony Mailer methods
echo - Replaced getParts() with getAttachments() method
echo - Added proper type checking for Email instances
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
echo 2. Check GitHub repository for updated README
echo 3. Test the new version in a Laravel project
echo 4. Verify that configuration documentation is complete and accurate
echo 5. Test all configuration options and environment variables
echo.
pause
