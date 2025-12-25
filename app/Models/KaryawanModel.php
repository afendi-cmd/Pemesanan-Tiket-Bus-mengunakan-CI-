<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'idkaryawan';
    protected $allowedFields = ['idjabatan','nik_karyawan','nama_karyawan','alamat','nohp','email','password'];

    // Relasi dengan tabel jabatan
    public function getWithJabatan()
    {
        return $this->select('karyawan.*, jabatan.namajabatan')
                    ->join('jabatan', 'jabatan.id = karyawan.idjabatan', 'left')
                    ->findAll();
    }
}
