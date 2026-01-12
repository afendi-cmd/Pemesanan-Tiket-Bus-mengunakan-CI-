<?php

namespace App\Controllers;
use App\Models\JenisbusModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jenisbus extends BaseController
{
    protected $jenisbusModel;

    public function __construct()
    {
        $this->jenisbusModel = new JenisbusModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        $data['jenisbus'] = $this->jenisbusModel->findAll();
        return view('jenisbus/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nama_jenisbus' => $this->request->getPost('nama_jenisbus')
        ];

        if ($id) {
            $this->jenisbusModel->update($id, $data);
            log_update('Jenis Bus', $id);
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
        } else {
            $insertId = $this->jenisbusModel->insert($data);
            log_create('Jenis Bus', $insertId);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        }

        return redirect()->to('/jenisbus');
    }

    public function delete($id)
    {
        log_delete('Jenis Bus', $id);
        $this->jenisbusModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/jenisbus');
    }

    public function getJenisbus($id)
    {
        $data = $this->jenisbusModel->find($id);
        return $this->response->setJSON($data);
    }
}
