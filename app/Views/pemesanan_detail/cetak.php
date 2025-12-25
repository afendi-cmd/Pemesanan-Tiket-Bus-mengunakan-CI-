<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Data Pemesanan Detail</title>
    <style>body{font-family:Arial, sans-serif}table{width:100%;border-collapse:collapse}th,td{padding:8px;border:1px solid #ddd}th{background:#f2f2f2}</style>
</head>
<body onload="window.print()">
    <h1>Laporan Data Pemesanan Detail</h1>
    <p><strong>Tanggal Cetak:</strong> <?= date('d F Y') ?></p>
    <table>
        <thead>
            <tr><th style="width:60px;text-align:center">No</th><th>ID Pemesanan</th><th>Penyewa</th><th>Paket</th><th>Tgl Berangkat</th><th>Tgl Kembali</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            <?php if(!empty($pemesanan_detail)): ?>
                <?php $no=1; foreach($pemesanan_detail as $d): ?>
                <tr>
                    <td style="text-align:center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($d['id_pemesanan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($d['nama_penyewa'] ?? '') ?></td>
                    <td><?= htmlspecialchars($d['nama_paket'] ?? '') ?></td>
                    <td><?= htmlspecialchars($d['tanggal_berangkat'] ?? '') ?></td>
                    <td><?= htmlspecialchars($d['tanggal_kembali'] ?? '') ?></td>
                    <td><?= htmlspecialchars($d['jumlah_penumpang'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>