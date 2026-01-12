<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary bg-gradient text-white py-4 text-center">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-bus-alt me-2"></i>Atur Keberangkatan
                    </h4>
                    <p class="small mb-0 opacity-75">
                        Lengkapi data armada dan kru sebelum berangkat
                    </p>
                </div>

                <div class="card-body p-4 p-md-5">

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-light border-start border-primary mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-invoice text-primary fs-3 me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">
                                    Pesanan #<?= esc($pesanan['id']) ?>
                                </h6>
                                <small class="text-muted">
                                    <?= esc($pesanan['nama_paket']) ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <?php
                        $oldBus     = old('idbus') ?? '';
                        $oldSopir   = old('idsopir') ?? '';
                        $oldKernet  = old('idkernet') ?? '';
                        // Default to today if no old input present
                        $oldTanggal = old('tanggalberangkat') ?: date('Y-m-d');
                    ?>

                    <form action="<?= base_url('keberangkatan/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="idpemesanan" value="<?= esc($pesanan['id']) ?>">

                        <!-- BUS -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">
                                <i class="fas fa-shuttle-van me-2"></i>Bus (Armada)
                            </label>
                            <select name="idbus" class="form-select form-select-lg border-2 shadow-sm" required>
                                <option value="" disabled selected>-- Pilih Armada --</option>
                                <?php foreach ($bus as $b): ?>
                                    <option value="<?= esc($b['id']) ?>" <?= $oldBus == $b['id'] ? 'selected' : '' ?>>
                                        <?= esc($b['nomor_polisi']) ?>
                                        <?= isset($b['merek']) ? ' - '.esc($b['merek']) : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (session()->getFlashdata('error_bus')): ?>
                                <div class="text-danger small mt-2">
                                    <?= session()->getFlashdata('error_bus') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <!-- SOPIR -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-user-tie me-2"></i>Sopir
                                </label>
                                <select name="idsopir" class="form-select border-2 shadow-sm" required>
                                    <option value="" disabled selected>Pilih Sopir</option>
                                    <?php foreach ($sopir as $s): ?>
                                        <option value="<?= esc($s['idkaryawan']) ?>" <?= $oldSopir == $s['idkaryawan'] ? 'selected' : '' ?>>
                                            <?= esc($s['nama_karyawan']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session()->getFlashdata('error_sopir')): ?>
                                    <div class="text-danger small mt-2">
                                        <?= session()->getFlashdata('error_sopir') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- KERNET -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-user-friends me-2"></i>Kernet
                                </label>
                                <select name="idkernet" class="form-select border-2 shadow-sm" required>
                                    <option value="" disabled selected>Pilih Kernet</option>
                                    <?php foreach ($kernet as $k): ?>
                                        <option value="<?= esc($k['idkaryawan']) ?>" <?= $oldKernet == $k['idkaryawan'] ? 'selected' : '' ?>>
                                            <?= esc($k['nama_karyawan']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session()->getFlashdata('error_kernet')): ?>
                                    <div class="text-danger small mt-2">
                                        <?= session()->getFlashdata('error_kernet') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- TANGGAL -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">
                                <i class="fas fa-calendar-check me-2"></i>Tanggal Keberangkatan
                            </label>
                            <input type="date"
                                   id="tanggalberangkat"
                                   name="tanggalberangkat"
                                   class="form-control form-control-lg border-2 shadow-sm"
                                   value="<?= esc($oldTanggal) ?>"
                                   required>
                        </div>

                        <div class="d-grid gap-2 pt-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i>Konfirmasi Sekarang
                            </button>
                            <a href="<?= base_url('pemesanan/tampil') ?>" class="btn btn-link text-muted">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', async function () {

    const apiUnavailable = '<?= base_url('pemberangkatan/unavailable') ?>';
    const apiRemoved     = '<?= base_url('pemberangkatan/removed') ?>';

    const tanggal = document.getElementById('tanggalberangkat');
    const bus     = document.querySelector('select[name="idbus"]');
    const sopir   = document.querySelector('select[name="idsopir"]');
    const kernet  = document.querySelector('select[name="idkernet"]');

    const cloneOptions = sel => [...sel.options].map(o => ({v:o.value, t:o.text}));

    const origin = {
        bus: cloneOptions(bus),
        sopir: cloneOptions(sopir),
        kernet: cloneOptions(kernet)
    };

    let removed = {bus:[], sopir:[], kernet:[]};

    try {
        const res = await fetch(apiRemoved);
        removed = await res.json();
    } catch {}

    function rebuild(sel, original, exclude) {
        sel.innerHTML = '';
        original.forEach(o => {
            if (o.v === '' || !exclude.includes(o.v)) {
                sel.add(new Option(o.t, o.v));
            }
        });
    }

    async function update() {
        let unavailable = {bus:[], sopir:[], kernet:[]};

        if (tanggal.value) {
            const res = await fetch(apiUnavailable + '?tanggal=' + tanggal.value);
            unavailable = await res.json();
        }

        rebuild(bus, origin.bus, [...removed.bus, ...unavailable.bus].map(String));
        rebuild(sopir, origin.sopir, [...removed.sopir, ...unavailable.sopir].map(String));
        rebuild(kernet, origin.kernet, [...removed.kernet, ...unavailable.kernet].map(String));
    }

    await update();
    tanggal.addEventListener('change', update);
});
</script>
