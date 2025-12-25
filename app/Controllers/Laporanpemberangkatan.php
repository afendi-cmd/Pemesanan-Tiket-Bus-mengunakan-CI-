<?php

namespace App\Controllers;
use App\Models\PemberangkatanModel;
use App\Controllers\BaseController;

class LaporanPemberangkatan extends BaseController
{
    public function index()
    {
        $model = new PemberangkatanModel();
        $data['pemberangkatan'] = $model->getPemberangkatanWithDetails();
        return view('pemberangkatan/laporan', $data);
    }

    public function cetak()
    {
        $model = new PemberangkatanModel();
        $data['pemberangkatan'] = $model->getPemberangkatanWithDetails();
        return view('pemberangkatan/cetak', $data);
    }
}
