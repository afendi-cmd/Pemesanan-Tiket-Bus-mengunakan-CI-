<?php

namespace App\Controllers;

use App\Models\PemberangkatanModel;
use App\Models\PemesananModel;
use App\Models\BusModel;
use App\Models\KaryawanModel;
use App\Controllers\BaseController;

class Pemberangkatan extends BaseController
{
    protected $pemberangkatanModel;
    protected $pemesananModel;
    protected $busModel;
    protected $karyawanModel;

    public function __construct()
    {
        $this->pemberangkatanModel = new PemberangkatanModel();
        $this->pemesananModel     = new PemesananModel();
        $this->busModel           = new BusModel();
        $this->karyawanModel      = new KaryawanModel();
    }

    public function index()
    {
        $login = $this->checkLogin();
        if ($login) {
            return $login;
        }

        $timeout = $this->autoSessionTimeout();
        if ($timeout) {
            return $timeout;
        }

        $data['pemberangkatan'] = $this->pemberangkatanModel->getPemberangkatanWithDetails();
        $data['pemesanan']      = $this->pemesananModel->findAll();
        $data['bus']            = $this->busModel->findAll();

        // Ambil sopir dan kernet berdasarkan nama jabatan
        $data['sopir']  = $this->karyawanModel->getKaryawanByJabatanName('Sopir');
        $data['kernet'] = $this->karyawanModel->getKaryawanByJabatanName('Kernet');

        return view('/pemberangkatan/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('idberangkat');

        // Terima id pemesanan dari berbagai form
        $idpemesanan = $this->request->getPost('idpemesanan')
            ?? $this->request->getPost('id_pemesanan');

        $data = [
            'idpemesanan'      => $idpemesanan,
            'idbus'            => $this->request->getPost('idbus'),
            'idsopir'          => $this->request->getPost('idsopir'),
            'idkernet'         => $this->request->getPost('idkernet'),
            'tanggalberangkat' => $this->request->getPost('tanggalberangkat')
        ];

        // Validasi dasar
        if (
            empty($data['idpemesanan']) ||
            empty($data['idbus']) ||
            empty($data['idsopir']) ||
            empty($data['idkernet']) ||
            empty($data['tanggalberangkat'])
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Lengkapi semua field keberangkatan.');
        }

        // Cegah resource yang sudah pernah berangkat
        $past         = $this->pemberangkatanModel->getPastAssignments();
        $pastBus      = array_map('strval', $past['bus'] ?? []);
        $pastSopir    = array_map('strval', $past['sopir'] ?? []);
        $pastKernet   = array_map('strval', $past['kernet'] ?? []);

        $selectedBus    = (string) $data['idbus'];
        $selectedSopir  = (string) $data['idsopir'];
        $selectedKernet = (string) $data['idkernet'];

        $pastMessages = [];

        if (in_array($selectedBus, $pastBus)) {
            session()->setFlashdata('error_bus', 'Armada sudah berangkat sebelumnya dan tidak dapat dipilih.');
            $pastMessages[] = 'Armada sudah berangkat sebelumnya.';
        }

        if (in_array($selectedSopir, $pastSopir)) {
            session()->setFlashdata('error_sopir', 'Sopir sudah berangkat sebelumnya dan tidak dapat dipilih.');
            $pastMessages[] = 'Sopir sudah berangkat sebelumnya.';
        }

        if (in_array($selectedKernet, $pastKernet)) {
            session()->setFlashdata('error_kernet', 'Kernet sudah berangkat sebelumnya dan tidak dapat dipilih.');
            $pastMessages[] = 'Kernet sudah berangkat sebelumnya.';
        }

        if (!empty($pastMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode(' ', $pastMessages));
        }

        // Cek konflik tanggal
        $conflicts = $this->pemberangkatanModel->checkConflicts(
            $data['idbus'],
            $data['idsopir'],
            $data['idkernet'],
            $data['tanggalberangkat'],
            $id ?: null
        );

        $messages = [];

        if ($conflicts['bus']) {
            $messages[] = 'Armada bus telah terjadwal pada tanggal tersebut.';
            session()->setFlashdata('error_bus', 'Armada tidak tersedia pada tanggal keberangkatan yang dipilih.');
        }

        if ($conflicts['sopir']) {
            $messages[] = 'Sopir sudah dijadwalkan pada tanggal tersebut.';
            session()->setFlashdata('error_sopir', 'Sopir tidak tersedia pada tanggal keberangkatan yang dipilih.');
        }

        if ($conflicts['kernet']) {
            $messages[] = 'Kernet sudah dijadwalkan pada tanggal tersebut.';
            session()->setFlashdata('error_kernet', 'Kernet tidak tersedia pada tanggal keberangkatan yang dipilih.');
        }

        if (!empty($messages)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode(' ', $messages));
        }

        // Simpan / Update
        if ($id) {
            $this->pemberangkatanModel->update($id, $data);
            log_update('Pemberangkatan', $id);
            session()->setFlashdata('success', 'Data pemberangkatan berhasil diperbarui.');
        } else {
            $insertId = $this->pemberangkatanModel->insert($data);
            log_create('Pemberangkatan', $insertId);
            session()->setFlashdata('success', 'Data pemberangkatan berhasil ditambahkan.');
        }

        return redirect()->to('/pemesanan/tampil');
    }

    public function delete($id)
    {
        log_delete('Pemberangkatan', $id);
        $this->pemberangkatanModel->delete($id);
        session()->setFlashdata('success', 'Data pemberangkatan berhasil dihapus.');
        return redirect()->to('/pemberangkatan');
    }

    public function getPemberangkatan($id)
    {
        $data = $this->pemberangkatanModel->find($id);
        return $this->response->setJSON($data);
    }

    // API: resource tidak tersedia pada tanggal tertentu
    public function getUnavailable()
    {
        $tanggal = $this->request->getGet('tanggal');

        if (!$tanggal) {
            return $this->response->setJSON([
                'bus'    => [],
                'sopir'  => [],
                'kernet' => []
            ]);
        }

        $rows = $this->pemberangkatanModel
            ->where('tanggalberangkat', $tanggal)
            ->findAll();

        $ids = ['bus'=>[], 'sopir'=>[], 'kernet'=>[]];

        foreach ($rows as $r) {
            if (!empty($r['idbus']))    $ids['bus'][]    = $r['idbus'];
            if (!empty($r['idsopir']))  $ids['sopir'][]  = $r['idsopir'];
            if (!empty($r['idkernet'])) $ids['kernet'][] = $r['idkernet'];
        }

        // Sertakan data yang sudah pernah berangkat
        $ids['past'] = $this->pemberangkatanModel->getPastAssignments();

        return $this->response->setJSON($ids);
    }

    // API: resource yang sudah berangkat (tanggal < hari ini)
    public function getRemoved()
    {
        $ids = $this->pemberangkatanModel->getPastAssignments();
        return $this->response->setJSON($ids);
    }

    // Redirect ke index sambil prefill pemesanan
    public function input($id_pemesanan)
    {
        session()->setFlashdata('prefill_pemesanan', $id_pemesanan);
        return redirect()->to('/pemberangkatan');
    }

    // Form input terpisah
    public function form($id_pemesanan)
    {
        $pesanan = $this->pemesananModel->getPemesananDetail($id_pemesanan);

        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Ensure $pesanan is an array for the view which expects array access
        if (is_object($pesanan)) {
            $pesanan = (array) $pesanan;
        }

        $data = [
            'pesanan' => $pesanan,
            'bus'     => $this->busModel->findAll(),
            'sopir'   => $this->karyawanModel->getKaryawanByJabatanName('Sopir'),
            'kernet'  => $this->karyawanModel->getKaryawanByJabatanName('Kernet')
        ];

        return view('pemberangkatan/form_input', $data);
    }

    // Cetak surat jalan
    public function cetak($idberangkat)
    {
        $detail = $this->pemberangkatanModel->getDetailCetak($idberangkat);

        if (!$detail) {
            return redirect()->to('/pemberangkatan')
                ->with('error', 'Data tidak ditemukan.');
        }

        return view('pemberangkatan/surat_jalan', [
            'detail' => $detail
        ]);
    }

    // --- TAMBAHAN KODE LAPORAN BERDASARKAN GAMBAR ---

    public function laporan()
    {
        // Mengambil input dari form filter
        $tujuanSelected = $this->request->getGet('tujuan');

        $data['daftar_tujuan'] = $this->pemberangkatanModel->getDaftarTujuan();
        $data['tujuan_pilihan'] = $tujuanSelected;
        $data['laporan'] = [];

        if ($tujuanSelected) {
            $data['laporan'] = $this->pemberangkatanModel->getLaporanByTujuan($tujuanSelected);
        }

        return view('pemberangkatan/v_laporan_tujuan', $data);
    }
}