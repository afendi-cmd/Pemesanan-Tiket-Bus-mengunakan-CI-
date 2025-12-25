<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center mb-0">
                <h5 class="mb-0">Daftar Reservasi Bus</h5>
                <a href="<?= base_url('pemesanan') ?>" class="btn btn-light btn-sm">Tambah Pesanan</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success m-3">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tgl Pesan</th>
                        <th>Penyewa</th>
                        <th>Paket Wisata</th>
                        <th>Jadwal</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($semua_pemesanan as $row): ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tanggal_pesan'])) ?></td>
                                    <td><strong><?= esc($row['nama_penyewa'] ?? '-') ?></strong></td>
                            <td>
                                <strong><?= $row['nama_paket'] ?></strong><br>
                                <small><?= $row['tujuan'] ?></small>
                            </td>
                            <td>
                                <?= $row['tanggal_berangkat'] ?> s/d <?= $row['tanggal_kembali'] ?>
                            </td>
                            <td class="text-primary fw-bold">
                                Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?>
                            </td>
                            <td>
                                <?php if ($row['id_pembayaran']) : ?>
                                    <span class="badge bg-success">Sudah Dibayar</span>
                                <?php else : ?>
                                    <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if (!$row['id_pembayaran']) : ?>
                                        <a href="<?= base_url('pemesanan/bayar/' . $row['id']) ?>" class="btn btn-sm btn-success">Bayar</a>
                                        <a href="<?= base_url('pemesanan/batal/' . $row['id']) ?>" class="btn btn-sm btn-danger"
                                           onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">Batal</a>
                                    <?php else : ?>
                                        <button class="btn btn-sm btn-secondary" disabled>Lunas</button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<?= $this->endSection() ?>
