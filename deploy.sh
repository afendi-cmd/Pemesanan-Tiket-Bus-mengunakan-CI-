#!/bin/bash

# 🚀 Bus Rental System - Deployment Script
# This script helps deploy the User Logs System to GitHub

echo "🚀 Bus Rental System - GitHub Deployment"
echo "========================================"

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "❌ Git repository not found. Initializing..."
    git init
    echo "✅ Git repository initialized"
fi

# Check git status
echo "📊 Checking git status..."
git status

# Add all files
echo "📁 Adding all files to git..."
git add .

# Show what will be committed
echo "📋 Files to be committed:"
git diff --cached --name-only

# Commit with comprehensive message
echo "💾 Creating commit..."
git commit -m "feat: Implement comprehensive User Logs system v2.0.0

✨ Major Features Added:
- Complete user activity logging system
- Auto-tracking for all CRUD operations in 12 controllers
- Login/logout monitoring with email & username identification
- Real-time admin dashboard with filtering and AJAX
- Helper functions for easy implementation
- Comprehensive testing suite

📊 Database Changes:
- New user_logs table with 9 columns (id, user_id, email, user_name, activity, description, ip_address, user_agent, created_at)
- 3 migration files for version control
- Updated database SQL structure

🎯 Controllers Enhanced:
- Login: Authentication tracking with email/username
- All CRUD controllers: Auto-logging for create/update/delete operations
- New controllers: UserLogsController, TestLog, TestLogin, TestUserName, AddColumn

🔧 System Improvements:
- Helper functions: log_helper.php, user_helper.php with auto-load
- Security tracking: IP address and browser information
- User identification: ID, email, and full name tracking
- Error handling and performance optimization

📱 User Interface:
- Admin logs dashboard with real-time monitoring
- AJAX-powered filtering and search functionality
- Responsive design with Bootstrap 5 and activity badges
- User-friendly log display with comprehensive information

🧪 Testing & Documentation:
- Multiple test controllers for validation
- Complete documentation with implementation guides
- GitHub deployment instructions
- Comprehensive changelog and README

📁 Files Added/Modified:
- 20+ new files including migrations, models, controllers, views
- 15+ existing files updated with logging functionality
- Complete documentation suite with guides and examples

🔐 Security & Performance:
- Secure logging without exposing sensitive data
- Optimized database queries with minimal performance impact
- Session-based user identification with fallback mechanisms
- IP and browser tracking for security monitoring"

# Check if remote exists
if git remote get-url origin > /dev/null 2>&1; then
    echo "🌐 Remote repository found"
else
    echo "❓ No remote repository found. Please add your GitHub repository:"
    echo "   git remote add origin https://github.com/yourusername/bus-rental-system.git"
    read -p "Enter your GitHub repository URL: " repo_url
    if [ ! -z "$repo_url" ]; then
        git remote add origin "$repo_url"
        echo "✅ Remote repository added"
    fi
fi

# Push to GitHub
echo "🚀 Pushing to GitHub..."
git push -u origin main

# Create and push tag
echo "🏷️ Creating version tag..."
git tag -a v2.0.0 -m "Release v2.0.0: Complete User Logs System

🎉 Major Release Features:
✨ Comprehensive user activity logging with real-time monitoring
📊 Auto-tracking for all CRUD operations across the system
🔐 Login/logout monitoring with complete user identification
👤 User tracking by ID, email, and full name
🌐 Security monitoring with IP and browser information
🎯 Admin dashboard with filtering and AJAX functionality
🧪 Complete testing suite with validation controllers
📚 Comprehensive documentation and implementation guides

Technical Highlights:
- New user_logs table with 9 comprehensive columns
- 12 controllers updated with automatic logging
- Helper functions for easy implementation
- Migration files for database version control
- Real-time admin interface with Bootstrap 5
- AJAX-powered filtering and search capabilities
- Optimized performance with minimal system impact
- Complete security tracking and monitoring

This release transforms the bus rental system into a fully auditable application with comprehensive user activity tracking and monitoring capabilities."

git push origin v2.0.0

echo ""
echo "🎉 Deployment completed successfully!"
echo ""
echo "📋 Next Steps:"
echo "1. Visit your GitHub repository to verify the upload"
echo "2. Create a release from the v2.0.0 tag"
echo "3. Update the repository description and topics"
echo "4. Add screenshots to the repository"
echo "5. Configure GitHub Pages if needed"
echo ""
echo "🔗 Useful URLs after deployment:"
echo "- Repository: https://github.com/yourusername/bus-rental-system"
echo "- Releases: https://github.com/yourusername/bus-rental-system/releases"
echo "- Issues: https://github.com/yourusername/bus-rental-system/issues"
echo ""
echo "📚 Documentation files created:"
echo "- README.md - Main project documentation"
echo "- CHANGELOG.md - Version history and changes"
echo "- USER_LOGS_DOCUMENTATION.md - User logs system guide"
echo "- GITHUB_UPDATE_GUIDE.md - Deployment instructions"
echo ""
echo "✅ Your Bus Rental System with User Logs is now on GitHub!"