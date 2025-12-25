<?php

namespace App\Models;

use CodeIgniter\Model;

class PemberangkatanModel extends Model
{
    protected $table = 'pemberangkatan';
    protected $primaryKey = 'idberangkat';
    protected $allowedFields = ['idpemesanan', 'idbus', 'idsopir', 'idkernet', 'tanggalberangkat'];

    public function getPemberangkatanWithDetails()
    {
        return $this->select('pemberangkatan.*, pemesanan.tanggal_pesan, bus.nomor_polisi, bus.merek, sopir.nama_karyawan as sopir, kernet.nama_karyawan as kernet')
                    ->join('pemesanan', 'pemesanan.id = pemberangkatan.idpemesanan', 'left')
                    ->join('bus', 'bus.id = pemberangkatan.idbus', 'left')
                    ->join('karyawan as sopir', 'sopir.idkaryawan = pemberangkatan.idsopir', 'left')
                    ->join('karyawan as kernet', 'kernet.idkaryawan = pemberangkatan.idkernet', 'left')
                    ->findAll();
    }
}
