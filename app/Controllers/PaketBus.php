<?php

namespace App\Controllers;
use App\Models\BusModel;
use App\Models\PaketBusModel;
use App\Models\PaketWisataModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PaketBus extends BaseController
{
    protected $paketBusModel;
    protected $paketWisataModel;
    protected $busModel;

    public function __construct()
    {
        $this->paketBusModel = new PaketBusModel();
        $this->paketWisataModel = new PaketWisataModel();
        $this->busModel = new BusModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        // ✅ Tambahkan semua data yang dibutuhkan view
        $data['paketbus'] = $this->paketBusModel->getPaketBusWithDetails();
        $data['bus'] = $this->busModel->findAll();
        $data['paketwisata'] = $this->paketWisataModel->findAll();

        return view('paketbus/index', $data);
    }

    public function save()
{
    $id = $this->request->getPost('idpaketbus');

    $data = [
        'id_paketwisata' => $this->request->getPost('paket_wisata'),
        'id_bus' => $this->request->getPost('bus')
    ];

    if ($id) {
        $this->paketBusModel->update($id, $data);
        log_update('Paket Bus', $id);
        session()->setFlashdata('success', 'Data berhasil diperbarui.');
    } else {
        $insertId = $this->paketBusModel->insert($data);
        log_create('Paket Bus', $insertId);
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
    }

    return redirect()->to('/paketbus');
}

    public function delete($id)
    {
        log_delete('Paket Bus', $id);
        $this->paketBusModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/paketbus');
    }

    public function getPaketBus($id)
    {
        $data = $this->paketBusModel->find($id);
        return $this->response->setJSON($data);
    }
}
