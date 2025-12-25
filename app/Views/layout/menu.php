<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>

<?php
$uri = service('uri');
$isLoggedIn = session()->get('isLoggedIn');
$userSource = session()->get('userSource');
$userData = session()->get('userData') ?? [];

// Determine level
$level = 0;
if ($userSource === 'karyawan') {
    $idjabatan = $userData['idjabatan'] ?? null;

    if ($idjabatan == 1) {
        $level = 1; // Admin
    } elseif ($idjabatan == 2) {
        $level = 2; // Pemilik
    } elseif ($idjabatan == 3) {
        $level = 3; // Sopir
    } else {
        $level = 4; // Penyewa
    }
} elseif ($userSource === 'penyewa') {
    $level = 4; // Semua penyewa (idjabatan 0)
}
?>

<?php if ($isLoggedIn): ?>

    <?php if ($level == 1): ?>
        <!-- Menu Admin & Pemilik (Level 1 & 2) -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-home text-xl w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- MASTER DATA -->
        <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <div class="flex items-center">
                    <i class="mdi mdi-database text-xl w-6 mr-3"></i>
                    <span>Master Data</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>

            <ul class="list-unstyled pl-8 space-y-1.5 pt-1.5 hidden">
                <li><a href="<?= base_url('jabatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-account-group text-base w-4 mr-3"></i> Jabatan</a></li>
                <li><a href="<?= base_url('karyawan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-account-multiple text-base w-4 mr-3"></i> Karyawan</a></li>
                <li><a href="<?= base_url('penyewa') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-account-card-details text-base w-4 mr-3"></i> Penyewa</a></li>
                <li><a href="<?= base_url('jenisbus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-steering text-base w-4 mr-3"></i> Jenis Bus</a></li>
                <li><a href="<?= base_url('bus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-bus-alert text-base w-4 mr-3"></i> Bus</a></li>
                <li><a href="<?= base_url('paketbus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-package text-base w-4 mr-3"></i> Paket Bus</a></li>
                <li><a href="<?= base_url('paketwisata') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-map text-base w-4 mr-3"></i> Paket Wisata</a></li>
            </ul>
        </li>

        <!-- TRANSAKSI & LAPORAN -->
        <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <div class="flex items-center">
                    <i class="mdi mdi-swap-horizontal text-xl w-6 mr-3"></i>
                    <span>Transaksi</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>

            <ul class="list-unstyled pl-8 space-y-1.5 pt-1.5 hidden">
                <li><a href="<?= base_url('pemesanan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-cart text-base w-4 mr-3"></i> Pemesanan</a></li>
                <li><a href="<?= base_url('pemesanan_detail') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-format-list-bulleted text-base w-4 mr-3"></i> Pemesanan Detail</a></li>
                <li><a href="<?= base_url('pembayaran') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-credit-card text-base w-4 mr-3"></i> Pembayaran</a></li>
                <li><a href="<?= base_url('pemberangkatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-truck-delivery text-base w-4 mr-3"></i> Pemberangkatan</a></li>
                <li><a href="#" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-file-chart text-base w-4 mr-3"></i> Laporan</a></li>
            </ul>
        </li>
         <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <div class="flex items-center">
                    <i class="mdi mdi-file-chart text-xl w-6 mr-3"></i>
                    <span>Laporan</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>
            <ul> 
                <li><a href="<?= base_url('laporankaryawan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-cart text-base w-4 mr-3"></i> Laporan Karyawan</a></li>
                <li><a href="<?= base_url('laporanpemesanan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-format-list-bulleted text-base w-4 mr-3"></i> Laporan Pemesanan</a></li>
                <li><a href="<?= base_url('laporanpembayaran') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-credit-card text-base w-4 mr-3"></i> Laporan Pembayaran</a></li>
                <li><a href="<?= base_url('laporanpemberangkatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-truck-delivery text-base w-4 mr-3"></i> Laporan Pemberangkatan</a></li>
                <li><a href="<?= base_url('laporanbus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-bus text-base w-4 mr-3"></i> Laporan Bus</a></li>
                <li><a href="<?= base_url('laporan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150"><i class="mdi mdi-file-chart text-base w-4 mr-3"></i> Laporan</a></li>
            </ul>

        <!-- AKUN -->
        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-logout text-xl w-6 mr-3"></i>
                <span>Keluar</span>
            </a>
        </li>

        <?php elseif ($level == 2): ?>

        <!-- Menu pemilik -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-home text-xl w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('/pemberangkatan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-bus-clock text-xl w-6 mr-3"></i>
                <span>Jadwal Keberangkatan</span>
            </a>
        </li>

        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="#" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-account-circle text-xl w-6 mr-3"></i>
                <span>LAPORAN</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-logout text-xl w-6 mr-3"></i>
                <span>Keluar</span>
            </a>
        </li>

    <?php elseif ($level == 3): ?>

        <!-- Menu Sopir -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-home text-xl w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('/pemberangkatan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-bus-clock text-xl w-6 mr-3"></i>
                <span>Jadwal Keberangkatan</span>
            </a>
        </li>

        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="#" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-account-circle text-xl w-6 mr-3"></i>
                <span>Profil Saya</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-logout text-xl w-6 mr-3"></i>
                <span>Keluar</span>
            </a>
        </li>

    <?php elseif ($level == 4): ?>

        <!-- Menu Penyewa -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-home text-xl w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Pemesanan</li>
        <li class="mb-1">
            <a href="<?= base_url('bus') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-bus-alert text-xl w-6 mr-3"></i>
                <span>Ketersediaan Bus</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= base_url('pemesanan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-cart-plus text-xl w-6 mr-3"></i>
                <span>Buat Pemesanan</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= base_url('pembayaran') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-credit-card-plus text-xl w-6 mr-3"></i>
                <span>Konfirmasi Pembayaran</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= base_url('pemberangkatan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-calendar-clock text-xl w-6 mr-3"></i>
                <span>Jadwal Keberangkatan</span>
            </a>
        </li>

        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
                <i class="mdi mdi-logout text-xl w-6 mr-3"></i>
                <span>Keluar</span>
            </a>
        </li>

    <?php endif; ?>

<?php else: ?>
    <li class="mb-1">
        <a href="<?= site_url('login') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150">
            <i class="mdi mdi-login text-xl w-6 mr-3"></i>
            <span>Masuk</span>
        </a>
    </li>
<?php endif; ?>

<!-- ============================ -->
<!-- JAVASCRIPT COLLAPSE SUBMENU -->
<!-- ============================ -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('li.has_sub').forEach(function (menu) {

        const button = menu.querySelector('a');
        const submenu = menu.querySelector('ul');
        const icon = menu.querySelector('i.mdi-chevron-right');

        button.addEventListener('click', function () {
            submenu.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
        });

    });

});

function toggleSidebar() {
    $wrapper.toggleClass('enlarged');
    localStorage.setItem('sidebar', $wrapper.hasClass('enlarged') ? 'collapsed' : 'open');
    adjustLayout();
}
if (localStorage.getItem('sidebar') === 'collapsed') {
    $wrapper.addClass('enlarged');
}
adjustLayout();

</script>

<?= $this->endSection() ?>
