<?php

namespace App\Controllers;
use App\Models\PemesananDetailModel;
use App\Controllers\BaseController;

class LaporanPemesananDetail extends BaseController
{
    public function index()
    {
        $model = new PemesananDetailModel();
        $data['pemesanan_detail'] = $model->getPemesananDetailWithRelations();
        return view('pemesanan_detail/laporan', $data);
    }

    public function cetak()
    {
        $model = new PemesananDetailModel();
        $data['pemesanan_detail'] = $model->getPemesananDetailWithRelations();
        return view('pemesanan_detail/cetak', $data);
    }
}
