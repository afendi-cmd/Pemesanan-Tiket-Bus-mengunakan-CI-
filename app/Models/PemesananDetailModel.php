<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananDetailModel extends Model
{
    protected $table = 'pemesanan_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pemesanan', 'tanggal_berangkat', 'tanggal_kembali', 'jumlah_penumpang'];

    public function getPemesananDetailWithRelations()
    {
        return $this->select('
                pemesanan_detail.*, 
                pemesanan.id AS id_pemesanan, 
                penyewa.nama_penyewa, 
                paket_wisata.nama_paket, 
                paket_bus.id AS id_paketbus,
                bus.nomor_polisi,
                bus.merek
            ')
            ->join('pemesanan', 'pemesanan.id = pemesanan_detail.id_pemesanan', 'left')
            ->join('paket_bus', 'paket_bus.id = pemesanan.id_paketbus', 'left')
            ->join('paket_wisata', 'paket_wisata.id = paket_bus.id_paketwisata', 'left')
            ->join('bus', 'bus.id = paket_bus.id_bus', 'left')
            ->join('penyewa', 'penyewa.id = pemesanan.id_penyewa', 'left')
            ->findAll();
    }
}
