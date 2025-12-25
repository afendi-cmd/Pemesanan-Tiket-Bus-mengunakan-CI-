<?php

namespace App\Controllers;
use App\Models\PaketBusModel;
use App\Controllers\BaseController;

class LaporanPaketbus extends BaseController
{
    public function index()
    {
        $model = new PaketBusModel();
        $data['paketbus'] = $model->getPaketBusWithDetails();
        return view('paketbus/laporan', $data);
    }

    public function cetak()
    {
        $model = new PaketBusModel();
        $data['paketbus'] = $model->getPaketBusWithDetails();
        return view('paketbus/cetak', $data);
    }
}
