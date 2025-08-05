@echo off
echo ========================================
echo Manual Git Commands for v1.7.1
echo ========================================
echo.

echo If the automatic Git commands don't work, run these manually:
echo.

echo Step 1: Add all files
echo git add .
echo.

echo Step 2: Commit changes
echo git commit -m "Release v1.7.1: Fixed usage examples and corrected Mail facade methods"
echo.

echo Step 3: Push to GitHub
echo git push origin main
echo.

echo Step 4: Create version tag
echo git tag -a v1.7.1 -m "v1.7.1 - Fixed usage examples and corrected Mail facade methods"
echo.

echo Step 5: Push version tag
echo git push origin v1.7.1
echo.

echo ========================================
echo Copy and paste these commands one by one:
echo ========================================
echo.
echo git add .
echo.
echo git commit -m "Release v1.7.1: Fixed usage examples and corrected Mail facade methods"
echo.
echo git push origin main
echo.
echo git tag -a v1.7.1 -m "v1.7.1 - Fixed usage examples and corrected Mail facade methods"
echo.
echo git push origin v1.7.1
echo.
echo ========================================
echo What's New in v1.7.1:
echo ========================================
echo.
echo ✅ FIXED: Incorrect Mail facade usage examples
echo ✅ CORRECTED: html() and text() method usage
echo ✅ ADDED: Proper raw() method examples
echo ✅ IMPROVED: Test command with correct email sending
echo ✅ ENHANCED: Troubleshooting for usage errors
echo ✅ CLARIFIED: Correct vs incorrect usage patterns
echo ✅ ADDED: Multiple usage method examples
echo ✅ FIXED: "Method html() does not exist" error guidance
echo.
echo ========================================
echo After running these commands:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Find your package: mertcanaydin97/laravel-phpmailer-driver
echo 3. The new version should auto-update
echo 4. If not, manually trigger update
echo.
echo ========================================
echo This Version Should Finally Work!
echo ========================================
echo.
echo The usage issues are now resolved.
echo Users get correct examples and proper guidance.
echo The "Method html() does not exist" error should be fixed! 🚀
echo.
pause 