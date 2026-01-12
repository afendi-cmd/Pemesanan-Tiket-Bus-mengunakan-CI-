<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestLogin extends BaseController
{
    public function index()
    {
        // Simulasi test login dengan email dan nama
        $testUserId = 1;
        $testEmail = 'admin@gmail.com';
        $testName = 'Ronal Afendi';
        
        // Test login log dengan email dan nama
        save_log('LOGIN', 'Test login berhasil', $testUserId, $testEmail, $testName);
        
        // Test CRUD dengan auto-detect email dan nama (simulasi session)
        session()->set([
            'userId' => $testUserId,
            'userSource' => 'karyawan',
            'userData' => [
                'email' => $testEmail,
                'nama_karyawan' => $testName
            ]
        ]);
        
        log_create('Test Module', 999);
        log_update('Test Module', 999);
        log_delete('Test Module', 999);
        
        echo "Test login dan CRUD logs dengan user name berhasil dibuat!<br>";
        echo "Cek tabel user_logs untuk melihat hasilnya.<br>";
        echo "<a href='/userlogs'>Lihat Logs</a>";
    }
}