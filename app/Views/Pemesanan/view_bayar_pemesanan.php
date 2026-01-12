<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pembayaran</title>
    <!-- Local Bootstrap for offline support -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card-centered { max-width: 500px; margin: 40px auto; }
    </style>
</head>
<body>
<div class="container">
    <div class="card card-centered shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Konfirmasi Pembayaran</h5>
        </div>
        <div class="card-body">
            <p>Pembayaran untuk Pesanan: <strong>#<?= esc($pemesanan->id) ?></strong><br>
            Paket : <?= esc($pemesanan->namapaket ?? $pemesanan->paket ?? '-') ?> (<?= esc($pemesanan->tujuan ?? '-') ?>)</p>

            <form action="<?= base_url('/pemesanan/proses_bayar') ?>" method="post" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="id_pemesanan" value="<?= esc($pemesanan->id) ?>">

                <div class="mb-3">
                    <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                    <input type="date" id="tanggal_bayar" name="tanggal_bayar" class="form-control" required value="<?= date('Y-m-d') ?>">
                </div>

                <div class="mb-3">
                    <label for="nominal" class="form-label">Total Tagihan</label>
                    <input type="text" id="nominal_view" class="form-control" value="Rp <?= number_format($pemesanan->total_bayar ?? 0, 0, ',', '.') ?>" readonly>
                    <input type="hidden" name="nominal" value="<?= esc($pemesanan->total_bayar ?? 0) ?>">
                </div>

                <div class="mb-3">
                    <label for="metode_bayar" class="form-label">Metode Pembayaran</label>
                    <select name="metode_bayar" id="metode_bayar" class="form-select" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Tunai">Tunai</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto_bukti" class="form-label">Upload Bukti Transfer (Foto)</label>
                    <input type="file" name="foto_bukti" id="foto_bukti" class="form-control" accept="image/*" required>
                    <div class="form-text">Opsional untuk <strong>Tunai</strong>. Hanya diperlukan jika melakukan transfer atau e-wallet.</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-success">Kirim Bukti Bayar</button>
                    <a href="<?= base_url('pemesanan/tampil') ?>" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function(){
        const metode = document.getElementById('metode_bayar');
        const foto = document.getElementById('foto_bukti');
        function updateFotoRequired(){
            if (!metode || !foto) return;
            if (metode.value === 'Tunai'){
                foto.removeAttribute('required');
            } else {
                foto.setAttribute('required','required');
            }
        }
        if (metode){
            metode.addEventListener('change', updateFotoRequired);
            // initial
            updateFotoRequired();
        }
    })();
</script>
</body>
</html>
