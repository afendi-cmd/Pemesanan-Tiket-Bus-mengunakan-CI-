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

    public function checkConflicts($idbus, $idsopir, $idkernet, $tanggalberangkat, $excludeId = null)
    {
        $builder = $this->db->table('pemberangkatan');
        $builder->select('idberangkat, idbus, idsopir, idkernet, tanggalberangkat')
                ->where('tanggalberangkat', $tanggalberangkat);
        if ($excludeId) {
            $builder->where('idberangkat !=', $excludeId);
        }

        $rows = $builder->get()->getResultArray();
        $conflicts = ['bus' => false, 'sopir' => false, 'kernet' => false];

        foreach ($rows as $r) {
            if (!empty($idbus) && $r['idbus'] == $idbus) $conflicts['bus'] = true;
            if (!empty($idsopir) && $r['idsopir'] == $idsopir) $conflicts['sopir'] = true;
            if (!empty($idkernet) && $r['idkernet'] == $idkernet) $conflicts['kernet'] = true;
        }

        return $conflicts;
    }

    public function getPastAssignments()
    {
        $today = date('Y-m-d');
        $rows = $this->db->table('pemberangkatan')
                    ->select('idbus, idsopir, idkernet')
                    ->where('tanggalberangkat <', $today)
                    ->get()->getResultArray();
        $ids = ['bus'=>[], 'sopir'=>[], 'kernet'=>[]];
        foreach ($rows as $r) {
            if (!empty($r['idbus'])) $ids['bus'][] = $r['idbus'];
            if (!empty($r['idsopir'])) $ids['sopir'][] = $r['idsopir'];
            if (!empty($r['idkernet'])) $ids['kernet'][] = $r['idkernet'];
        }
        $ids['bus'] = array_values(array_unique($ids['bus']));
        $ids['sopir'] = array_values(array_unique($ids['sopir']));
        $ids['kernet'] = array_values(array_unique($ids['kernet']));
        return $ids;
    }

    public function getDetailCetak($idberangkat)
    {
        return $this->select('pemberangkatan.*, pemesanan.*, bus.nomor_polisi, bus.merek, sopir.nama_karyawan as nama_sopir, kernet.nama_karyawan as nama_kernet, pw.nama_paket as nama_paket, pw.tujuan as tujuan')
                    ->join('pemesanan', 'pemesanan.id = pemberangkatan.idpemesanan', 'left')
                    ->join('pemesanan_detail pd', 'pd.id_pemesanan = pemesanan.id', 'left')
                    ->join('paket_bus pb', 'pb.id = pemesanan.id_paketbus', 'left')
                    ->join('paket_wisata pw', 'pw.id = pb.id_paketwisata', 'left')
                    ->join('bus', 'bus.id = pemberangkatan.idbus', 'left')
                    ->join('karyawan as sopir', 'sopir.idkaryawan = pemberangkatan.idsopir', 'left')
                    ->join('karyawan as kernet', 'kernet.idkaryawan = pemberangkatan.idkernet', 'left')
                    ->where('pemberangkatan.idberangkat', $idberangkat)
                    ->get()->getRowArray();
    }

    // --- TAMBAHAN KODE DARI GAMBAR ---

    public function getDaftarTujuan()
    {
        // Mengambil semua tujuan unik dari tabel paket_wisata
        return $this->db->table('paket_wisata')
            ->select('tujuan')
            ->distinct()
            ->get()->getResultArray();
    }

    public function getLaporanByTujuan($tujuan)
    {
        return $this->db->table('pemberangkatan pb')
            ->select('pb.*, pw.nama_paket, pw.tujuan, b.nomor_polisi, s.nama_karyawan as sopir, pd.tanggal_berangkat, pd.tanggal_kembali')
            ->join('bus b', 'b.id = pb.idbus')
            ->join('karyawan s', 's.idkaryawan = pb.idsopir')
            ->join('pemesanan p', 'p.id = pb.idpemesanan')
            ->join('pemesanan_detail pd', 'p.id = pd.id_pemesanan')
            ->join('paket_bus pbus', 'pbus.id = p.id_paketbus')
            ->join('paket_wisata pw', 'pw.id = pbus.id_paketwisata')
            ->where('pw.tujuan', $tujuan)
            ->get()->getResultArray();
    }

    // Laporan Keberangkatan Per Periode
    public function getLaporanPemberangkatanPeriode($tgl_mulai, $tgl_akhir)
    {
        return $this->db->table('pemberangkatan')
                    ->select('pemberangkatan.*, pemesanan.tanggal_pesan, bus.nomor_polisi, bus.merek, sopir.nama_karyawan as sopir, kernet.nama_karyawan as kernet')
                    ->join('pemesanan', 'pemesanan.id = pemberangkatan.idpemesanan', 'left')
                    ->join('bus', 'bus.id = pemberangkatan.idbus', 'left')
                    ->join('karyawan as sopir', 'sopir.idkaryawan = pemberangkatan.idsopir', 'left')
                    ->join('karyawan as kernet', 'kernet.idkaryawan = pemberangkatan.idkernet', 'left')
                    ->where('pemberangkatan.tanggalberangkat >=', $tgl_mulai)
                    ->where('pemberangkatan.tanggalberangkat <=', $tgl_akhir)
                    ->orderBy('pemberangkatan.tanggalberangkat', 'ASC')
                    ->get()
                    ->getResultArray();
    }

    // Laporan Keberangkatan Per Tanggal
    public function getLaporanPemberangkatanByTanggal($tanggal)
    {
        return $this->db->table('pemberangkatan')
                    ->select('pemberangkatan.*, pemesanan.tanggal_pesan, bus.nomor_polisi, bus.merek, sopir.nama_karyawan as sopir, kernet.nama_karyawan as kernet')
                    ->join('pemesanan', 'pemesanan.id = pemberangkatan.idpemesanan', 'left')
                    ->join('bus', 'bus.id = pemberangkatan.idbus', 'left')
                    ->join('karyawan as sopir', 'sopir.idkaryawan = pemberangkatan.idsopir', 'left')
                    ->join('karyawan as kernet', 'kernet.idkaryawan = pemberangkatan.idkernet', 'left')
                    ->where('pemberangkatan.tanggalberangkat', $tanggal)
                    ->orderBy('pemberangkatan.tanggalberangkat', 'ASC')
                    ->get()
                    ->getResultArray();
    }
}