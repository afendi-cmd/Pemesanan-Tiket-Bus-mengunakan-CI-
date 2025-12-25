<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-primary fw-bold"><i class="mdi mdi-account-card-details me-2"></i>Daftar Penyewa</h5>
            <a href="<?= base_url('laporanpenyewa/cetak') ?>" target="_blank" class="btn btn-print btn-sm px-3 btn-danger text-white">
                <i class="fas fa-print me-2"></i>Cetak PDF / Print
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="80">ID</th>
                            <th>Nama Penyewa</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($penyewa)): ?>
                            <?php foreach($penyewa as $p) : ?>
                            <tr>
                                <td class="text-center"><span class="badge-id"><?= $p['id'] ?? '' ?></span></td>
                                <td><div class="fw-bold text-dark"><?= $p['nama_penyewa'] ?? '' ?></div></td>
                                <td><small class="text-muted"><?= $p['no_telp'] ?? '' ?></small></td>
                                <td><?= htmlspecialchars($p['alamat'] ?? '') ?></td>
                                <td><a href="mailto:<?= $p['email'] ?? '' ?>" class="text-decoration-none text-primary"><?= $p['email'] ?? '' ?></a></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-5 text-muted">Data penyewa tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted small py-3">Menampilkan total <strong><?= count($penyewa) ?></strong> penyewa.</div>
    </div>
</div>
<?= $this->endSection() ?>