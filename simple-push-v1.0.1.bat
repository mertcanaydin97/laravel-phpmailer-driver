@echo off
echo ========================================
echo SIMPLE PUSH - VERSION 1.0.1
echo ========================================
echo.

echo Step 1: Adding all files...
git add .
echo.

echo Step 2: Committing changes...
git commit -m "Release v1.0.1: Fixed declaration errors"
echo.

echo Step 3: Pushing to GitHub...
git push origin main
echo.

echo Step 4: Creating version tag...
git tag -a v1.0.1 -m "v1.0.1 - Fixed declaration errors"
echo.

echo Step 5: Pushing tag...
git push origin v1.0.1
echo.

echo ========================================
echo 🎉 VERSION 1.0.1 PUSHED!
echo ========================================
echo.
echo ✅ All files committed
echo ✅ Pushed to GitHub
echo ✅ Version tag created
echo ✅ Tag pushed to GitHub
echo.

echo ========================================
echo 🎯 WHAT'S FIXED:
echo ========================================
echo.
echo 🔧 Removed array type declarations
echo 🔧 Better compatibility
echo 🔧 No declaration errors
echo.

echo ========================================
echo 🎯 NEXT STEPS:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Find: mertcanaydin97/laravel-phpmailer-driver
echo 3. Version 1.0.1 should auto-update
echo.

echo ========================================
echo 🎉 DONE!
echo ========================================
echo.
pause 