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
    <h3>Data Paket Bus</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Paket Bus
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Paket wisata</th>
                <th>BUS</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($paketbus as $pb): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $pb['nama_paket'] ?></td>
                <td><?= $pb['nomor_polisi'] ?>-<?= $pb['merek'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $pb['id'] ?>)">Edit</button>
                    <a href="/paketbus/delete/<?= $pb['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/paketbus/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Paket Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idpaketbus" id="idpaketbus">

                <div class="mb-3">
                    <label for="paket_wisata">Paket Wisata</label>
                    <select name="paket_wisata" id="paket_wisata" class="form-control" required>
                        <option value="">-- Pilih Paket Wisata --</option>
                        <?php foreach ($paketwisata as $pw): ?>
                            <option value="<?= $pw['id'] ?>"><?= $pw['nama_paket'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bus">Bus</label>
                    <select name="bus" id="bus" class="form-control" required>
                        <option value="">-- Pilih Bus --</option>
                        <?php foreach ($bus as $b): ?>
                            <option value="<?= $b['id'] ?>"><?= $b['nomor_polisi'] ?> - <?= $b['merek'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function tambah() {
    document.getElementById('modalTitle').innerText = 'Tambah Paket Bus';
    document.getElementById('idpaketbus').value = '';
    document.getElementById('paket_wisata').value = '';
    document.getElementById('bus').value = '';
}

function edit(id) {
    fetch('/paketbus/getPaketBus/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Paket Bus';
            document.getElementById('idpaketbus').value = data.idpaketbus;
            document.getElementById('paket_wisata').value = data.id_paketwisata;
            document.getElementById('bus').value = data.id_bus;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

</body>
</html>
<?= $this->endSection() ?>
