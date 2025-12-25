<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Data Pemberangkatan</title>
    <style>body{font-family:Arial, sans-serif}table{width:100%;border-collapse:collapse}th,td{padding:8px;border:1px solid #ddd}th{background:#f2f2f2}</style>
</head>
<body onload="window.print()">
    <h1>Laporan Data Pemberangkatan</h1>
    <p><strong>Tanggal Cetak:</strong> <?= date('d F Y') ?></p>
    <table>
        <thead>
            <tr><th style="width:60px;text-align:center">No</th><th>Pemesanan</th><th>Tanggal Berangkat</th><th>Bus</th><th>Sopir</th><th>Kernet</th></tr>
        </thead>
        <tbody>
            <?php if(!empty($pemberangkatan)): ?>
                <?php $no=1; foreach($pemberangkatan as $p): ?>
                <tr>
                    <td style="text-align:center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($p['idpemesanan'] ?? '') ?> (<?= htmlspecialchars($p['tanggal_pesan'] ?? '') ?>)</td>
                    <td><?= htmlspecialchars($p['tanggalberangkat'] ?? '') ?></td>
                    <td><?= htmlspecialchars(($p['nomor_polisi'] ?? '') . ' - ' . ($p['merek'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($p['sopir'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['kernet'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>