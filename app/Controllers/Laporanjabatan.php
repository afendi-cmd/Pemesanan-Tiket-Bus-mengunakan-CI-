<?php

namespace App\Controllers;
use App\Models\JabatanModel;
use App\Controllers\BaseController;

class LaporanJabatan extends BaseController
{
    public function index()
    {
        $model = new JabatanModel();
        $data['jabatan'] = $model->findAll();
        return view('jabatan/laporan', $data);
    }

    public function cetak()
    {
        $model = new JabatanModel();
        $data['jabatan'] = $model->findAll();
        return view('jabatan/cetak', $data);
    }
}
