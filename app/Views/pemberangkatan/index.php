<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<div class="container p-4">
    <h3>Data Pemberangkatan</h3>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForm" onclick="tambah()">
        Tambah Pemberangkatan
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemesanan</th>
                <th>Bus</th>
                <th>Sopir</th>
                <th>Kernet</th>
                <th>Tanggal Berangkat</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($pemberangkatan as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['idpemesanan'] ?> (<?= $p['tanggal_pesan'] ?>)</td>
                <td><?= $p['nomor_polisi'] ?> - <?= $p['merek'] ?></td>
                <td><?= $p['sopir'] ?></td>
                <td><?= $p['kernet'] ?></td>
                <td><?= $p['tanggalberangkat'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(<?= $p['idberangkat'] ?>)">Edit</button>
                    <a href="/pemberangkatan/delete/<?= $p['idberangkat'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/pemberangkatan/save" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Pemberangkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idberangkat" id="idberangkat">

                <div class="mb-3">
                    <label>Pemesanan</label>
                    <select name="idpemesanan" id="idpemesanan" class="form-control" required>
                        <option value="">-- Pilih Pemesanan --</option>
                        <?php foreach ($pemesanan as $pm): ?>
                            <option value="<?= $pm['id'] ?>">#<?= $pm['id'] ?> - <?= $pm['tanggal_pesan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Bus</label>
                    <select name="idbus" id="idbus" class="form-control" required>
                        <option value="">-- Pilih Bus --</option>
                        <?php foreach ($bus as $b): ?>
                            <option value="<?= $b['id'] ?>"><?= $b['nomor_polisi'] ?> - <?= $b['merek'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Sopir</label>
                    <select name="idsopir" id="idsopir" class="form-control" required>
                        <option value="">-- Pilih Sopir --</option>
                        <?php foreach ($sopir as $s): ?>
                            <option value="<?= $s['idkaryawan'] ?>"><?= $s['nama_karyawan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Kernet</label>
                    <select name="idkernet" id="idkernet" class="form-control" required>
                        <option value="">-- Pilih Kernet --</option>
                        <?php foreach ($kernet as $k): ?>
                            <option value="<?= $k['idkaryawan'] ?>"><?= $k['nama_karyawan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Berangkat</label>
                    <input type="date" name="tanggalberangkat" id="tanggalberangkat" class="form-control" required>
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
    document.getElementById('modalTitle').innerText = 'Tambah Pemberangkatan';
    document.getElementById('idberangkat').value = '';
    document.getElementById('idpemesanan').value = '';
    document.getElementById('idbus').value = '';
    document.getElementById('idsopir').value = '';
    document.getElementById('idkernet').value = '';
    document.getElementById('tanggalberangkat').value = '';
}

function edit(id) {
    fetch('/pemberangkatan/getPemberangkatan/' + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById('modalTitle').innerText = 'Edit Pemberangkatan';
            document.getElementById('idberangkat').value = data.idberangkat;
            document.getElementById('idpemesanan').value = data.idpemesanan;
            document.getElementById('idbus').value = data.idbus;
            document.getElementById('idsopir').value = data.idsopir;
            document.getElementById('idkernet').value = data.idkernet;
            document.getElementById('tanggalberangkat').value = data.tanggalberangkat;
            new bootstrap.Modal(document.getElementById('modalForm')).show();
        });
}
</script>

<?= $this->endSection() ?>
