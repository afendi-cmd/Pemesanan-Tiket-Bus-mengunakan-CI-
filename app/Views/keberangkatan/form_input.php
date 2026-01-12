<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Atur Keberangkatan</h4>
                    <p class="small mb-0 opacity-75">Lengkapi data armada dan kru sebelum berangkat</p>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="alert alert-light border-start border-primary mb-4">
                        <div><i class="fas fa-file-invoice text-primary me-3"></i>
                            <h6 class="mb-0">Pesanan #<?= esc($pesanan['id']) ?></h6>
                            <small class="text-muted"><?= esc($pesanan['nama_paket']) ?></small>
                        </div>
                    </div>

                    <form action="<?= base_url('keberangkatan/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="idpemesanan" value="<?= esc($pesanan['id']) ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary"><i class="fas fa-shuttle-van me-2"></i>Bus (Armada)</label>
                            <select name="idbus" class="form-select form-select-lg border-2 shadow-sm" required>
                                <option value="" selected disabled>-- Pilih Armada --</option>
                                <?php foreach($bus as $b): ?>
                                    <option value="<?= $b['id'] ?>"><?= esc($b['nomor_polisi']) ?> - <?= esc($b['merek']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary"><i class="fas fa-user-tie me-2"></i>Sopir</label>
                                <select name="idsopir" class="form-select border-2 shadow-sm" required>
                                    <option value="" selected disabled>Pilih Sopir</option>
                                    <?php foreach($sopir as $s): ?>
                                        <option value="<?= $s['idkaryawan'] ?>"><?= esc($s['nama_karyawan']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary"><i class="fas fa-user-friends me-2"></i>Kernet</label>
                                <select name="idkernet" class="form-select border-2 shadow-sm" required>
                                    <option value="" selected disabled>Pilih Kernet</option>
                                    <?php foreach($kernet as $k): ?>
                                        <option value="<?= $k['idkaryawan'] ?>"><?= esc($k['nama_karyawan']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary"><i class="fas fa-calendar-check me-2"></i>Tanggal Keberangkatan</label>
                            <input type="date" name="tanggalberangkat" class="form-control form-control-lg border-2 shadow-sm" required>
                        </div>

                        <div class="d-grid gap-2 pt-3">
                            <button type="submit" class="btn btn-primary btn-lg bg-gradient shadow-sm fw-bold">
                                <i class="fas fa-save me-2"></i>Konfirmasi Sekarang
                            </button>
                            <a href="<?= base_url('pemesanan/tampil') ?>" class="btn btn-link text-decoration-none text-muted">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Riwayat
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>