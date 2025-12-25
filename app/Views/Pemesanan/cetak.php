<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Data Pemesanan</title>
    <style>body{font-family:Arial, sans-serif}table{width:100%;border-collapse:collapse}th,td{padding:8px;border:1px solid #ddd}th{background:#f2f2f2}</style>
</head>
<body onload="window.print()">
    <h1>Laporan Data Pemesanan</h1>
    <p><strong>Tanggal Cetak:</strong> <?= date('d F Y') ?></p>
    <table>
        <thead>
            <tr><th style="width:60px;text-align:center">No</th><th>Tanggal Pesan</th><th>Penyewa</th><th>Paket</th><th>Total Bayar</th></tr>
        </thead>
        <tbody>
            <?php if(!empty($pemesanan)): ?>
                <?php $no=1; foreach($pemesanan as $p): ?>
                <tr>
                    <td style="text-align:center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($p['tanggal_pesan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['nama_penyewa'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['nama_paket'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['total_bayar'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>