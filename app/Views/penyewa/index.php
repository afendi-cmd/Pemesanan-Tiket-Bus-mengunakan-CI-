<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h3>Data Penyewa</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Penyewa
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Penyewa</th>
                <th>Alamat</th>
                <th>No TELP</th>
                <th>Email</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($penyewa as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['nama_penyewa'] ?></td>
                <td><?= $p['alamat'] ?></td>
                <td><?= $p['no_telp'] ?></td>
                <td><?= $p['email'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $p['id'] ?>)">Edit</button>
                    <a href="/penyewa/delete/<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/penyewa/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Penyewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="mb-3">
                    <label>Nama Penyewa</label>
                    <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No Telp </label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
            </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
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
    document.getElementById('modalTitle').innerText = 'Tambah Penyewa';
    document.getElementById('id').value = '';
    document.getElementById('nama_penyewa').value = '';
    document.getElementById('alamat').value = '';
    document.getElementById('no_telp').value = '';
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
}

function edit(id) {
    fetch('/penyewa/getPenyewa/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Penyewa';
            document.getElementById('id').value = data.id;
            document.getElementById('nama_penyewa').value = data.nama_penyewa;
            document.getElementById('alamat').value = data.alamat;
            document.getElementById('no_telp').value = data.no_telp;
            document.getElementById('email').value = data.email;
            document.getElementById('password').value = '';
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

</body>
</html>
<?= $this->endSection() ?>
