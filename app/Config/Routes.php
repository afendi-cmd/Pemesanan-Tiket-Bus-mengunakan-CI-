<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/layout', 'Layout::index');         // Menampilkan halaman layout

$routes->get('/jabatan', 'Jabatan::index');
$routes->post('jabatan/save', 'Jabatan::save');  
$routes->get('jabatan/delete/(:num)', 'Jabatan::delete/$1');
$routes->get('jabatan/getJabatan/(:num)', 'Jabatan::getJabatan/$1');

$routes->get('/karyawan', 'Karyawan::index');
$routes->post('karyawan/save', 'Karyawan::save');  
$routes->get('karyawan/delete/(:num)', 'Karyawan::delete/$1');
$routes->get('karyawan/getKaryawan/(:num)', 'Karyawan::getKaryawan/$1');

$routes->get('/jenisbus', 'JenisBus::index');
$routes->post('jenisbus/save', 'JenisBus::save');  
$routes->get('jenisbus/delete/(:num)', 'JenisBus::delete/$1');
$routes->get('jenisbus/getJenisbus/(:num)', 'JenisBus::getJenisbus/$1');    

$routes->get('/bus', 'Bus::index');
$routes->post('bus/save', 'Bus::save');  
$routes->get('bus/delete/(:num)', 'Bus::delete/$1');
$routes->get('bus/getBus/(:num)', 'Bus::getBus/$1');

$routes->get('/penyewa', 'Penyewa::index');
$routes->post('penyewa/save', 'Penyewa::save');  
$routes->get('penyewa/delete/(:num)', 'Penyewa::delete/$1');
$routes->get('penyewa/getPenyewa/(:num)', 'Penyewa::getPenyewa/$1');

$routes->get('/paketwisata', 'PaketWisata::index');
$routes->post('paketwisata/save', 'PaketWisata::save');  
$routes->get('paketwisata/delete/(:num)', 'PaketWisata::delete/$1');
$routes->get('paketwisata/getPaketWisata/(:num)', 'PaketWisata::getPaketWisata/$1');

$routes->get('/paketbus', 'PaketBus::index');
$routes->post('paketbus/save', 'PaketBus::save');       
$routes->get('paketbus/delete/(:num)', 'PaketBus::delete/$1');
$routes->get('paketbus/getPaketBus/(:num)', 'PaketBus::getPaketBus/$1');

$routes->get('/pemesanan', 'Pemesanan::index');
$routes->post('pemesanan/cek_ajax', 'Pemesanan::cek_ajax');  
$routes->post('pemesanan/simpan', 'Pemesanan::simpan');       
$routes->get('pemesanan/delete/(:num)', 'Pemesanan::delete/$1');
$routes->get('pemesanan/getPemesanan/(:num)', 'Pemesanan::getPemesanan/$1');
$routes->get('pemesanan/tampil', 'Pemesanan::tampil');
$routes->get('pemesanan/view_tampil_pemesanan', 'Pemesanan::view_tampil_pemesanan');
$routes->get('pemesanan/batal/(:num)', 'Pemesanan::batal/$1');
$routes->get('pemesanan/bayar/(:num)', 'Pemesanan::bayar/$1');

$routes->get('/pemesanan_detail', 'PemesananDetail::index');
$routes->post('pemesanan_detail/save', 'PemesananDetail::save');      
$routes->get('pemesanan_detail/delete/(:num)', 'PemesananDetail::delete/$1');
$routes->get('pemesanan_detail/getDetail/(:num)', 'PemesananDetail::getDetail/$1');

$routes->get('/pembayaran', 'Pembayaran::index');
$routes->post('pembayaran/save', 'Pembayaran::save');      
$routes->get('pembayaran/delete/(:num)', 'Pembayaran::delete/$1');
$routes->get('pembayaran/getPembayaran/(:num)', 'Pembayaran::getPembayaran/$1');

$routes->get('/pemberangkatan', 'Pemberangkatan::index');
$routes->post('pemberangkatan/save', 'Pemberangkatan::save');   
$routes->get('pemberangkatan/delete/(:num)', 'Pemberangkatan::delete/$1');
$routes->get('pemberangkatan/getPemberangkatan/(:num)', 'Pemberangkatan::getPemberangkatan/$1');

$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/login/dashboard', 'Login::dashboard');
$routes->get('/login/logout', 'Login::logout');

$routes->get('/laporankaryawan', 'Laporankaryawan::index');
$routes->get('/laporankaryawan/cetak', 'Laporankaryawan::cetak');

// Laporan lainnya
$routes->get('/laporanjabatan', 'LaporanJabatan::index');
$routes->get('/laporanjabatan/cetak', 'LaporanJabatan::cetak');

$routes->get('/laporanpenyewa', 'LaporanPenyewa::index');
$routes->get('/laporanpenyewa/cetak', 'LaporanPenyewa::cetak');

$routes->get('/laporanjenisbus', 'LaporanJenisbus::index');
$routes->get('/laporanjenisbus/cetak', 'LaporanJenisbus::cetak');

$routes->get('/laporanbus', 'LaporanBus::index');
$routes->get('/laporanbus/cetak', 'LaporanBus::cetak');

$routes->get('/laporanpaketbus', 'LaporanPaketbus::index');
$routes->get('/laporanpaketbus/cetak', 'LaporanPaketbus::cetak');

$routes->get('/laporanpaketwisata', 'LaporanPaketwisata::index');
$routes->get('/laporanpaketwisata/cetak', 'LaporanPaketwisata::cetak');

$routes->get('/laporanpemesanan', 'LaporanPemesanan::index');
$routes->get('/laporanpemesanan/cetak', 'LaporanPemesanan::cetak');

$routes->get('/laporanpemesanan_detail', 'LaporanPemesananDetail::index');
$routes->get('/laporanpemesanan_detail/cetak', 'LaporanPemesananDetail::cetak');

$routes->get('/laporanpembayaran', 'LaporanPembayaran::index');
$routes->get('/laporanpembayaran/cetak', 'LaporanPembayaran::cetak');

$routes->get('/laporanpemberangkatan', 'LaporanPemberangkatan::index');
$routes->get('/laporanpemberangkatan/cetak', 'LaporanPemberangkatan::cetak');

  
// ... other routes ...







