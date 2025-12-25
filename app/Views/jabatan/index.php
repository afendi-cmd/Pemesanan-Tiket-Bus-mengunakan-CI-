<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Jabatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h3>Data Jabatan</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()"> Tambah Jabatan </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Nama Jabatan</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($jabatan as $j): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $j['namajabatan'] ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="edit(<?= $j['id'] ?>)">Edit</button>
                    <a href="/jabatan/delete/<?= $j['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/jabatan/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                    <label>Nama Jabatan</label>
                    <input type="text" name="namajabatan" id="namajabatan" class="form-control" required>
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
    document.getElementById('modalTitle').innerText = 'Tambah Jabatan';
    document.getElementById('id').value = '';
    document.getElementById('namajabatan').value = '';
}

function edit(id) {
    fetch('/jabatan/getJabatan/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Jabatan';
            document.getElementById('id').value = data.id;
            document.getElementById('namajabatan').value = data.namajabatan;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

</body>
</html>
<?= $this->endSection() ?>
