<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran Per Periode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display: none; } }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow no-print mb-4">
        <div class="card-body">
            <h5>Filter Laporan Periode</h5>
            <form action="<?= base_url('pemesanan/laporan') ?>" method="get" class="row g-3">
                <div class="col-md-4">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tgl_awal" class="form-control" value="<?= $tgl_awal ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="<?= $tgl_akhir ?>" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Tampilkan</button>
                    <button type="button" onclick="window.print()" class="btn btn-secondary">Cetak PDF</button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($tgl_awal): ?>
    <div class="card shadow">
        <div class="card-body">
            <div class="text-center mb-4">
                <h4>LAPORAN PEMBAYARAN BUS PARIWISATA</h4>
                <p>Periode: <?= date('d/m/Y', strtotime($tgl_awal)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></p>
            </div>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tgl Bayar</th>
                        <th>Penyewa</th>
                        <th>Paket Wisata</th>
                        <th>Metode</th>
                        <th class="text-end">Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembayaran)): ?>
                        <tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($pembayaran as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d/m/Y', strtotime($p['tanggal_bayar'])) ?></td>
                                <td><?= $p['nama_penyewa'] ?></td>
                                <td><?= $p['nama_paket'] ?></td>
                                <td><?= $p['metode_bayar'] ?></td>
                                <td class="text-end">Rp <?= number_format($p['jumlah_bayar'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-info fw-bold">
                            <td colspan="5" class="text-center">TOTAL PENDAPATAN</td>
                            <td class="text-end">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
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