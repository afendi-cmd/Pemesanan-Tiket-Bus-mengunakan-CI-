<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pemesanan Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h3>Data Pemesanan Detail</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Pemesanan Detail
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemesan</th>
                <th>Paket Wisata</th>
                <th>Bus</th>
                <th>Tanggal Berangkat</th>
                <th>Tanggal Kembali</th>
                <th>Jumlah Penumpang</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($pemesanan_detail as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama_penyewa'] ?? '-' ?></td>
                <td><?= $d['nama_paket'] ?? '-' ?></td>
                <td><?= $d['nomor_polisi'] ?? '-' ?> - <?= $d['merek'] ?? '-' ?></td>
                <td><?= $d['tanggal_berangkat'] ?></td>
                <td><?= $d['tanggal_kembali'] ?></td>
                <td><?= $d['jumlah_penumpang'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $d['id'] ?>)">Edit</button>
                    <a href="/pemesanan_detail/delete/<?= $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/pemesanan_detail/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Pemesanan Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="mb-3">
                    <label for="id_pemesanan">Pemesanan</label>
                    <select name="id_pemesanan" id="id_pemesanan" class="form-control" required>
                        <option value="">-- Pilih Pemesanan --</option>
                        <?php foreach ($pemesanan as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['id'] ?> - <?= $p['tanggal_pesan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_berangkat">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kembali">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah_penumpang">Jumlah Penumpang</label>
                    <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" class="form-control" required>
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
    document.getElementById('modalTitle').innerText = 'Tambah Pemesanan Detail';
    document.getElementById('id').value = '';
    document.getElementById('id_pemesanan').value = '';
    document.getElementById('tanggal_berangkat').value = '';
    document.getElementById('tanggal_kembali').value = '';
    document.getElementById('jumlah_penumpang').value = '';
}

function edit(id) {
    fetch('/pemesanan_detail/getDetail/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Pemesanan Detail';
            document.getElementById('id').value = data.id;
            document.getElementById('id_pemesanan').value = data.id_pemesanan;
            document.getElementById('tanggal_berangkat').value = data.tanggal_berangkat;
            document.getElementById('tanggal_kembali').value = data.tanggal_kembali;
            document.getElementById('jumlah_penumpang').value = data.jumlah_penumpang;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        })
        .catch(err => alert('Gagal memuat data untuk diedit.'));
}
</script>

</body>
</html>
<?= $this->endSection() ?>
