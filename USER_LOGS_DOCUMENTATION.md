# User Logs System Documentation

## Overview

Sistem User Logs telah berhasil ditambahkan ke aplikasi untuk mencatat semua aktivitas pengguna. Sistem ini terdiri dari:

1. **Database Table**: `user_logs`
2. **Migration**: `2025-01-12-140000_UserLogs.php`
3. **Model**: `UserLogsModel.php`
4. **Library**: `UserLogger.php`
5. **Helper**: `log_helper.php` (NEW - Cara termudah!)
6. **Controller**: `UserLogsController.php`
7. **View**: `admin/user_logs.php`

## Database Structure

Tabel `user_logs` memiliki struktur sebagai berikut:

```sql
CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text,
  `ip_address` varchar(45),
  `user_agent` varchar(255),
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

## Cara Penggunaan (MUDAH!)

### 1. Menggunakan Helper Functions (RECOMMENDED)

Ini adalah cara termudah untuk menambahkan logging ke controller Anda:

```php
public function someMethod()
{
    helper(['log']); // Load log helper

    // Log berbagai aktivitas dengan mudah
    save_log('LOGIN', 'User berhasil login');
    save_log('LOGOUT', 'User keluar dari sistem');
    save_log('CREATE', 'Menambah data bus baru');

    // Atau gunakan fungsi khusus
    log_create('Bus', $recordId);
    log_update('Bus', $recordId);
    log_delete('Bus', $recordId);
    log_login($userId, 'user@email.com');
    log_logout($userId);
}
```

### 2. Implementasi di Controller (Contoh Real)

```php
<?php

namespace App\Controllers;

class YourController extends BaseController
{
    public function save()
    {
        helper(['log']); // Load helper

        $id = $this->request->getPost('id');

        $data = [
            // your data here
        ];

        if ($id) {
            // Update
            $this->model->update($id, $data);
            log_update('ModuleName', $id); // Otomatis ambil user dari session
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
        } else {
            // Create
            $insertId = $this->model->insert($data);
            log_create('ModuleName', $insertId); // Otomatis ambil user dari session
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        helper(['log']); // Load helper

        log_delete('ModuleName', $id); // Log sebelum hapus

        $this->model->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
```

### 3. Implementasi di Login Controller

```php
public function authenticate()
{
    helper(['log']);

    // ... validation code ...

    if (!$verified) {
        save_log('Login Gagal', 'Mencoba login dengan password salah');
        return redirect()->back()->with('error', 'Password salah.');
    }

    // Set session
    $session->set([...]);

    // Log successful login
    save_log('Login', 'User berhasil login ke sistem');

    return redirect()->to('dashboard');
}

public function logout()
{
    helper(['log']);

    save_log('Logout', 'User keluar dari sistem');

    session()->destroy();
    return redirect()->to('login');
}
```

## Helper Functions Available

| Function                                                | Description          | Example                                 |
| ------------------------------------------------------- | -------------------- | --------------------------------------- |
| `save_log($activity, $description, $userId = null)`     | Log aktivitas umum   | `save_log('LOGIN', 'User login')`       |
| `log_activity($activity, $description, $userId = null)` | Alias untuk save_log | `log_activity('EXPORT', 'Export data')` |
| `log_login($userId, $email = null)`                     | Log login            | `log_login($userId, 'user@email.com')`  |
| `log_logout($userId)`                                   | Log logout           | `log_logout($userId)`                   |
| `log_create($module, $recordId = null, $userId = null)` | Log create           | `log_create('Bus', $insertId)`          |
| `log_update($module, $recordId = null, $userId = null)` | Log update           | `log_update('Bus', $id)`                |
| `log_delete($module, $recordId = null, $userId = null)` | Log delete           | `log_delete('Bus', $id)`                |
| `get_user_logs($userId, $limit = 50)`                   | Ambil log user       | `get_user_logs($userId, 100)`           |
| `get_recent_logs($limit = 100)`                         | Ambil log terbaru    | `get_recent_logs(50)`                   |

## Routes

```php
// Admin view - semua logs
$routes->get('/userlogs', 'UserLogsController::index');

// User view - logs pribadi
$routes->get('/userlogs/my', 'UserLogsController::myLogs');

// AJAX endpoint untuk filter logs
$routes->get('/userlogs/getLogs', 'UserLogsController::getLogs');

// Test logging
$routes->get('/userlogs/test', 'UserLogsController::testLog');
```

## Activity Types

- **LOGIN**: User login ke sistem
- **LOGOUT**: User logout dari sistem
- **REGISTER**: Registrasi user baru
- **CREATE**: Membuat data baru
- **UPDATE**: Mengupdate data
- **DELETE**: Menghapus data
- **LOGIN GAGAL**: Percobaan login yang gagal
- **EXPORT**: Export data
- **IMPORT**: Import data
- **Custom**: Aktivitas lainnya

## Implementasi yang Sudah Dilakukan

### 1. Login Controller ✅

- Log aktivitas login berhasil
- Log aktivitas logout
- Log percobaan login gagal

### 2. Bus Controller ✅

- Log aktivitas CREATE saat menambah bus baru
- Log aktivitas UPDATE saat mengupdate data bus
- Log aktivitas DELETE saat menghapus data bus

## Cara Menambahkan ke Controller Lain

**SUPER MUDAH! Hanya 3 langkah:**

1. **Tambahkan helper di method yang perlu logging**:

```php
helper(['log']);
```

2. **Tambahkan log di tempat yang tepat**:

```php
// Untuk CREATE
$insertId = $this->model->insert($data);
log_create('NamaModule', $insertId);

// Untuk UPDATE
$this->model->update($id, $data);
log_update('NamaModule', $id);

// Untuk DELETE
log_delete('NamaModule', $id); // Log dulu sebelum hapus
$this->model->delete($id);
```

3. **Selesai!** Helper akan otomatis:
   - Ambil user ID dari session
   - Catat IP address
   - Catat user agent
   - Catat timestamp

## Keunggulan Helper Function

1. **Mudah digunakan** - Hanya perlu 1 baris kode
2. **Otomatis** - Ambil user ID, IP, user agent otomatis
3. **Fleksibel** - Bisa override user ID jika perlu
4. **Error handling** - Tidak akan crash aplikasi jika ada error
5. **Kompatibel** - Bekerja dengan kode yang sudah ada

## Viewing Logs

### Admin View

Akses `/userlogs` untuk melihat semua aktivitas sistem dengan fitur:

- Filter berdasarkan jenis aktivitas
- Filter berdasarkan user ID
- Tampilan real-time dengan AJAX
- Badge warna untuk setiap jenis aktivitas

### User View

Akses `/userlogs/my` untuk melihat aktivitas pribadi user yang sedang login.

## Migration

```bash
php spark migrate
```

## Contoh Implementasi Lengkap

```php
<?php

namespace App\Controllers;

class Karyawan extends BaseController
{
    public function save()
    {
        helper(['log']); // 1. Load helper

        $id = $this->request->getPost('id');

        $data = [
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'email' => $this->request->getPost('email'),
            // ... data lainnya
        ];

        if ($id) {
            $this->karyawanModel->update($id, $data);
            log_update('Karyawan', $id); // 2. Log update
            session()->setFlashdata('success', 'Data karyawan berhasil diperbarui.');
        } else {
            $insertId = $this->karyawanModel->insert($data);
            log_create('Karyawan', $insertId); // 2. Log create
            session()->setFlashdata('success', 'Data karyawan berhasil ditambahkan.');
        }

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        helper(['log']); // 1. Load helper

        log_delete('Karyawan', $id); // 2. Log delete (sebelum hapus)

        $this->karyawanModel->delete($id);
        session()->setFlashdata('success', 'Data karyawan berhasil dihapus.');
        return redirect()->to('/karyawan');
    }
}
```

**Selesai! Hanya dengan 2 baris kode tambahan, semua aktivitas CRUD sudah tercatat otomatis.**
