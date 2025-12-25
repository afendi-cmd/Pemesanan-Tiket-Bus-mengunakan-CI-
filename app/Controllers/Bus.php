<?php

namespace App\Controllers;

use App\Models\BusModel;
use App\Models\JenisbusModel;
use CodeIgniter\Controller;

class Bus extends BaseController
{
    protected $busModel;
    protected $jenisbusModel;

    public function __construct()
    {
        $this->busModel = new BusModel();
        $this->jenisbusModel = new JenisbusModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        
        $data['bus'] = $this->busModel->getWithJenisbus();
        $data['jenisbus'] = $this->jenisbusModel->findAll();
        return view('bus/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nomor_polisi' => $this->request->getPost('nomor_polisi'),
            'merek' => $this->request->getPost('merek'),
            'kapasitas' => $this->request->getPost('kapasitas'),
            'id_jenisbus' => $this->request->getPost('id_jenisbus')
        ];

        if ($id) {
            $this->busModel->update($id, $data);
            session()->setFlashdata('success', 'Data bus berhasil diperbarui.');
        } else {
            $this->busModel->insert($data);
            session()->setFlashdata('success', 'Data bus berhasil ditambahkan.');
        }

        return redirect()->to('/bus');
    }

    public function delete($id)
    {
        $this->busModel->delete($id);
        session()->setFlashdata('success', 'Data bus berhasil dihapus.');
        return redirect()->to('/bus');
    }

    public function getBus($id)
    {
        $data = $this->busModel->find($id);
        return $this->response->setJSON($data);
    }
}
