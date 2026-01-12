<?php

namespace App\Controllers;
use App\Models\PemberangkatanModel;
use App\Controllers\BaseController;

class LaporanPemberangkatanPeriode extends BaseController
{
    public function index()
    {
        $tglMulai = $this->request->getGet('tgl_mulai');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $model = new PemberangkatanModel();
        $data['pemberangkatan'] = [];
        $data['tgl_mulai'] = $tglMulai;
        $data['tgl_akhir'] = $tglAkhir;

        if ($tglMulai && $tglAkhir) {
            $data['pemberangkatan'] = $model->getLaporanPemberangkatanPeriode($tglMulai, $tglAkhir);
        }

        return view('pemberangkatan/laporan_periode', $data);
    }

    public function cetak()
    {
        $tglMulai = $this->request->getGet('tgl_mulai');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $model = new PemberangkatanModel();
        $data['pemberangkatan'] = [];
        $data['tgl_mulai'] = $tglMulai;
        $data['tgl_akhir'] = $tglAkhir;

        if ($tglMulai && $tglAkhir) {
            $data['pemberangkatan'] = $model->getLaporanPemberangkatanPeriode($tglMulai, $tglAkhir);
        }

        return view('pemberangkatan/cetak_periode', $data);
    }

    public function perTanggal()
    {
        $tanggalCari = $this->request->getGet('tanggal_cari');

        $model = new PemberangkatanModel();
        $data['pemberangkatan'] = [];
        $data['tanggal_cari'] = $tanggalCari;

        if ($tanggalCari) {
            $data['pemberangkatan'] = $model->getLaporanPemberangkatanByTanggal($tanggalCari);
        }

        return view('pemberangkatan/laporan_per_tanggal', $data);
    }

    public function cetakPerTanggal()
    {
        $tanggalCari = $this->request->getGet('tanggal_cari');

        $model = new PemberangkatanModel();
        $data['pemberangkatan'] = [];
        $data['tanggal_cari'] = $tanggalCari;

        if ($tanggalCari) {
            $data['pemberangkatan'] = $model->getLaporanPemberangkatanByTanggal($tanggalCari);
        }

        return view('pemberangkatan/cetak_per_tanggal', $data);
    }
}
