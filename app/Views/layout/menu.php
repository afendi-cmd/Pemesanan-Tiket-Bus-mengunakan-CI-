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
        <!-- Menu Admin -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-home text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Dashboard</span>
            </a>
        </li>

        <!-- MASTER DATA -->
        <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <div class="flex items-center">
                    <i class="mdi mdi-database text-xl w-6 mr-3 menu-icon"></i>
                    <span class="menu-item-text">Master Data</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>

            <ul class="list-unstyled pl-8 space-y-1.5 pt-1.5 hidden">
                <li><a href="<?= base_url('jabatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-account-group text-base w-4 mr-3"></i> Jabatan</a></li>
                <li><a href="<?= base_url('karyawan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-account-multiple text-base w-4 mr-3"></i> Karyawan</a></li>
                <li><a href="<?= base_url('penyewa') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-account-multiple text-base w-4 mr-3"></i> Penyewa</a></li>
                <li><a href="<?= base_url('jenisbus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-steering text-base w-4 mr-3"></i> Jenis Bus</a></li>
                <li><a href="<?= base_url('bus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-bus-alert text-base w-4 mr-3"></i> Bus</a></li>
                <li><a href="<?= base_url('paketbus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-package text-base w-4 mr-3"></i> Paket Bus</a></li>
                <li><a href="<?= base_url('paketwisata') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-map text-base w-4 mr-3"></i> Paket Wisata</a></li>
            </ul>
        </li>

        <!-- TRANSAKSI -->
        <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <div class="flex items-center">
                    <i class="mdi mdi-swap-horizontal text-xl w-6 mr-3 menu-icon"></i>
                    <span class="menu-item-text">Transaksi</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>

            <ul class="list-unstyled pl-8 space-y-1.5 pt-1.5 hidden">
                <li><a href="<?= base_url('pemesanan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-cart text-base w-4 mr-3"></i> Pemesanan</a></li>
                <li><a href="<?= base_url('pemesanan_detail') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-format-list-bulleted text-base w-4 mr-3"></i> Pemesanan Detail</a></li>
                <li><a href="<?= base_url('pembayaran') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-credit-card text-base w-4 mr-3"></i> Pembayaran</a></li>
                <li><a href="<?= base_url('pemberangkatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-truck-delivery text-base w-4 mr-3"></i> Pemberangkatan</a></li>
            </ul>
        </li>
        
        <!-- LAPORAN -->
        <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <div class="flex items-center">
                    <i class="mdi mdi-file-chart text-xl w-6 mr-3 menu-icon"></i>
                    <span class="menu-item-text">Laporan</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>
            <ul class="list-unstyled pl-8 space-y-1.5 pt-1.5 hidden"> 
                <li><a href="<?= base_url('laporankaryawan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-account-multiple text-base w-4 mr-3"></i> Laporan Karyawan</a></li>
                <li><a href="<?= base_url('laporanpemesanan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-cart text-base w-4 mr-3"></i> Laporan Pemesanan</a></li>
                <li><a href="<?= base_url('laporanpembayaran') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-credit-card text-base w-4 mr-3"></i> Laporan Pembayaran</a></li>
                <li><a href="<?= base_url('laporanpemberangkatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-truck-delivery text-base w-4 mr-3"></i> Laporan Pemberangkatan</a></li>
                <li><a href="<?= base_url('laporanbus') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-bus text-base w-4 mr-3"></i> Laporan Bus</a></li>
                <li><a href="<?= base_url('laporan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-file-chart text-base w-4 mr-3"></i> Laporan Keseluruhan</a></li>
            </ul>
        </li>

        <!-- AKUN -->
        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-logout text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Keluar</span>
            </a>
        </li>

    <?php elseif ($level == 2): ?>
        <!-- Menu Pemilik -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-home text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('/pemberangkatan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-bus-clock text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Jadwal Keberangkatan</span>
            </a>
        </li>
        <li class="has_sub group mb-1">
            <a href="javascript:void(0);" class="flex items-center justify-between py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <div class="flex items-center">
                    <i class="mdi mdi-file-chart text-xl w-6 mr-3 menu-icon"></i>
                    <span class="menu-item-text">Laporan</span>
                </div>
                <i class="mdi mdi-chevron-right text-lg transform transition-transform duration-300"></i>
            </a>
            <ul class="list-unstyled pl-8 space-y-1.5 pt-1.5 hidden"> 
                <li><a href="<?= base_url('laporanpemesanan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-cart text-base w-4 mr-3"></i> Laporan Pemesanan</a></li>
                <li><a href="<?= base_url('laporanpembayaran') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-credit-card text-base w-4 mr-3"></i> Laporan Pembayaran</a></li>
                <li><a href="<?= base_url('laporanpemberangkatan') ?>" class="block py-1.5 px-3 text-sm text-white hover:text-indigo-900 hover:bg-indigo-100 rounded-lg transition duration-150 no-underline"><i class="mdi mdi-truck-delivery text-base w-4 mr-3"></i> Laporan Pemberangkatan</a></li>
            </ul>
        </li>
        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-logout text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Keluar</span>
            </a>
        </li>

    <?php elseif ($level == 3): ?>
        <!-- Menu Sopir -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-home text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('/pemberangkatan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-bus-clock text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Jadwal Keberangkatan</span>
            </a>
        </li>
        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="#" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-account-circle text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Profil Saya</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-logout text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Keluar</span>
            </a>
        </li>

    <?php elseif ($level == 4): ?>
        <!-- Menu Penyewa -->
        <li class="mb-1">
            <a href="<?= site_url('login/dashboard') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-home text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Dashboard</span>
            </a>
        </li>

        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Pemesanan</li>
        <li class="mb-1">
            <a href="<?= base_url('bus') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-bus-alert text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Ketersediaan Bus</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= base_url('pemesanan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-cart-plus text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Buat Pemesanan</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= base_url('pembayaran') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-credit-card-plus text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Konfirmasi Pembayaran</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="<?= base_url('pemberangkatan') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-calendar-clock text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Jadwal Keberangkatan</span>
            </a>
        </li>

        <li class="text-xs uppercase font-semibold text-gray-400 mt-6 mb-2 px-3">Akun</li>
        <li class="mb-1">
            <a href="<?= site_url('login/logout') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
                <i class="mdi mdi-logout text-xl w-6 mr-3 menu-icon"></i>
                <span class="menu-item-text">Keluar</span>
            </a>
        </li>

    <?php endif; ?>

<?php else: ?>
    <li class="mb-1">
        <a href="<?= site_url('login') ?>" class="flex items-center py-2 px-3 text-white hover:bg-indigo-200 hover:text-indigo-900 rounded-lg transition duration-150 no-underline">
            <i class="mdi mdi-login text-xl w-6 mr-3 menu-icon"></i>
            <span class="menu-item-text">Masuk</span>
        </a>
    </li>
<?php endif; ?>

<!-- ============================ -->
<!-- JAVASCRIPT UNTUK SUB-MENU DAN STATE AKTIF (VERSI AMAN) -->
<!-- ============================ -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const currentPath = window.location.pathname;
    const allLinks = document.querySelectorAll('#sidebar-menu a');
    let activeLink = null;

    // 1. Cari dan tandai link yang sedang aktif
    allLinks.forEach(link => {
        link.classList.remove('menu-active');
        const linkPath = new URL(link.href).pathname;
        if (linkPath === currentPath) {
            link.classList.add('menu-active');
        }
    });

    // 2. Cari lagi link yang sudah ditandai aktif
    activeLink = document.querySelector('#sidebar-menu a.menu-active');

    // 3. Buka sub-menu jika halaman aktif berada di dalamnya
    if (activeLink) {
        const parentSubmenu = activeLink.closest('li.has_sub');
        if (parentSubmenu) {
            const submenu = parentSubmenu.querySelector('ul');
            const icon = parentSubmenu.querySelector('i.mdi-chevron-right');
            if (submenu) submenu.classList.remove('hidden');
            if (icon) icon.classList.add('rotate-90');
        }
    }

    // 4. Fungsi untuk toggle sub-menu saat diklik
    document.querySelectorAll('li.has_sub > a').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            const submenu = this.nextElementSibling;
            const icon = this.querySelector('i.mdi-chevron-right');

            submenu.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
        });
    });

    
});
</script>

<?= $this->endSection() ?>