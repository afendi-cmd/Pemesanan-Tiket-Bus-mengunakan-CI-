<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-primary fw-bold"><i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pemesanan Detail</h5>
            <a href="<?= base_url('laporanpemesanan_detail/cetak') ?>" target="_blank" class="btn btn-print btn-sm px-3 btn-danger text-white">
                <i class="fas fa-print me-2"></i>Cetak PDF / Print
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="80">ID</th>
                            <th>ID Pemesanan</th>
                            <th>Penyewa</th>
                            <th>Paket</th>
                            <th>Tgl Berangkat</th>
                            <th>Tgl Kembali</th>
                            <th>Jumlah Penumpang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pemesanan_detail)): ?>
                            <?php foreach($pemesanan_detail as $d) : ?>
                            <tr>
                                <td class="text-center"><span class="badge-id"><?= $d['id'] ?? '' ?></span></td>
                                <td><div class="fw-bold text-dark"><?= $d['id_pemesanan'] ?? '' ?></div></td>
                                <td><?= htmlspecialchars($d['nama_penyewa'] ?? '') ?></td>
                                <td><?= htmlspecialchars($d['nama_paket'] ?? '') ?></td>
                                <td><?= htmlspecialchars($d['tanggal_berangkat'] ?? '') ?></td>
                                <td><?= htmlspecialchars($d['tanggal_kembali'] ?? '') ?></td>
                                <td><?= htmlspecialchars($d['jumlah_penumpang'] ?? '') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" class="text-center py-5 text-muted">Data pemesanan detail tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted small py-3">Menampilkan total <strong><?= count($pemesanan_detail) ?></strong> baris.</div>
    </div>
</div>
<?= $this->endSection() ?>