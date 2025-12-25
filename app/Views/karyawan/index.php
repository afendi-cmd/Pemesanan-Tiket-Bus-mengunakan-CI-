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
    <h3>Data Karyawan</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Karyawan
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($karyawan as $k): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['nik_karyawan'] ?></td>
                <td><?= $k['nama_karyawan'] ?></td>
                <td><?= $k['namajabatan'] ?></td>
                <td><?= $k['alamat'] ?></td>
                <td><?= $k['nohp'] ?></td>
                <td><?= $k['email'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $k['idkaryawan'] ?>)">Edit</button>
                    <a href="/karyawan/delete/<?= $k['idkaryawan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/karyawan/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idkaryawan" id="idkaryawan">

                <div class="mb-3">
                    <label>NIK Karyawan</label>
                    <input type="text" name="nik_karyawan" id="nik_karyawan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jabatan</label>
                    <select name="idjabatan" id="idjabatan" class="form-control" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <?php foreach ($jabatan as $j): ?>
                            <option value="<?= $j['id'] ?>"><?= $j['namajabatan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="nohp" id="nohp" class="form-control" required>
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
    document.getElementById('modalTitle').innerText = 'Tambah Karyawan';
    document.getElementById('idkaryawan').value = '';
    document.getElementById('nik_karyawan').value = '';
    document.getElementById('nama_karyawan').value = '';
    document.getElementById('alamat').value = '';
    document.getElementById('nohp').value = '';
    document.getElementById('idjabatan').value = '';4
     document.getElementById('email').value = '';
    document.getElementById('password').value = '';
   
}

function edit(id) {
    fetch('/karyawan/getKaryawan/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Karyawan';
            document.getElementById('idkaryawan').value = data.idkaryawan;
            document.getElementById('nik_karyawan').value = data.nik_karyawan;
            document.getElementById('nama_karyawan').value = data.nama_karyawan;
            document.getElementById('alamat').value = data.alamat;
            document.getElementById('nohp').value = data.nohp;
            document.getElementById('idjabatan').value = data.idjabatan;
            document.getElementById('email').value = data.email;
            document.getElementById('password').value = '';
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

</body>
</html>
<?= $this->endSection() ?>
