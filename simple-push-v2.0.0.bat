@echo off
echo ========================================
echo SIMPLE PUSH - VERSION 2.0.0
echo ========================================
echo.

echo Step 1: Adding all files to Git...
git add .
echo.

echo Step 2: Committing changes...
git commit -m "Release v2.0.0: LARAVEL 10+ PERFECT PACKAGE"
echo.

echo Step 3: Pushing to GitHub...
git push origin main
echo.

echo Step 4: Creating version tag...
git tag -a v2.0.0 -m "v2.0.0 - LARAVEL 10+ PERFECT PACKAGE"
echo.

echo Step 5: Pushing tag...
git push origin v2.0.0
echo.

echo ========================================
echo 🎉 VERSION 2.0.0 PUSHED!
echo ========================================
echo.
echo ✅ All files committed
echo ✅ Pushed to GitHub
echo ✅ Version tag created
echo ✅ Tag pushed to GitHub
echo.

echo ========================================
echo 🎯 NEXT STEPS:
echo ========================================
echo.
echo 1. Go to: https://packagist.org
echo 2. Find: mertcanaydin97/laravel-phpmailer-driver
echo 3. Version 2.0.0 should auto-update
echo 4. If not, manually trigger update
echo.

echo ========================================
echo 🎉 DONE!
echo ========================================
echo.
pause 