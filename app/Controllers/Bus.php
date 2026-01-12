<?php

namespace App\Controllers;

use App\Models\BusModel;
use App\Models\JenisbusModel;
use App\Libraries\UserLogger;
use CodeIgniter\Controller;

class Bus extends BaseController
{
    protected $busModel;
    protected $jenisbusModel;
    protected $userLogger;

    public function __construct()
    {
        $this->busModel = new BusModel();
        $this->jenisbusModel = new JenisbusModel();
        $this->userLogger = new UserLogger();
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
        helper(['log']); // Load log helper
        
        $id = $this->request->getPost('id');
        $userId = session()->get('userId');

        $data = [
            'nomor_polisi' => $this->request->getPost('nomor_polisi'),
            'merek' => $this->request->getPost('merek'),
            'kapasitas' => $this->request->getPost('kapasitas'),
            'id_jenisbus' => $this->request->getPost('id_jenisbus')
        ];

        if ($id) {
            $this->busModel->update($id, $data);
            
            // Log update activity using helper
            log_update('Bus', $id, $userId);
            
            session()->setFlashdata('success', 'Data bus berhasil diperbarui.');
        } else {
            $insertId = $this->busModel->insert($data);
            
            // Log create activity using helper
            log_create('Bus', $insertId, $userId);
            
            session()->setFlashdata('success', 'Data bus berhasil ditambahkan.');
        }

        return redirect()->to('/bus');
    }

    public function delete($id)
    {
        helper(['log']); // Load log helper
        
        $userId = session()->get('userId');
        
        // Log delete activity using helper
        log_delete('Bus', $id, $userId);
        
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
