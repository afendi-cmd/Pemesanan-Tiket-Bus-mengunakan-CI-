<?php
namespace App\Models;
use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table            = 'pemesanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal_pesan', 'id_penyewa', 'id_paketbus', 'total_bayar'];

    public function getPaketLengkap()
    {
        return $this->db->table('paket_bus pb')
            ->select('pb.id as id_paketbus, pw.nama_paket, pw.tujuan, pw.harga')
            ->join('paket_wisata pw', 'pw.id = pb.id_paketwisata')
            ->get()
            ->getResultArray();
    }

    public function getHargaPaket($idPaketBus)
    {
        return $this->db->table('paket_bus pb')
            ->join('paket_wisata pw', 'pw.id = pb.id_paketwisata')
            ->where('pb.id', $idPaketBus)
            ->get()->getRow();
    }

    public function getPemesananDetail($id_pemesanan)
    {
        return $this->db->table('pemesanan p')
            ->select('p.*, pw.nama_paket, pw.tujuan')
            ->join('paket_bus pb', 'pb.id = p.id_paketbus')
            ->join('paket_wisata pw', 'pw.id = pb.id_paketwisata')
            ->where('p.id', $id_pemesanan)
            ->get()->getRowArray();
    }

    public function cekKetersediaan($id_paketbus, $tgl_berangkat, $tgl_kembali)
    {
        return $this->db->table('pemesanan_detail pd')
            ->join('pemesanan p', 'p.id = pd.id_pemesanan')
            ->where('p.id_paketbus', $id_paketbus)
            ->groupStart()
                ->where('pd.tanggal_berangkat <=', $tgl_kembali)
                ->where('pd.tanggal_kembali >=', $tgl_berangkat)
            ->groupEnd()
            ->countAllResults();
    }

    public function getLaporanPembayaran($tglAwal, $tglAkhir)
    {
        return $this->db->table('pembayaran pay')
            ->select('pay.*, p.tanggal_pesan, p.total_bayar as tagihan,py.nama_penyewa as nama_penyewa,pw.nama_paket as nama_paket')
            ->join('pemesanan p', 'p.id = pay.id_pemesanan')
            ->join('penyewa py', 'py.id = p.id_penyewa')
            ->join('paket_bus pb', 'pb.id = p.id_paketbus')
            ->join('paket_wisata pw', 'pw.id = pb.id_paketwisata')
            ->where('pay.tanggal_bayar >=', $tglAwal)
            ->where('pay.tanggal_bayar <=', $tglAkhir)
            ->orderBy('pay.tanggal_bayar', 'ASC')
            ->get()->getResultArray();
    }

    public function simpanDetail($data)
    {
        return $this->db->table('pemesanan_detail')->insert($data);
    }

    /**
     * Insert pembayaran terkait pemesanan
     * @param array $data (id_pemesanan, tanggal_bayar, jumlah_bayar, metode_bayar, foto)
     * @return int|bool insert ID or false
     */
    public function insertPembayaran(array $data)
    {
        $this->db->table('pembayaran')->insert($data);
        $insertId = $this->db->insertID();
        return $insertId ? $insertId : false;
    }

    // Tambahkan di dalam class PemesananModel
    public function getSemuaPemesanan()
    {
        return $this->db->table('pemesanan p')
            ->select('p.*, pd.tanggal_berangkat, pd.tanggal_kembali, pd.jumlah_penumpang, pw.nama_paket, pw.tujuan, pen.nama_penyewa, pay.id as id_pembayaran, ber.idberangkat as idberangkat')
            ->join('pemesanan_detail pd', 'pd.id_pemesanan = p.id')
            ->join('paket_bus pb', 'pb.id = p.id_paketbus')
            ->join('paket_wisata pw', 'pw.id = pb.id_paketwisata')
            ->join('penyewa pen', 'pen.id = p.id_penyewa')
            ->join('pemberangkatan ber', 'ber.idpemesanan = p.id', 'left')
            ->join('pembayaran pay', 'pay.id_pemesanan = p.id', 'left')
            ->orderBy('p.id', 'DESC')
            ->get()->getResultArray();
    }

    public function hapusPemesanan($id)
    {
        $this->db->transStart();

        // 1. Hapus di tabel detail terlebih dahulu (foreign key)
        $this->db->table('pemesanan_detail')->where('id_pemesanan', $id)->delete();

        // 2. Hapus di tabel pembayaran jika ada
        $this->db->table('pembayaran')->where('id_pemesanan', $id)->delete();

        // 3. Hapus data utama di tabel pemesanan
        $this->db->table('pemesanan')->where('id', $id)->delete();

        $this->db->transComplete();
        return $this->db->transStatus();
    }
}
