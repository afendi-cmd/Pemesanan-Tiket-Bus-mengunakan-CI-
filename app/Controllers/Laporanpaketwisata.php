<?php

namespace App\Controllers;
use App\Models\PaketWisataModel;
use App\Controllers\BaseController;

class LaporanPaketwisata extends BaseController
{
    public function index()
    {
        $model = new PaketWisataModel();
        $data['paketwisata'] = $model->findAll();
        return view('paketwisata/laporan', $data);
    }

    public function cetak()
    {
        $model = new PaketWisataModel();
        $data['paketwisata'] = $model->findAll();
        return view('paketwisata/cetak', $data);
    }
}
