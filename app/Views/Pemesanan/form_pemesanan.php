<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Bus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; }
        .card-header { background-color: #0d6efd; color: white; border-radius: 15px 15px 0 0 !important; }
        .total-box { background-color: #e9ecef; padding: 20px; border-radius: 10px; border-left: 5px solid #0d6efd; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-header p-3">
                    <h5 class="mb-0">Form Reservasi Bus Pariwisata</h5>
                </div>

                <div class="card-body p-4">
                    <form action="<?= base_url('pemesanan/simpan') ?>" method="post">
                        <?= csrf_field() ?>

                        <?php if (!empty($isAdmin)): ?>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Pilih Penyewa</label>
                                <select name="id_penyewa" class="form-select" required>
                                    <option value="">-- Pilih Penyewa --</option>
                                    <?php foreach ($penyewa_list as $pen): ?>
                                        <option value="<?= $pen['id'] ?>"><?= esc($pen['nama_penyewa']) ?> <?= isset($pen['email']) ? '('.esc($pen['email']).')' : '' ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Pilih Paket Wisata & Bus</label>
                                <select name="id_paketbus" id="id_paketbus" class="form-select form-select-lg" onchange="hitungOtomatis()" required>
                                    <option value="" data-harga="0">-- Pilih Paket Perjalanan --</option>
                                    <?php foreach ($paket_bus as $p): ?>
                                        <option value="<?= $p['id_paketbus'] ?>" data-harga="<?= $p['harga'] ?>">
                                            <?= $p['nama_paket'] ?> - <?= $p['tujuan'] ?>
                                            (Rp <?= number_format($p['harga'], 0, ',', '.') ?> /hari)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Berangkat</label>
                                <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control" min="<?= date('Y-m-d') ?>" onchange="hitungOtomatis()" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" onchange="hitungOtomatis()" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Jumlah Penumpang</label>
                                <input type="number" name="jml_penumpang" class="form-control" placeholder="0" required>
                            </div>
                        </div>

                        <div class="total-box mb-4">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <small class="text-muted d-block text-uppercase">Durasi Sewa</small>
                                    <span id="label_durasi" class="h4 fw-bold">0</span>
                                    <span class="h5">Hari</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block text-uppercase">Estimasi Total Bayar</small>
                                    <span class="h4 fw-bold text-primary" id="label_total">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                Konfirmasi & Simpan Pemesanan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function hitungOtomatis() {
    const selectPaket = document.getElementById('id_paketbus');
    const hargaPerHari = parseFloat(
        selectPaket.options[selectPaket.selectedIndex].getAttribute('data-harga')
    ) || 0;

    const tglAwal = document.getElementById('tgl_berangkat').value;
    const tglAkhir = document.getElementById('tgl_kembali').value;

    if (tglAwal && tglAkhir) {
        const d1 = new Date(tglAwal);
        const d2 = new Date(tglAkhir);

        // Milidetik ke hari
        const selisihWaktu = d2.getTime() - d1.getTime();
        let selisihHari = Math.ceil(selisihWaktu / (1000 * 3600 * 24)) + 1;

        // Validasi jika tanggal kembali sebelum tanggal berangkat
        if (selisihHari <= 0) {
            alert("Peringatan: Tanggal kembali harus setelah tanggal berangkat!");
            document.getElementById('tgl_kembali').value = '';
            selisihHari = 0;
        }

        const totalBiaya = selisihHari * hargaPerHari;

        // Update tampilan
        document.getElementById('label_durasi').innerText = selisihHari;
        document.getElementById('label_total').innerText =
            "Rp " + totalBiaya.toLocaleString('id-ID');
    }
}
</script>

</body>
</html>

<?= $this->endSection() ?>
