<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\PemesananModel;
use App\Controllers\BaseController;

class Pembayaran extends BaseController
{
    protected $pembayaranModel;
    protected $pemesananModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->pemesananModel = new PemesananModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;

        $data['pembayaran'] = $this->pembayaranModel->getPembayaranWithPemesanan();
        $data['pemesanan'] = $this->pemesananModel->findAll();

        return view('pembayaran/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'id_pemesanan'  => $this->request->getPost('id_pemesanan'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'jumlah_bayar'  => $this->request->getPost('jumlah_bayar'),
            'metode_bayar'  => $this->request->getPost('metode_bayar')
        ];

        if ($id) {
            $this->pembayaranModel->update($id, $data);
            session()->setFlashdata('success', 'Data pembayaran berhasil diperbarui.');
        } else {
            $this->pembayaranModel->insert($data);
            session()->setFlashdata('success', 'Data pembayaran berhasil ditambahkan.');
        }

        return redirect()->to('/pembayaran');
    }

    public function delete($id)
    {
        $this->pembayaranModel->delete($id);
        session()->setFlashdata('success', 'Data pembayaran berhasil dihapus.');
        return redirect()->to('/pembayaran');
    }

    public function getPembayaran($id)
    {
        $data = $this->pembayaranModel->find($id);
        return $this->response->setJSON($data);
    }
}
