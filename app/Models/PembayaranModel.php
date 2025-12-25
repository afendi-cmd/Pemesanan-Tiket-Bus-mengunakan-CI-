<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pemesanan', 'tanggal_bayar', 'jumlah_bayar', 'metode_bayar'];

    public function getPembayaranWithPemesanan()
    {
        return $this->select('
                    pembayaran.*,
                    pemesanan.tanggal_pesan,
                    pemesanan.total_bayar,
                    penyewa.nama_penyewa
                ')
                ->join('pemesanan', 'pemesanan.id = pembayaran.id_pemesanan', 'left')
                ->join('penyewa', 'penyewa.id = pemesanan.id_penyewa', 'left')
                ->findAll();
    }
}
