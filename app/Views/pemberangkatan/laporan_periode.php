<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pemberangkatan Per Periode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display: none; } }
    </style>
</head>
<body class="bg-light">
<div class="container-fluid py-5">
    <div class="card shadow no-print mb-4">
        <div class="card-body">
            <h5><i class="mdi mdi-calendar-month me-2"></i>Filter Laporan Periode Pemberangkatan</h5>
            <form action="<?= base_url('laporanpemberangkatanperiode') ?>" method="get" class="row g-3">
                <div class="col-md-4">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="<?= htmlspecialchars($tgl_mulai ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="<?= htmlspecialchars($tgl_akhir ?? '') ?>" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-2"></i>Tampilkan
                    </button>
                    <?php if ($tgl_mulai && $tgl_akhir): ?>
                        <button type="button" onclick="window.print()" class="btn btn-danger">
                            <i class="fas fa-print me-2"></i>Cetak PDF
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <?php if ($tgl_mulai): ?>
    <div class="card shadow">
        <div class="card-body">
            <div class="text-center mb-4">
                <h4>LAPORAN PEMBERANGKATAN</h4>
                <p>Periode: <?= date('d/m/Y', strtotime($tgl_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></p>
            </div>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Berangkat</th>
                        <th>Pemesanan</th>
                        <th>Tgl Pesan</th>
                        <th>Tanggal Berangkat</th>
                        <th>Bus</th>
                        <th>Sopir</th>
                        <th>Kernet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pemberangkatan)): ?>
                        <tr><td colspan="8" class="text-center">Data pemberangkatan tidak ditemukan</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($pemberangkatan as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($p['idberangkat'] ?? '-') ?></span></td>
                                <td><?= htmlspecialchars($p['idpemesanan'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($p['tanggal_pesan'] ?? '-') ?></td>
                                <td><span class="badge bg-info"><?= htmlspecialchars($p['tanggalberangkat'] ?? '-') ?></span></td>
                                <td><?= htmlspecialchars(($p['nomor_polisi'] ?? '') . ' - ' . ($p['merek'] ?? '')) ?></td>
                                <td><?= htmlspecialchars($p['sopir'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($p['kernet'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-info fw-bold">
                            <td colspan="8" class="text-center">TOTAL PEMBERANGKATAN: <?= count($pemberangkatan) ?> perjalanan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
<?= $this->endSection() ?>
