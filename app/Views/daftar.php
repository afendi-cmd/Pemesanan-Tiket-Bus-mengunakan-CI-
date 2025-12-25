<!-- Modal Form Daftar / Tambah Penyewa -->
<div class="modal fade" id="modalDaftarPenyewa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('penyewa/save') ?>" method="post" class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleDaftar">Daftar Penyewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="idDaftar">

                <div class="mb-3">
                    <label>Nama Penyewa</label>
                    <input type="text" name="nama_penyewa" id="namaDaftar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamatDaftar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No Telp</label>
                    <input type="text" name="no_telp" id="telpDaftar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" id="emailDaftar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" id="passwordDaftar" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>

        </form>
    </div>
</div>
<script>
    
function daftarSekarang() {
    // Set Mode Tambah
    document.getElementById('modalTitleDaftar').innerText = 'Daftar Penyewa';
    document.getElementById('idDaftar').value = '';
    document.getElementById('namaDaftar').value = '';
    document.getElementById('alamatDaftar').value = '';
    document.getElementById('telpDaftar').value = '';
    document.getElementById('emailDaftar').value = '';
    document.getElementById('passwordDaftar').value = '';

    new bootstrap.Modal(document.getElementById('modalDaftarPenyewa')).show();
}
</script>
