<?php

namespace App\Controllers;

use App\Models\JabatanModel;
use CodeIgniter\Controller;

class Jabatan extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        $data['jabatan'] = $this->jabatanModel->findAll();
        return view('jabatan/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'namajabatan' => $this->request->getPost('namajabatan')
        ];

        if ($id) {
            // Update data
            $this->jabatanModel->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
        } else {
            // Insert data
            $this->jabatanModel->insert($data);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        }

        return redirect()->to('/jabatan');
    }

    public function delete($id)
    {
        $this->jabatanModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/jabatan');
    }

    public function getJabatan($id)
    {
        $data = $this->jabatanModel->find($id);
        return $this->response->setJSON($data);
    }
}
