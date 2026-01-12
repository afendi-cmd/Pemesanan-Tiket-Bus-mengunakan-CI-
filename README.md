# 🚌 Bus Rental Management System with User Logs

Sistem manajemen rental bus dengan fitur logging aktivitas user yang komprehensif, dibangun menggunakan CodeIgniter 4.

## ✨ Features

### 🎯 Core Features

- **Bus Management**: Kelola armada bus dan jenis bus
- **Employee Management**: Manajemen karyawan dan jabatan
- **Customer Management**: Registrasi dan manajemen penyewa
- **Package Management**: Paket wisata dan paket bus
- **Booking System**: Sistem pemesanan dengan validasi ketersediaan
- **Payment System**: Manajemen pembayaran dan bukti transfer
- **Departure Management**: Penjadwalan keberangkatan
- **Reporting**: Laporan lengkap untuk semua modul

### 📊 User Logs System (NEW!)

- **Complete Activity Tracking**: Semua aktivitas user tercatat otomatis
- **Login/Logout Monitoring**: Tracking autentikasi dengan email & nama
- **CRUD Auto-Logging**: Logging otomatis untuk semua operasi create/update/delete
- **User Identification**: Tracking berdasarkan ID, email, dan nama lengkap
- **Security Monitoring**: IP address dan informasi browser
- **Admin Dashboard**: Interface real-time untuk monitoring logs
- **Advanced Filtering**: Filter logs berdasarkan aktivitas dan user

## 🛠️ Tech Stack

- **Framework**: CodeIgniter 4.6.3
- **Database**: MySQL/MariaDB
- **Frontend**: Bootstrap 5, JavaScript (AJAX)
- **PHP Version**: 8.0+
- **Web Server**: Apache/Nginx

## 📋 Requirements

- PHP 8.0 atau lebih tinggi
- MySQL 5.7+ atau MariaDB 10.3+
- Apache/Nginx web server
- Composer
- Git

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/bus-rental-system.git
cd bus-rental-system
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Edit database configuration
nano .env
```

Configure your database settings:

```env
database.default.hostname = localhost
database.default.database = db_projek
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
```

### 4. Database Setup

```bash
# Import database
mysql -u username -p db_projek < db_projek.sql

# Or run migrations
php spark migrate
```

### 5. Set Permissions

```bash
chmod -R 755 writable/
chmod -R 755 public/
```

### 6. Start Development Server

```bash
php spark serve
```

Visit: `http://localhost:8080`

## 📊 Database Structure

### Core Tables

- `jabatan` - Job positions
- `karyawan` - Employees
- `penyewa` - Customers
- `jenisbus` - Bus types
- `bus` - Bus fleet
- `paket_wisata` - Tour packages
- `paket_bus` - Bus packages
- `pemesanan` - Bookings
- `pemesanan_detail` - Booking details
- `pembayaran` - Payments
- `pemberangkatan` - Departures

### User Logs Table (NEW!)

```sql
CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text,
  `ip_address` varchar(45),
  `user_agent` varchar(255),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
```

## 🎯 User Logs System Usage

### Automatic Logging

Sistem secara otomatis mencatat:

- ✅ Login/Logout activities
- ✅ All CRUD operations (Create, Update, Delete)
- ✅ User information (ID, email, name)
- ✅ Security data (IP address, browser)

### Manual Logging

```php
// Basic logging
save_log('CUSTOM_ACTION', 'Description of action');

// CRUD logging
log_create('ModuleName', $recordId);
log_update('ModuleName', $recordId);
log_delete('ModuleName', $recordId);

// With specific user info
save_log('ACTION', 'Description', $userId, $email, $userName);
```

### View Logs

- **Admin Dashboard**: `/userlogs` - View all system logs
- **User Logs**: `/userlogs/my` - View personal activity logs
- **API Endpoint**: `/userlogs/getLogs` - AJAX endpoint for filtering

## 🔐 Default Login Credentials

### Admin (Karyawan)

- **Email**: admin@gmail.com
- **Password**: admin123

### Customer (Penyewa)

- **Email**: penyewa@gmail.com
- **Password**: penyewa123

## 📱 Screenshots

### Dashboard

![Dashboard](public/images/dashboard.png)

### User Logs Admin View

![User Logs](public/images/user-logs.png)

### Bus Management

![Bus Management](public/images/bus-management.png)

## 🧪 Testing

### Test User Logs System

```bash
# Test basic logging
http://localhost:8080/testlog

# Test login logging
http://localhost:8080/testlogin

# Test username functionality
http://localhost:8080/testusername

# Add database column (if needed)
http://localhost:8080/addcolumn
```

### Run Unit Tests

```bash
php spark test
```

## 📚 Documentation

- [User Logs Documentation](USER_LOGS_DOCUMENTATION.md)
- [Email Logging Update](EMAIL_LOGGING_UPDATE.md)
- [User Name Logging Update](USER_NAME_LOGGING_UPDATE.md)
- [Implementation Summary](LOGGING_IMPLEMENTATION_SUMMARY.md)
- [GitHub Update Guide](GITHUB_UPDATE_GUIDE.md)

## 🔧 Development

### Adding Logging to New Controllers

```php
// 1. Add to controller method
public function save() {
    // Your existing code...

    if ($id) {
        $this->model->update($id, $data);
        log_update('ModuleName', $id);
    } else {
        $insertId = $this->model->insert($data);
        log_create('ModuleName', $insertId);
    }
}

public function delete($id) {
    log_delete('ModuleName', $id);
    $this->model->delete($id);
}
```

### Helper Functions Available

- `save_log($activity, $description, $userId, $email, $userName)`
- `log_create($module, $recordId, $userId)`
- `log_update($module, $recordId, $userId)`
- `log_delete($module, $recordId, $userId)`
- `get_user_email($userId)`
- `get_user_name($userId)`

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **Ronal Afendi** - _Initial work_ - [YourGitHub](https://github.com/yourusername)

## 🙏 Acknowledgments

- CodeIgniter 4 Framework
- Bootstrap 5 for UI components
- Font Awesome for icons
- Contributors and testers

## 📞 Support

If you have any questions or need help, please:

- Open an issue on GitHub
- Contact: mronal.afendi04@gmail.com

---

## 🎉 Recent Updates

### v2.0.0 - User Logs System

- ✨ Complete user activity logging system
- 📊 Real-time monitoring dashboard
- 🔐 Login/logout tracking with user identification
- 📝 Auto-logging for all CRUD operations
- 🎯 Admin interface with filtering and AJAX
- 🧪 Comprehensive testing suite
- 📚 Full documentation and guides

### v1.0.0 - Initial Release

- 🚌 Complete bus rental management system
- 👥 User management (employees & customers)
- 📦 Package and booking system
- 💰 Payment processing
- 📊 Comprehensive reporting
- 🎨 Responsive UI with Bootstrap

---

**⭐ If you find this project helpful, please give it a star!**
