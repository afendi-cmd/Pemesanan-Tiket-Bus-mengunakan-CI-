<?php

namespace App\Controllers;
use App\Models\PenyewaModel;
use App\Controllers\BaseController;

class LaporanPenyewa extends BaseController
{
    public function index()
    {
        $model = new PenyewaModel();
        $data['penyewa'] = $model->findAll();
        return view('penyewa/laporan', $data);
    }

    public function cetak()
    {
        $model = new PenyewaModel();
        $data['penyewa'] = $model->findAll();
        return view('penyewa/cetak', $data);
    }
}
