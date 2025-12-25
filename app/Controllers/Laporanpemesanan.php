<?php

namespace App\Controllers;
use App\Models\PemesananModel;
use App\Controllers\BaseController;

class LaporanPemesanan extends BaseController
{
    public function index()
    {
        $model = new PemesananModel();
        $data['pemesanan'] = $model->getPemesananWithDetails();
        return view('pemesanan/laporan', $data);
    }

    public function cetak()
    {
        $model = new PemesananModel();
        $data['pemesanan'] = $model->getPemesananWithDetails();
        return view('pemesanan/cetak', $data);
    }
}
