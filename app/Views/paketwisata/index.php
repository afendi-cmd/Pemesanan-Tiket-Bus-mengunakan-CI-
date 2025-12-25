<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Paket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h3>Data Paket Wisata</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Paket Wisata
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Paket</th>
                <th>Tujuan</th>
                <th>Harga</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($paketwisata as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama_paket'] ?></td>
                <td><?= $p['tujuan'] ?></td>
                <td><?= $p['harga'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $p['id'] ?>)">Edit</button>
                    <a href="/paketwisata/delete/<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/paketwisata/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Paket Wisata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="mb-3">
                    <label>Nama Paket</label>
                    <input type="text" name="nama_paket" id="nama_paket" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tujuan</label>
                    <input type="text" name="tujuan" id="tujuan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function tambah() {
    document.getElementById('modalTitle').innerText = 'Tambah Paket Wisata';
    document.getElementById('id').value = '';
    document.getElementById('nama_paket').value = '';
    document.getElementById('tujuan').value = '';
    document.getElementById('harga').value = '';
}

function edit(id) {
    fetch('/paketwisata/getPaketWisata/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Paket Wisata';
            document.getElementById('id').value = data.id;
            document.getElementById('nama_paket').value = data.nama_paket;
            document.getElementById('tujuan').value = data.tujuan;
            document.getElementById('harga').value = data.harga;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

</body>
</html>
<?= $this->endSection() ?>
