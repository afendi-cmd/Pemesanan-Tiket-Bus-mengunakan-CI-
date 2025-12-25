<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Bus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h3>Data Bus</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Bus
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nomor Polisi</th>
                <th>Merek</th>
                <th>Kapasitas</th>
                <th>Jenis Bus</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($bus as $b): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $b['nomor_polisi'] ?></td>
                <td><?= $b['merek'] ?></td>
                <td><?= $b['kapasitas'] ?></td>
                <td><?= $b['nama_jenisbus'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $b['id'] ?>)">Edit</button>
                    <a href="/bus/delete/<?= $b['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/bus/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">

                <div class="mb-3">
                    <label>Nomor Polisi</label>
                    <input type="text" name="nomor_polisi" id="nomor_polisi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Merek</label>
                    <input type="text" name="merek" id="merek" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kapasitas</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Bus</label>
                    <select name="id_jenisbus" id="id_jenisbus" class="form-control" required>
                        <option value="">-- Pilih Jenis Bus --</option>
                        <?php foreach ($jenisbus as $j): ?>
                            <option value="<?= $j['id'] ?>"><?= $j['nama_jenisbus'] ?></option>
                        <?php endforeach; ?>
                    </select>
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
    document.getElementById('modalTitle').innerText = 'Tambah Bus';
    document.getElementById('id').value = '';
    document.getElementById('nomor_polisi').value = '';
    document.getElementById('merek').value = '';
    document.getElementById('kapasitas').value = '';
    document.getElementById('id_jenisbus').value = '';
}

function edit(id) {
    fetch('/bus/getBus/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Bus';
            document.getElementById('id').value = data.id;
            document.getElementById('nomor_polisi').value = data.nomor_polisi;
            document.getElementById('merek').value = data.merek;
            document.getElementById('kapasitas').value = data.kapasitas;
            document.getElementById('id_jenisbus').value = data.id_jenisbus;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

</body>
</html>
<?= $this->endSection() ?>
