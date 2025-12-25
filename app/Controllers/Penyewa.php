<?php

namespace App\Controllers;
use App\Models\PenyewaModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Penyewa extends BaseController
{
  protected $penyewaModel;

    public function __construct()
    {
        $this->penyewaModel = new PenyewaModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        $data['penyewa'] = $this->penyewaModel->findAll();
        return view('penyewa/index', $data);
    }

public function save()
{
    $id = $this->request->getPost('id');

    $data = [
        'nama_penyewa' => $this->request->getPost('nama_penyewa'),
        'alamat'       => $this->request->getPost('alamat'),
        'no_hp'        => $this->request->getPost('no_hp'),
        'email'        => $this->request->getPost('email'),
    ];

    $pwd = $this->request->getPost('password');
    if (!empty($pwd)) {
        $data['password'] = password_hash($pwd, PASSWORD_DEFAULT);
    }

    if ($id) {
        $this->penyewaModel->update($id, $data);
        session()->setFlashdata('success', 'Data penyewa berhasil diperbarui.');
    } else {
        $this->penyewaModel->insert($data);
        // Tambahkan notifikasi sukses registrasi
        session()->setFlashdata('success_register', 'Selamat! Anda berhasil membuat akun. Silahkan login.');
    }

    return redirect()->to('/login'); // arahkan ke halaman login
}



    public function delete($id)
    {
        $this->penyewaModel->delete($id);
        session()->setFlashdata('success', 'Data penyewa berhasil dihapus.');
        return redirect()->to('/penyewa');
    }

    public function getPenyewa($id)
    {
        $data = $this->penyewaModel->find($id);
        return $this->response->setJSON($data);
    }
}
