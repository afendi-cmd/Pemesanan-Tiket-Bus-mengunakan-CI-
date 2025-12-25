<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<div class="container p-4">
    <h3>Data Pembayaran</h3>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Pembayaran
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah Bayar</th>
                <th>Total Bayar (Tagihan)</th>
                <th>Metode Bayar</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($pembayaran as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama_penyewa'] ?? '-' ?></td>
                <td><?= $p['tanggal_bayar'] ?></td>
                <td>Rp <?= number_format($p['jumlah_bayar'],0,',','.') ?></td>
                <td>Rp <?= number_format($p['total_bayar'],0,',','.') ?></td>
                <td><?= $p['metode_bayar'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $p['id'] ?>)">Edit</button>
                    <a href="/pembayaran/delete/<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/pembayaran/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="mb-3">
                    <label for="id_pemesanan">Pemesanan</label>
                    <select name="id_pemesanan" id="id_pemesanan" class="form-control" required>
                        <option value="">-- Pilih Pemesanan --</option>
                        <?php foreach ($pemesanan as $pm): ?>
                            <option value="<?= $pm['id'] ?>">
                                <?= $pm['id'] ?> - <?= $pm['tanggal_pesan'] ?> (Rp <?= number_format($pm['total_bayar'],0,',','.') ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_bayar">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="metode_bayar">Metode Bayar</label>
                    <input type="text" name="metode_bayar" id="metode_bayar" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function tambah() {
    document.getElementById('modalTitle').innerText = 'Tambah Pembayaran';
    document.getElementById('id').value = '';
    document.getElementById('id_pemesanan').value = '';
    document.getElementById('tanggal_bayar').value = '';
    document.getElementById('jumlah_bayar').value = '';
    document.getElementById('metode_bayar').value = '';
}

function edit(id) {
    fetch('/pembayaran/getPembayaran/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Pembayaran';
            document.getElementById('id').value = data.id;
            document.getElementById('id_pemesanan').value = data.id_pemesanan;
            document.getElementById('tanggal_bayar').value = data.tanggal_bayar;
            document.getElementById('jumlah_bayar').value = data.jumlah_bayar;
            document.getElementById('metode_bayar').value = data.metode_bayar;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

<?= $this->endSection() ?>
