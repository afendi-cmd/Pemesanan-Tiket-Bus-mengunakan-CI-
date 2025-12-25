<?php

namespace App\Models;

use CodeIgniter\Model;

class BusModel extends Model
{
    protected $table = 'bus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_polisi', 'merek', 'kapasitas', 'id_jenisbus'];

    // Join ke tabel jenisbus agar bisa tampilkan nama_jenisbus
    public function getWithJenisbus()
    {
        return $this->select('bus.*, jenisbus.nama_jenisbus')
                    ->join('jenisbus', 'jenisbus.id = bus.id_jenisbus', 'left')
                    ->findAll();
    }
}
