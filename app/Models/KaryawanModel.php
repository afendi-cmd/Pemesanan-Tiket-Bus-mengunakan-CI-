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

    // Ambil karyawan berdasarkan nama jabatan (case-insensitive, menggunakan LIKE)
    public function getKaryawanByJabatanName($name)
    {
        return $this->select('karyawan.*')
                    ->join('jabatan', 'jabatan.id = karyawan.idjabatan', 'left')
                    ->like('jabatan.namajabatan', $name)
                    ->get()
                    ->getResultArray();
    }
}
