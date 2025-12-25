<?php

namespace App\Controllers;
use App\Models\KaryawanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporankaryawan extends BaseController
{
     public function index()
    {
        $model = new KaryawanModel();
        $data['karyawan'] = $model->findAll();
        return view('karyawan/laporan', $data);
    }

    public function cetak()
    {
        $model = new KaryawanModel();
        $data['karyawan'] = $model->findAll();
        return view('karyawan/cetak', $data);
    }
}
