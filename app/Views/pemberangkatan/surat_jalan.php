<html>
<head>
    <title>Surat Jalan (<?= $detail['idberangkat'] ?>)</title>
    <style>
        body { font-family: serif; padding: 30px; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #000; margin-bottom: 20px; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .content-table th, .content-table td { text-align: left; padding: 8px; vertical-align: top; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; }
        .signature { text-align: center; width: 200px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="header">
    <h1>SURAT JALAN KEBERANGKATAN</h1>
    <p>Nomor Registrasi: PB-<?= $detail['idberangkat'] ?></p>
</div>

<table class="content-table">
    <tr>
        <th width="30%">Nama Paket</th>
        <td>: <?= $detail['nama_paket'] ?> (Tujuan: <?= $detail['tujuan'] ?>)</td>
    </tr>
    <tr>
        <th>Tanggal Berangkat</th>
        <td>: <?= date('d F Y', strtotime($detail['tanggalberangkat'])) ?></td>
    </tr>
    <tr>
        <td colspan="2"><hr></td>
    </tr>
    <tr>
        <th>Armada Bus</th>
        <td>: <?= $detail['nomor_polisi'] ?> - <?= $detail['merek'] ?></td>
    </tr>
    <tr>
        <th>Sopir Utama</th>
        <td>: <?= $detail['nama_sopir'] ?></td>
    </tr>
    <tr>
        <th>Kernet</th>
        <td>: <?= $detail['nama_kernet'] ?></td>
    </tr>
</table>

<div class="footer">
    <div class="signature">
        <p>Sopir,</p>
        <br><br>
        ( <?= $detail['nama_sopir'] ?> )
    </div>
    <div class="signature">
        <p>Admin Operasional,</p>
        <br><br>
        ( ......................... )
    </div>
</div>

<div class="no-print" style="margin-top: 20px;">
    <button onclick="window.print()">Klik Cetak</button>
    <button onclick="window.close()">Tutup Halaman</button>
</div>

</body>
</html>
