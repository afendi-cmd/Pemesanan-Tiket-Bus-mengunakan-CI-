<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\UserLogger;

class Login extends BaseController
{
    protected $userLogger;

    public function __construct()
    {
        $this->userLogger = new UserLogger();
    }

    public function index()
    {
        helper(['form', 'log']); // Tambahkan 'log' helper
        echo view('login_view');
    }

    public function authenticate()
    {
        helper(['form', 'log']); // Tambahkan 'log' helper
        $session = session();
        $request = service('request');

        $identifier = $request->getPost('identifier');
        $password   = $request->getPost('password');

        if (empty($identifier) || empty($password)) {
            return redirect()->back()->with('error', 'Masukkan email dan password.');
        }

        $userModel = new UserModel();
        $user = $userModel->findUserByCredential($identifier);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $stored = $user['password'] ?? null;

        // Jika tidak ada password yang disimpan dan sumbernya
        $verified = $userModel->verifyPassword($stored, $password);

        if (!$verified) {
            // Log failed login attempt dengan email yang dicoba
            save_log('Login Gagal', 'Mencoba login dengan password salah', null, $identifier, null);
            return redirect()->back()->with('error', 'Password salah.');
        }

        // Set session
        $session->set([
            'isLoggedIn'     => true,
            'userSource'     => $user['source'],
            'userId'         => $user['id'],
            'userData'       => $user['data'],
            'last_activity'  => time()
        ]);

        // Log successful login dengan email dan nama dari user data
        $userEmail = $user['email'] ?? $identifier;
        $userName = $user['nama_karyawan'] ?? $user['nama_penyewa'] ?? null;
        save_log('Login', 'User berhasil login ke sistem', $user['id'], $userEmail, $userName);
        $this->userLogger->logLogin($user['id'], $userEmail);

        return redirect()->to(site_url('login/dashboard'));
    }

    public function dashboard()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        $data['user'] = $session->get('userData');
        echo view('dashboard', $data);
    }

    public function logout()
    {
        helper(['log']); // Tambahkan 'log' helper
        $session = session();
        $userId = $session->get('userId');
        $userData = $session->get('userData');
        
        // Ambil email dan nama dari userData
        $userEmail = null;
        $userName = null;
        if (is_array($userData)) {
            $userEmail = $userData['email'] ?? null;
            $userName = $userData['nama_karyawan'] ?? $userData['nama_penyewa'] ?? null;
        }
        
        // Log logout dengan email dan nama
        save_log('Logout', 'User keluar dari sistem', $userId, $userEmail, $userName);
        if ($userId) {
            $this->userLogger->logLogout($userId);
        }
        
        $session->destroy();

        session()->setFlashdata(
            'error',
            'Session Anda telah habis, silakan login kembali.'
        );

        return redirect()->to(site_url('login'));
    }

    protected function checkLogin()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(site_url('login/logout'));
        }
    }
}