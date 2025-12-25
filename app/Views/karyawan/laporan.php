<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<!-- Menambahkan CSS Bootstrap & FontAwesome melalui CDN jika belum ada di layout/main -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .card-header-custom {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
        transition: background-color 0.2s ease;
    }
    .btn-print {
        background-color: #dc3545;
        color: white;
        transition: all 0.3s;
    }
    .btn-print:hover {
        background-color: #bb2d3b;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .table thead th {
        background-color: #007bff;
        color: white;
        border: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    .badge-id {
        background-color: #e9ecef;
        color: #495057;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 4px;
    }
</style>

<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header card-header-custom d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-primary fw-bold">
                <i class="fas fa-users me-2"></i>Daftar Karyawan
            </h5>
            <a href="<?= base_url('laporankaryawan/cetak') ?>" target="_blank" class="btn btn-print btn-sm px-3">
                <i class="fas fa-print me-2"></i>Cetak PDF / Print
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="80">ID</th>
                            <th>Nama Karyawan</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($karyawan)): ?>
                            <?php foreach($karyawan as $k) : ?>
                            <tr>
                                <td class="text-center">
                                    <span class="badge-id"><?= $k['idkaryawan'] ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $k['nama_karyawan'] ?></div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                        <?= $k['alamat'] ?>
                                    </small>
                                </td>
                                <td>
                                    <a href="mailto:<?= $k['email'] ?>" class="text-decoration-none text-primary">
                                        <i class="fas fa-envelope me-1"></i>
                                        <?= $k['email'] ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <!-- Placeholder untuk tombol edit/hapus jika dibutuhkan di masa depan -->
                                    <button class="btn btn-outline-secondary btn-sm border-0">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-info-circle me-2"></i>Data karyawan tidak ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white text-muted small py-3">
            Menampilkan total <strong><?= count($karyawan) ?></strong> karyawan.
        </div>
    </div>
</div>

<?= $this->endSection() ?>