<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-primary fw-bold"><i class="mdi mdi-steering me-2"></i>Daftar Jenis Bus</h5>
            <a href="<?= base_url('laporanjenisbus/cetak') ?>" target="_blank" class="btn btn-print btn-sm px-3 btn-danger text-white">
                <i class="fas fa-print me-2"></i>Cetak PDF / Print
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="80">ID</th>
                            <th>Nama Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($jenisbus)): ?>
                            <?php foreach($jenisbus as $j) : ?>
                            <tr>
                                <td class="text-center"><span class="badge-id"><?= $j['id'] ?? '' ?></span></td>
                                <td><div class="fw-bold text-dark"><?= htmlspecialchars($j['nama_jenisbus'] ?? '') ?></div></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="2" class="text-center py-5 text-muted">Data jenis bus tidak ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted small py-3">Menampilkan total <strong><?= count($jenisbus) ?></strong> jenis bus.</div>
    </div>
</div>
<?= $this->endSection() ?>