# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-01-12

### 🎉 Major Release: User Logs System

### Added

- **Complete User Logs System**

  - New `user_logs` table with comprehensive tracking
  - Auto-logging for all CRUD operations across 12 controllers
  - Login/logout activity monitoring
  - User identification by ID, email, and full name
  - IP address and browser tracking
  - Real-time admin dashboard for log management

- **Database Changes**

  - `user_logs` table with 9 columns
  - Migration files for version control
  - Email and user_name column additions

- **New Controllers**

  - `UserLogsController` - Admin log management
  - `TestLog` - Basic logging tests
  - `TestLogin` - Login logging tests
  - `TestUserName` - Username functionality tests
  - `AddColumn` - Database column management

- **Helper System**

  - `log_helper.php` - Core logging functions
  - `user_helper.php` - User data extraction
  - Auto-load configuration for helpers

- **Admin Interface**

  - Real-time log monitoring dashboard
  - AJAX-powered filtering and search
  - Activity badges and user-friendly display
  - Responsive design with Bootstrap 5

- **Documentation**
  - Complete user logs documentation
  - Implementation guides
  - GitHub update instructions
  - Testing procedures

### Changed

- **All CRUD Controllers Updated**

  - `Login.php` - Added login/logout tracking
  - `Bus.php` - Added CRUD logging
  - `Jabatan.php` - Added CRUD logging
  - `Jenisbus.php` - Added CRUD logging
  - `Karyawan.php` - Added CRUD logging
  - `Penyewa.php` - Added CRUD logging
  - `Paketwisata.php` - Added CRUD logging
  - `PaketBus.php` - Added CRUD logging
  - `Pemesanan.php` - Added booking and payment logging
  - `PemesananDetail.php` - Added detail logging
  - `Pembayaran.php` - Added payment logging
  - `Pemberangkatan.php` - Added departure logging

- **Configuration Updates**

  - `Autoload.php` - Added helper auto-loading
  - `Routes.php` - Added new routes for logging system

- **Database Structure**
  - `db_projek.sql` - Updated with user_logs table

### Security

- IP address tracking for all activities
- User agent logging for security monitoring
- Session-based user identification
- Secure logging without exposing sensitive data

### Performance

- Optimized database queries for log retrieval
- AJAX-based real-time updates
- Efficient helper functions with caching
- Minimal performance impact on existing operations

---

## [1.0.0] - 2025-10-20

### 🚀 Initial Release

### Added

- **Core Bus Rental System**

  - Complete bus fleet management
  - Employee and customer management
  - Tour package system
  - Booking and reservation system
  - Payment processing
  - Departure scheduling

- **Database Structure**

  - 11 core tables with relationships
  - Migration system setup
  - Sample data included

- **User Interface**

  - Responsive design with Bootstrap
  - Admin dashboard
  - Customer portal
  - Reporting system

- **Authentication System**

  - Multi-role login (Admin, Employee, Customer)
  - Session management
  - Password hashing

- **Reporting Features**
  - Comprehensive reports for all modules
  - PDF generation
  - Date range filtering

### Technical Details

- CodeIgniter 4.6.3 framework
- MySQL database
- Bootstrap 5 UI
- PHP 8.0+ compatibility

---

## [Unreleased]

### Planned Features

- Email notifications for bookings
- SMS integration for reminders
- Advanced reporting with charts
- Mobile app API
- Multi-language support
- Advanced user permissions

---

## Version History

- **v2.0.0** - User Logs System (Current)
- **v1.0.0** - Initial Bus Rental System

---

## Migration Notes

### From v1.0.0 to v2.0.0

1. Run database migrations: `php spark migrate`
2. Update helper configuration in `Autoload.php`
3. Clear cache if needed: `php spark cache:clear`
4. Test logging functionality with provided test controllers

### Breaking Changes

- None. All existing functionality preserved.
- New logging system is additive and non-intrusive.

---

## Contributors

- **Ronal Afendi** - Lead Developer
- **Contributors** - Testing and feedback

---

## Support

For support and questions:

- GitHub Issues: [Create an issue](https://github.com/yourusername/bus-rental-system/issues)
- Email: mronal.afendi04@gmail.com

---

**Note**: This changelog follows [Keep a Changelog](https://keepachangelog.com/) format for better readability and maintenance.
