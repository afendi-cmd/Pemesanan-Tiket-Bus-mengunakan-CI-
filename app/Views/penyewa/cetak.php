<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Penyewa</title>
    <style>
        /* Reset & Base Styles */
        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 40px;
            background-color: #fff;
        }

        /* Container untuk kontrol tampilan di layar */
        .page-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Header Style */
        .report-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            border-bottom: 3px double #333;
            padding-bottom: 25px;
            position: relative;
        }

        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
        }

        /* Desain Logo SVG */
        .company-logo {
            width: 70px;
            height: 70px;
        }

        .header-text {
            text-align: center;
        }

        .report-header h1 {
            margin: 0;
            text-transform: uppercase;
            font-size: 26px;
            letter-spacing: 2px;
            color: #1a1a1a;
        }

        .report-header p {
            margin: 3px 0;
            font-size: 14px;
            color: #555;
        }

        .company-name {
            font-weight: bold;
            color: #000;
            font-size: 16px !important;
        }

        .info-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 13px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        /* Table Style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table thead th {
            background-color: #f8f9fa !important;
            color: #000;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            border: 1px solid #ddd;
            padding: 12px 10px;
        }

        table tbody td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 12px;
            vertical-align: top;
        }

        table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Footer / Tanda Tangan */
        .report-footer {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-box {
            text-align: center;
            width: 250px;
        }

        .signature-space {
            height: 70px;
            margin: 10px 0;
        }

        /* Print Specifics */
        @media print {
            body {
                padding: 0;
                margin: 1cm;
            }

            .no-print {
                display: none;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            
            thead {
                display: table-header-group;
            }

            .report-header {
                border-bottom: 2px solid #000;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="page-container">
        <!-- Header Laporan -->
        <header class="report-header">
            <!-- Logo Perusahaan (SVG) -->
            <div class="logo-container">
                <svg class="company-logo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#333" stroke-width="2"/>
                    <path d="M30 70 L50 30 L70 70 Z" fill="#333" />
                    <path d="M40 70 L50 50 L60 70 Z" fill="#fff" />
                    <circle cx="50" cy="25" r="5" fill="#333" />
                </svg>
            </div>

            <div class="header-text">
                <h1>Laporan Data Penyewa</h1>
                <p class="company-name">PT. INOVASI TEKNOLOGI NUSANTARA</p>
                <p>Gedung Cyber Lt. 5, Jl. Kuningan Barat No. 8, Jakarta Selatan</p>
            </div>
        </header>

        <!-- Informasi Tambahan -->
        <div class="info-meta">
            <span><strong>Dokumen:</strong> Database Pelanggan</span>
            <span><strong>Tanggal Cetak:</strong> <?= date('d F Y') ?></span>
        </div>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th>Nama Penyewa</th>
                    <th style="width: 150px;">No. Telepon</th>
                    <th>Alamat</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($penyewa)): ?>
                    <?php $no=1; foreach($penyewa as $p): ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($p['nama_penyewa'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['no_telp'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['alamat'] ?? '') ?></td>
                        <td style="color: #444;"><?= htmlspecialchars($p['email'] ?? '') ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Mock data untuk demonstrasi tampilan -->
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td style="font-weight: 500;">Andi Wijaya</td>
                        <td>0812-3456-7890</td>
                        <td>Jl. Gatot Subroto No. 45, Jakarta Pusat</td>
                        <td>andi.wijaya@example.com</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">2</td>
                        <td style="font-weight: 500;">Budi Kusuma</td>
                        <td>0856-9876-5432</td>
                        <td>Komp. Perumahan Indah Blok A/12, Tangerang</td>
                        <td>budi.k@example.com</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Bagian Tanda Tangan -->
        <div class="report-footer">
            <div class="signature-box">
                <p>Jakarta, <?= date('d F Y') ?></p>
                <p>Petugas Administrasi,</p>
                <div class="signature-space"></div>
                <p><strong>( <u>Andini Putri, S.Psi</u> )</strong></p>
                <p><small>NIP. 199208152015042001</small></p>
            </div>
        </div>
    </div>

    <!-- Tombol Navigasi Manual -->
    <div class="no-print" style="position: fixed; bottom: 20px; right: 20px;">
        <button onclick="window.print()" style="padding: 12px 24px; cursor: pointer; background: #1a1a1a; color: #fff; border: none; border-radius: 6px; font-weight: bold;">
            Cetak Laporan
        </button>
    </div>
</body>
</html>