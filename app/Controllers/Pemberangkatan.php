<?php

namespace App\Controllers;

use App\Models\PemberangkatanModel;
use App\Models\PemesananModel;
use App\Models\BusModel;
use App\Models\KaryawanModel;
use App\Controllers\BaseController;

class Pemberangkatan extends BaseController
{
    protected $pemberangkatanModel;
    protected $pemesananModel;
    protected $busModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->pemberangkatanModel = new PemberangkatanModel();
        $this->pemesananModel = new PemesananModel();
        $this->busModel = new BusModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        
        $data['pemberangkatan'] = $this->pemberangkatanModel->getPemberangkatanWithDetails();
        $data['pemesanan'] = $this->pemesananModel->findAll();
        $data['bus'] = $this->busModel->findAll();

        // hanya ambil sopir dan kernet berdasarkan jabatan
        $data['sopir'] = $this->karyawanModel->where('idjabatan', 7)->findAll();   // id 7 = Sopir
        $data['kernet'] = $this->karyawanModel->where('idjabatan', 6)->findAll();  // id 6 = Kernet


        return view('/pemberangkatan/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('idberangkat');

        $data = [
            'idpemesanan' => $this->request->getPost('idpemesanan'),
            'idbus' => $this->request->getPost('idbus'),
            'idsopir' => $this->request->getPost('idsopir'),
            'idkernet' => $this->request->getPost('idkernet'),
            'tanggalberangkat' => $this->request->getPost('tanggalberangkat')
        ];

        if ($id) {
            $this->pemberangkatanModel->update($id, $data);
            session()->setFlashdata('success', 'Data pemberangkatan berhasil diperbarui.');
        } else {
            $this->pemberangkatanModel->insert($data);
            session()->setFlashdata('success', 'Data pemberangkatan berhasil ditambahkan.');
        }

        return redirect()->to('/pemberangkatan');
    }

    public function delete($id)
    {
        $this->pemberangkatanModel->delete($id);
        session()->setFlashdata('success', 'Data pemberangkatan berhasil dihapus.');
        return redirect()->to('/pemberangkatan');
    }

    public function getPemberangkatan($id)
    {
        $data = $this->pemberangkatanModel->find($id);
        return $this->response->setJSON($data);
    }
}
