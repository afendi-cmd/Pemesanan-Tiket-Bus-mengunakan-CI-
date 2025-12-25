<?php

namespace App\Controllers;
use App\Models\JenisBusModel;
use App\Controllers\BaseController;

class LaporanJenisbus extends BaseController
{
    public function index()
    {
        $model = new JenisBusModel();
        $data['jenisbus'] = $model->findAll();
        return view('jenisbus/laporan', $data);
    }

    public function cetak()
    {
        $model = new JenisBusModel();
        $data['jenisbus'] = $model->findAll();
        return view('jenisbus/cetak', $data);
    }
}
