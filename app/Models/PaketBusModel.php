<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketBusModel extends Model
{
    protected $table = 'paket_bus';
    protected $primaryKey = 'id';
    // ✅ diperbaiki agar sesuai field tabel di database
    protected $allowedFields = ['id_paketwisata', 'id_bus'];

    public function getPaketBusWithDetails()
    {
        // ✅ join diperbaiki supaya sesuai relasi foreign key di database
        return $this->select('paket_bus.*, paket_wisata.nama_paket, paket_wisata.harga, bus.nomor_polisi, bus.merek')
                    ->join('paket_wisata', 'paket_wisata.id = paket_bus.id_paketwisata', 'left')
                    ->join('bus', 'bus.id = paket_bus.id_bus', 'left')
                    ->findAll();
    }
}
