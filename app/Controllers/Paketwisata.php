<?php

namespace App\Controllers;
use App\Models\PaketWisataModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Paketwisata extends BaseController
{
    protected $paketWisataModel;
   

    public function __construct()
    {
        $this->paketWisataModel = new PaketWisataModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        $data['paketwisata'] = $this->paketWisataModel->getPaketWisata();
        return view('paketwisata/index', $data);
    }
    public function save()
    {
        $id = $this->request->getPost('id');         
          $data = [
            'nama_paket' => $this->request->getPost('nama_paket'),
            'tujuan' => $this->request->getPost('tujuan'),
            'harga' => $this->request->getPost('harga'),
    
        ];
      
        if ($id) {
            $this->paketWisataModel->update($id, $data);
            log_update('Paket Wisata', $id);
            session()->setFlashdata('success', 'Data paket wisata berhasil diperbarui.');
        } else {
            $insertId = $this->paketWisataModel->insert($data);
            log_create('Paket Wisata', $insertId);
            session()->setFlashdata('success', 'Data paket wisata berhasil ditambahkan.');
        }

        return redirect()->to('/paketwisata');
    }

    public function delete($id)
    {
        log_delete('Paket Wisata', $id);
        $this->paketWisataModel->delete($id);
        session()->setFlashdata('success', 'Data paket wisata berhasil dihapus.');
        return redirect()->to('/paketwisata');
    }

    public function getPaketWisata($id)
    {
        $data = $this->paketWisataModel->find($id);
        return $this->response->setJSON($data);
    }
}
