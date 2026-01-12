<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananDetailModel;
use App\Models\PemesananModel;

class PemesananDetail extends BaseController
{
    protected $detailModel;
    protected $pemesananModel;

    public function __construct()
    {
        $this->detailModel = new PemesananDetailModel();
        $this->pemesananModel = new PemesananModel();
    }

    public function index()
    {
         $login = $this->checkLogin();
        if ($login) return $login;

        $timeout = $this->autoSessionTimeout();
        if ($timeout) return $timeout;
        $data['pemesanan_detail'] = $this->detailModel->getPemesananDetailWithRelations();
        $data['pemesanan'] = $this->pemesananModel->findAll();

        return view('pemesanan_detail/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');

        $data = [
            'id_pemesanan'     => $this->request->getPost('id_pemesanan'),
            'tanggal_berangkat'=> $this->request->getPost('tanggal_berangkat'),
            'tanggal_kembali'  => $this->request->getPost('tanggal_kembali'),
            'jumlah_penumpang' => $this->request->getPost('jumlah_penumpang')
        ];

        if ($id) {
            $this->detailModel->update($id, $data);
            log_update('Pemesanan Detail', $id);
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
        } else {
            $insertId = $this->detailModel->insert($data);
            log_create('Pemesanan Detail', $insertId);
            session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        }

        return redirect()->to('/pemesanan_detail');
    }

    public function delete($id)
    {
        log_delete('Pemesanan Detail', $id);
        $this->detailModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/pemesanan_detail');
    }

    public function getDetail($id)
    {
        $data = $this->detailModel->find($id);
        return $this->response->setJSON($data);
    }
}
