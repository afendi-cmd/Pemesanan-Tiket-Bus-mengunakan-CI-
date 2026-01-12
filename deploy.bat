@echo off
echo 🚀 Bus Rental System - GitHub Deployment
echo ========================================

REM Check if git is initialized
if not exist ".git" (
    echo ❌ Git repository not found. Initializing...
    git init
    echo ✅ Git repository initialized
)

REM Check git status
echo 📊 Checking git status...
git status

REM Add all files
echo 📁 Adding all files to git...
git add .

REM Show what will be committed
echo 📋 Files to be committed:
git diff --cached --name-only

REM Commit with comprehensive message
echo 💾 Creating commit...
git commit -m "feat: Implement comprehensive User Logs system v2.0.0

✨ Major Features Added:
- Complete user activity logging system
- Auto-tracking for all CRUD operations in 12 controllers
- Login/logout monitoring with email & username identification
- Real-time admin dashboard with filtering and AJAX
- Helper functions for easy implementation
- Comprehensive testing suite

📊 Database Changes:
- New user_logs table with 9 columns
- 3 migration files for version control
- Updated database SQL structure

🎯 Controllers Enhanced:
- Login: Authentication tracking
- All CRUD controllers: Auto-logging
- New test and management controllers

🔧 System Improvements:
- Helper functions with auto-load
- Security and performance optimization
- Complete documentation suite

📱 User Interface:
- Admin dashboard with real-time monitoring
- AJAX-powered filtering and search
- Responsive Bootstrap 5 design

🧪 Testing & Documentation:
- Multiple test controllers
- Complete implementation guides
- Comprehensive changelog and README"

REM Check if remote exists
git remote get-url origin >nul 2>&1
if errorlevel 1 (
    echo ❓ No remote repository found. Please add your GitHub repository:
    echo    git remote add origin https://github.com/yourusername/bus-rental-system.git
    set /p repo_url="Enter your GitHub repository URL: "
    if not "!repo_url!"=="" (
        git remote add origin "!repo_url!"
        echo ✅ Remote repository added
    )
)

REM Push to GitHub
echo 🚀 Pushing to GitHub...
git push -u origin main

REM Create and push tag
echo 🏷️ Creating version tag...
git tag -a v2.0.0 -m "Release v2.0.0: Complete User Logs System"
git push origin v2.0.0

echo.
echo 🎉 Deployment completed successfully!
echo.
echo 📋 Next Steps:
echo 1. Visit your GitHub repository to verify the upload
echo 2. Create a release from the v2.0.0 tag
echo 3. Update the repository description and topics
echo 4. Add screenshots to the repository
echo.
echo ✅ Your Bus Rental System with User Logs is now on GitHub!

pause