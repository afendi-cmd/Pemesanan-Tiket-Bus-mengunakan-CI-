<?php

namespace App\Controllers;
use App\Models\BusModel;
use App\Controllers\BaseController;

class LaporanBus extends BaseController
{
    public function index()
    {
        $model = new BusModel();
        $data['bus'] = $model->getWithJenisbus();
        return view('bus/laporan', $data);
    }

    public function cetak()
    {
        $model = new BusModel();
        $data['bus'] = $model->getWithJenisbus();
        return view('bus/cetak', $data);
    }
}
