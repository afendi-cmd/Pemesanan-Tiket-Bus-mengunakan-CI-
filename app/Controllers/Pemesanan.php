<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\PenyewaModel;
use App\Models\PaketBusModel;
use CodeIgniter\Controller;


class Pemesanan extends BaseController
{
    protected $pemesananModel;
    protected $db;

    protected $penyewaModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->penyewaModel = new PenyewaModel();
        $this->db = \Config\Database::connect();
    }

    // 1. Menampilkan Form Input
    public function index()
    {
        // Jika penyewa login -> normal
        $session = session();
        $idPenyewa = $session->get('id_penyewa');

        $data = [ 'paket_bus' => $this->pemesananModel->getPaketLengkap(), 'isAdmin' => false, 'penyewa_list' => [] ];

        if (!empty($idPenyewa)) {
            // pengguna penyewa
            return view('/pemesanan/form_pemesanan', $data);
        }

        // Cek apakah user adalah karyawan/admin (boleh memesan atas nama penyewa)
        $userSource = $session->get('userSource');
        $userData = $session->get('userData') ?? [];
        if ($userSource === 'karyawan' && isset($userData['idjabatan']) && (int)$userData['idjabatan'] === 1) {
            $data['isAdmin'] = true;
            $data['penyewa_list'] = $this->penyewaModel->findAll();
            return view('/pemesanan/form_pemesanan', $data);
        }

        log_message('warning', 'Akses ke halaman pemesanan ditolak karena tidak ada session id_penyewa dan bukan admin. Redirect ke login.');
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu sebelum memesan.');
    }

    // 2. Fungsi AJAX untuk cek ketersediaan (dipanggil via JavaScript)
    public function cek_ajax()
    {
        // Izin: penyewa yang login, atau admin karyawan (dengan mengirimkan id_penyewa)
        $session = session();
        $idPenyewa = $session->get('id_penyewa');

        if (empty($idPenyewa)) {
            $userSource = $session->get('userSource');
            $userData = $session->get('userData') ?? [];
            $postedPenyewa = $this->request->getPost('id_penyewa');

            if (!($userSource === 'karyawan' && isset($userData['idjabatan']) && (int)$userData['idjabatan'] === 1 && !empty($postedPenyewa))) {
                log_message('warning', 'AJAX cek ketersediaan ditolak karena tidak ada session id_penyewa dan bukan admin atau tidak ada id_penyewa yang dipost.');
                return $this->response->setJSON([
                    'status' => 'error',
                    'msg' => 'Silakan login terlebih dahulu sebelum memesan.'
                ]);
            }

            $idPenyewa = $postedPenyewa; // admin menggunakan penyewa yang dipilih
        }

        $idPaket = $this->request->getPost('id_paketbus');
        $tglBerangkat = $this->request->getPost('tgl_berangkat');
        $tglKembali = $this->request->getPost('tgl_kembali');

        $jumlah = $this->pemesananModel->cekKetersediaan($idPaket, $tglBerangkat, $tglKembali);

        if ($jumlah > 0) {
            return $this->response->setJSON([
                'status' => 'penuh',
                'msg' => '❌ Bus sudah dipesan pada tanggal tersebut!'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'tersedia',
            'msg' => '✅ Bus tersedia untuk dipesan.'
        ]);
    }

    // 3. Proses Simpan Data ke 2 Tabel
    public function simpan()
    {
        $idPaket = $this->request->getPost('id_paketbus');
        $tglBerangkat = $this->request->getPost('tgl_berangkat');
        $tglKembali = $this->request->getPost('tgl_kembali');

        // Validasi minimal
        if (empty($idPaket) || empty($tglBerangkat) || empty($tglKembali)) {
            return redirect()->back()->with('error', 'Lengkapi semua field yang wajib diisi.');
        }

        // Pastikan tanggal kembali tidak sebelum berangkat
        if (strtotime($tglKembali) < strtotime($tglBerangkat)) {
            return redirect()->back()->with('error', 'Tanggal kembali harus sama atau setelah tanggal berangkat.');
        }

        // Proteksi sisi server jika user bypass JavaScript
        if ($this->pemesananModel->cekKetersediaan($idPaket, $tglBerangkat, $tglKembali) > 0) {
            return redirect()->back()->with('error', 'Jadwal sudah terisi!');
        }

        $paket = $this->pemesananModel->getHargaPaket($idPaket);
        if (!$paket) {
            log_message('error', "Paket tidak ditemukan untuk id_paketbus={$idPaket}");
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        $durasi = (strtotime($tglKembali) - strtotime($tglBerangkat)) / 60 / 60 / 24 + 1;
        $total = (int) $durasi * (int) $paket->harga;

        // Dapatkan id_penyewa dari session (penyewa biasa) atau dari POST jika admin sedang memesan atas nama penyewa
        $session = session();
        $idPenyewa = $session->get('id_penyewa');
        if (empty($idPenyewa)) {
            // Periksa apakah karyawan admin yang sedang memesan atas nama penyewa
            $userSource = $session->get('userSource');
            $userData = $session->get('userData') ?? [];
            $postedPenyewa = $this->request->getPost('id_penyewa');

            if ($userSource === 'karyawan' && isset($userData['idjabatan']) && (int)$userData['idjabatan'] === 1 && !empty($postedPenyewa)) {
                // Validasi penyewa yang dipilih admin
                $foundPenyewa = $this->penyewaModel->find((int)$postedPenyewa);
                if (!$foundPenyewa) {
                    log_message('error', "Admin mencoba memesan dengan id_penyewa tidak valid: {$postedPenyewa}");
                    return redirect()->back()->with('error', 'Penyewa tidak valid.');
                }
                $idPenyewa = (int)$postedPenyewa;
            } else {
                log_message('error', 'Tidak ada session id_penyewa saat mencoba menyimpan pemesanan.');
                return redirect()->back()->with('error', 'Silakan login terlebih dahulu sebelum memesan.');
            }
        }

        // Siapkan payload dan log untuk debugging bila diperlukan
        $payload = [
            'tanggal_pesan' => date('Y-m-d'),
            'id_penyewa' => $idPenyewa,
            'id_paketbus' => $idPaket,
            'total_bayar' => $total
        ];
        log_message('debug', 'Payload pemesanan: ' . json_encode($payload));

        // Gunakan transaksi pada koneksi model untuk konsistensi
        $db = $this->pemesananModel->db;
        $db->transStart();
        $simpan = $this->pemesananModel->save($payload);

        // Periksa apakah insert berhasil
        $idPemesanan = $this->pemesananModel->getInsertID();
        if (!$simpan || empty($idPemesanan) || $idPemesanan == 0) {
            $db->transRollback();
            // Log lebih detail: model validation errors dan error DB
            $modelErrors = $this->pemesananModel->errors();
            $dbError = $db->error();
            log_message('error', "Gagal menyimpan data pemesanan. save={$simpan}, insertID={$idPemesanan}, modelErrors=" . json_encode($modelErrors) . ", dbError=" . json_encode($dbError));
            return redirect()->back()->with('error', 'Gagal menyimpan pemesanan. Cek log untuk detail.');
        }

        $simpanDetail = $this->pemesananModel->simpanDetail([
            'id_pemesanan' => $idPemesanan,
            'tanggal_berangkat' => $tglBerangkat,
            'tanggal_kembali' => $tglKembali,
            'jumlah_penumpang' => $this->request->getPost('jml_penumpang')
        ]);

        if (!$simpanDetail) {
            $db->transRollback();
            log_message('error', "Gagal menyimpan detail pemesanan untuk id={$idPemesanan}");
            return redirect()->back()->with('error', 'Gagal menyimpan detail pemesanan.');
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            log_message('error', 'Transaksi pemesanan gagal saat commit.');
            return redirect()->back()->with('error', 'Transaksi gagal.');
        }

        return redirect()->to('/pemesanan/tampil')->with('success', 'Pemesanan Berhasil!');
    }

    // 4. Menampilkan Tabel Riwayat Pemesanan
    public function tampil()
    {
        // Cukup panggil fungsi yang ada di model
        $data['semua_pemesanan'] = $this->pemesananModel->getSemuaPemesanan();
        return view('/pemesanan/view_tampil_pemesanan', $data);
    }

    public function batal($id)
    {
        if ($this->pemesananModel->hapusPemesanan($id)) {
            return redirect()->to('/pemesanan/tampil')->with('success', 'Pesanan berhasil dibatalkan.');
        } else {
            return redirect()->to('/pemesanan/tampil')->with('error', 'Gagal membatalkan pesanan.');
        }
    }
}
