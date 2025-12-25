<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\JabatanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Karyawan extends BaseController
{
     protected $karyawanModel;
    protected $jabatanModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;

        $data['karyawan'] = $this->karyawanModel->getWithJabatan();
        $data['jabatan'] = $this->jabatanModel->findAll();
        return view('karyawan/index', $data);
    }

   public function save()
{
    $id = $this->request->getPost('idkaryawan');

    // Data umum
    $data = [
        'idjabatan'     => $this->request->getPost('idjabatan'),
        'nik_karyawan'  => $this->request->getPost('nik_karyawan'),
        'nama_karyawan' => $this->request->getPost('nama_karyawan'),
        'alamat'        => $this->request->getPost('alamat'),
        'nohp'          => $this->request->getPost('nohp'),
        'email'         => $this->request->getPost('email')
    ];

    // Ambil password
    $pwd = $this->request->getPost('password');

    // Jika password diisi, hash dan simpan
    if (!empty($pwd)) {
        $data['password'] = password_hash($pwd, PASSWORD_DEFAULT);
    }

    // Jika update
    if ($id) {
        $this->karyawanModel->update($id, $data);
        session()->setFlashdata('success', 'Data karyawan berhasil diperbarui.');
    } 
    // Jika insert baru
    else {
        $this->karyawanModel->insert($data);
        session()->setFlashdata('success', 'Data karyawan berhasil ditambahkan.');
    }

    return redirect()->to('/karyawan');
}


    public function delete($id)
    {
        $this->karyawanModel->delete($id);
        session()->setFlashdata('success', 'Data karyawan berhasil dihapus.');
        return redirect()->to('/karyawan');
    }

    public function getKaryawan($id)
    {
        $data = $this->karyawanModel->find($id);
        return $this->response->setJSON($data);
    }



}
