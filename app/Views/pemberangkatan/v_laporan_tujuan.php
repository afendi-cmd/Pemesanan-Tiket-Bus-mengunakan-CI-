<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { background-color: #f4f7f6; }
    .card { border: none; border-radius: 15px; }
    .card-header { border-radius: 15px 15px 0 0 !important; }
    .table thead { background-color: #2c3e50; color: white; }
    .btn-primary { border-radius: 10px; padding: 10px 20px; transition: 0.3s; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3); }

    /* CSS Khusus untuk Cetak */
    @media print {
        .no-print, .form-section { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd; }
        body { background-color: white; }
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5 no-print">
        <h2 class="fw-bold text-dark">Laporan Perjalanan Bus</h2>
        <p class="text-muted">Pantau keberangkatan armada berdasarkan kota tujuan</p>
    </div>

    <div class="card shadow-sm mb-4 form-section no-print">
        <div class="card-body p-4">
            <form action="<?= base_url('pemberangkatan/laporan') ?>" method="get" class="row g-3 align-items-end">
                <div class="col-md-8">
                    <label class="form-label fw-bold"><i class="fas fa-map-marker-alt text-danger me-2"></i>Pilih Tujuan Wisata</label>
                    <select name="tujuan" class="form-select form-select-lg border-2" required>
                        <option value="" selected disabled>-- Pilih Kota Tujuan --</option>
                        <?php foreach($daftar_tujuan as $t): ?>
                            <option value="<?= $t['tujuan'] ?>" <?= ($tujuan_pilihan == $t['tujuan']) ? 'selected' : '' ?>>
                                <?= strtoupper($t['tujuan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                        <i class="fas fa-filter me-2"></i>Tampilkan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if ($tujuan_pilihan): ?>
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Data Tujuan: <?= strtoupper($tujuan_pilihan) ?></h5>
            <button onclick="window.print()" class="btn btn-light btn-sm no-print">
                <i class="fas fa-print me-1"></i> Cetak Laporan
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="align-middle text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Paket Wisata</th>
                            <th>No. Polisi</th>
                            <th>Sopir</th>
                            <th>Tgl Berangkat</th>
                            <th>Tgl Kembali</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php if(empty($laporan)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                    Belum ada data perjalanan ke tujuan ini.
                                </td>
                            </tr>
                        <?php else: $no=1; foreach ($laporan as $l): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="fw-bold"><?= $l['nama_paket'] ?></td>
                                <td class="text-center text-primary fw-bold"><?= $l['nomor_polisi'] ?></td>
                                <td><?= $l['sopir'] ?></td>
                                <td class="text-center"><?= date('d/m/Y', strtotime($l['tanggal_berangkat'])) ?></td>
                                <td class="text-center"><?= date('d/m/Y', strtotime($l['tanggal_kembali'])) ?></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white text-muted small text-end py-3">
            Dicetak pada: <?= date('d M Y, H:i') ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>