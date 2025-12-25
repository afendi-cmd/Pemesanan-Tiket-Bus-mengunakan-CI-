<?php

namespace App\Controllers;
use App\Models\PembayaranModel;
use App\Controllers\BaseController;

class LaporanPembayaran extends BaseController
{
    public function index()
    {
        $model = new PembayaranModel();
        $data['pembayaran'] = $model->getPembayaranWithPemesanan();
        return view('pembayaran/laporan', $data);
    }

    public function cetak()
    {
        $model = new PembayaranModel();
        $data['pembayaran'] = $model->getPembayaranWithPemesanan();
        return view('pembayaran/cetak', $data);
    }
}
