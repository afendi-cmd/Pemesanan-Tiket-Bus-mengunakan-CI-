<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-primary fw-bold"><i class="mdi mdi-truck-delivery me-2"></i>Daftar Pemberangkatan</h5>
            <a href="<?= base_url('laporanpemberangkatan/cetak') ?>" target="_blank" class="btn btn-print btn-sm px-3 btn-danger text-white">
                <i class="fas fa-print me-2"></i>Cetak PDF / Print
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="80">ID</th>
                            <th>Pemesanan</th>
                            <th>Tanggal Berangkat</th>
                            <th>Bus</th>
                            <th>Sopir</th>
                            <th>Kernet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pemberangkatan)): ?>
                            <?php foreach($pemberangkatan as $p) : ?>
                            <tr>
                                <td class="text-center"><span class="badge-id"><?= $p['idberangkat'] ?? '' ?></span></td>
                                <td><div class="fw-bold text-dark"><?= $p['idpemesanan'] ?? '' ?> (<?= htmlspecialchars($p['tanggal_pesan'] ?? '') ?>)</div></td>
                                <td><?= htmlspecialchars($p['tanggalberangkat'] ?? '') ?></td>
                                <td><?= htmlspecialchars(($p['nomor_polisi'] ?? '') . ' - ' . ($p['merek'] ?? '')) ?></td>
                                <td><?= htmlspecialchars($p['sopir'] ?? '') ?></td>
                                <td><?= htmlspecialchars($p['kernet'] ?? '') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center py-5 text-muted">Data pemberangkatan tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted small py-3">Menampilkan total <strong><?= count($pemberangkatan) ?></strong> pemberangkatan.</div>
    </div>
</div>
<?= $this->endSection() ?>