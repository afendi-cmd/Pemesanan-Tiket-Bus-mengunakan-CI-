<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('login_view');
    }

    public function authenticate()
    {
        helper(['form']);
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
            return redirect()->back()->with('error', 'Password salah.');
        }

        // Set session
       $session->set([
    'isLoggedIn'     => true,
    'userSource'    => $user['source'],
    'userId'        => $user['id'],
    'userData'      => $user['data'],
    'last_activity' => time()
]);

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
    $session = session();
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