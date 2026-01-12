<?= $this->extend('layout/main') ?>
<?= $this->section('isi') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    @media print {
        .no-print {
            display: none;
        }
    }
    body {
        font-family: Arial, sans-serif;
        font-size: 11pt;
    }
    .header-laporan {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 3px solid #333;
        padding-bottom: 10px;
    }
    .header-laporan h2 {
        margin: 0;
        font-size: 18pt;
        font-weight: bold;
    }
    .header-laporan p {
        margin: 5px 0;
        font-size: 10pt;
    }
    .info-tanggal {
        margin-bottom: 15px;
        font-size: 11pt;
    }
    .table {
        margin-top: 20px;
    }
    .table th {
        background-color: #f0f0f0;
        border: 1px solid #333;
        font-weight: bold;
        padding: 8px;
    }
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .footer-laporan {
        margin-top: 30px;
        text-align: right;
    }
</style>

<div class="container-lg py-3">
    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print me-2"></i>Cetak
        </button>
        <button onclick="window.history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </button>
    </div>

    <!-- Header Laporan -->
    <div class="header-laporan">
        <h2>LAPORAN PEMBERANGKATAN</h2>
        <h3>PER TANGGAL</h3>
        <p>Tanggal: <?= htmlspecialchars($tanggal_cari) ?></p>
    </div>

    <!-- Informasi Tanggal -->
    <div class="info-tanggal">
        <p><strong>Tanggal Laporan:</strong> <?= htmlspecialchars($tanggal_cari) ?></p>
        <p><strong>Total Pemberangkatan:</strong> <?= count($pemberangkatan) ?> perjalanan</p>
        <p><strong>Tanggal Cetak:</strong> <?= date('d-m-Y H:i:s') ?></p>
    </div>

    <!-- Tabel Data -->
    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 10%;">ID Berangkat</th>
                <th style="width: 12%;">Pemesanan</th>
                <th style="width: 15%;">Bus</th>
                <th style="width: 18%;">No Polisi - Merek</th>
                <th style="width: 15%;">Sopir</th>
                <th style="width: 15%;">Kernet</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pemberangkatan)): ?>
                <?php $no = 1; foreach ($pemberangkatan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($p['idberangkat'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['idpemesanan'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['merek'] ?? '-') ?></td>
                        <td><?= htmlspecialchars(($p['nomor_polisi'] ?? '') . ' - ' . ($p['merek'] ?? '')) ?></td>
                        <td><?= htmlspecialchars($p['sopir'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($p['kernet'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pemberangkatan untuk tanggal ini</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Footer Laporan -->
    <div class="footer-laporan">
        <p>___________________________</p>
        <p style="margin-top: 20px;">Kepala Operasional</p>
        <p style="font-size: 10pt; margin-top: 50px;">Tanda Tangan &amp; Tanggal</p>
    </div>
</div>

<?= $this->endSection() ?>
