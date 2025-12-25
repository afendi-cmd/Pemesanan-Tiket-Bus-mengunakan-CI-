<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>
<?= $this->include('layout/menu') ?>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<?php
// ambil username
$nama = $user['nama_karyawan'] ?? $user['nama_penyewa'] ?? $user['email'] ?? $user['username'] ?? 'User';

// Ambil alamat user
$alamat = $user['alamat'] ?? 'Tidak tersedia';

// Menentukan selamat berdasarkan waktu
date_default_timezone_set('Asia/Jakarta'); // Set timezone to Indonesia
$hour = (int)date('H');
if ($hour < 12) {
    $greeting = "Pagi";
} elseif ($hour < 17) {
    $greeting = "Siang";
} else {
    $greeting = "Malam";
}

// tempat simpan foto
$photoPath = base_url('images/fotoprofil/' . strtolower($nama) . '.jpg');
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <!-- Main Card: 'Aether Console' Theme with Deep Blue Gradient and Inner Neon Glow -->
            <div class="card shadow-2xl border-0" 
                 style="border-radius: 30px; 
                        /* Deeper, more futuristic gradient */
                        background: linear-gradient(135deg, #201c4e 0%, #3a3375 100%); 
                        overflow: hidden; 
                        transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
                        border: 1px solid rgba(255, 255, 255, 0.1); /* Subtle white border */
                        box-shadow: 0 15px 35px rgba(0,0,0,0.8), 
                                    inset 0 0 20px rgba(76, 55, 159, 0.5); /* Inner glow effect */
                        /* Initial 3D tilt for uniqueness */
                        transform: perspective(1000px) rotateX(0deg);"
                 onmouseover="this.style.boxShadow='0 40px 80px -20px rgba(32, 28, 78, 0.9), inset 0 0 30px rgba(255, 32, 110, 0.3)'; this.style.transform='perspective(1000px) rotateX(2deg) translateY(-8px)';"
                 onmouseout="this.style.boxShadow='0 15px 35px rgba(0,0,0,0.8), inset 0 0 20px rgba(76, 55, 159, 0.5)'; this.style.transform='perspective(1000px) rotateX(0deg) translateY(0)'">
                
                <div class="card-body text-center p-5 p-md-6" style="color: white;">

                    <!-- Profile Photo: 'Electric Magenta' Starlight Effect -->
                    <div class="mb-4 mt-1">
                        <div style="position: relative; width: 150px; height: 150px; margin: 0 auto;">
                            <img src="<?= $photoPath ?>" alt="Foto Profil" 
                                 class="rounded-circle" width="150" height="150"
                                 style="object-fit: cover; 
                                        /* Electric Pink Border */
                                        border: 8px solid #ff206e; 
                                        /* Stronger Magenta Glow */
                                        box-shadow: 0 0 20px #ff206e, 0 0 40px rgba(255, 32, 110, 0.7); 
                                        transition: all 0.4s ease-out;
                                        filter: brightness(1.2) contrast(1.1);"
                                 onerror="this.onerror=null; this.src='https://placehold.co/150x150/ff206e/ffffff?text=<?= substr(esc($nama), 0, 1) ?>'; this.style.border='8px solid #ff206e'; this.style.boxShadow='0 0 20px #ff206e, 0 0 40px rgba(255, 32, 110, 0.7)';"
                                 onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 0 30px #fff, 0 0 60px #ff206e';"
                                 onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0 20px #ff206e, 0 0 40px rgba(255, 32, 110, 0.7)'">
                        </div>
                    </div>

                    <!-- Greeting Section: Hero Text -->
                    <h1 class="mb-2" style="font-size: 3rem; font-weight: 900; 
                                            text-shadow: 0 0 10px rgba(255, 255, 255, 0.7); /* Subtle white glow on text */
                                            letter-spacing: 2px;">
                        DATA PROFILE
                    </h1>
                    <p class="mb-5" style="font-size: 1.4rem; font-weight: 400; opacity: 0.95;">
                        <span style="font-size: 1.2rem;">Selamat <?= $greeting ?>,</span>
                        <span style="font-weight: 900; color: #00f0ff; /* Electric Cyan Accent */ text-transform: uppercase; display: block; margin-top: 5px; font-size: 2.2rem; text-shadow: 0 0 15px #00f0ff;">
                            <?= esc($nama) ?>
                        </span>
                        <span style="display: block; font-size: 1rem; opacity: 0.8; margin-top: 5px;">Semoga Anda Bahagia Hari Ini</span>
                    </p>

                    <!-- User Info: Pure Glassmorphism Box -->
                    <div class="alert" role="alert"
                         style="border-radius: 25px; 
                                /* Pure Glassmorphism Look */
                                background: rgba(255, 255, 255, 0.1); 
                                border: 1px solid rgba(255, 255, 255, 0.3);
                                backdrop-filter: blur(15px); 
                                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                                
                                color: white; padding: 30px; margin: 40px 0;">

                        <p class="mb-3 text-start d-flex align-items-center" style="font-size: 1.3rem; font-weight: 700;">
                            <!-- Neon Icon -->
                            <span style="display: inline-block;
                                         background: #ff206e; /* Electric Pink */
                                         color: white; padding: 10px 18px; border-radius: 12px;
                                         margin-right: 15px; font-size: 20px; line-height: 1;
                                         box-shadow: 0 0 15px #ff206e;">
                                <i class="fas fa-map-pin"></i> <!-- Changed icon to map-pin for a sharper look -->
                            </span>

                            <strong style="color: #ff206e; text-shadow: 0 0 5px #ff206e;">LOKASI AKTIF</strong> 
                        </p>

                        <!-- Address Content Box (Neumorphism within Glass) -->
                        <div class="mt-3 text-start"
                             style="font-size: 1.1rem; 
                                    padding: 20px 25px;
                                    background-color: #3a3375; /* Dark color inside Glass */
                                    border-radius: 12px;
                                    color: #00f0ff; /* Cyan text for content */
                                    font-weight: 500;
                                    line-height: 1.6;
                                    border: 2px solid #201c4e; 
                                    box-shadow: inset 0 0 10px rgba(0, 240, 255, 0.4); /* Inner cyan glow */
                                    min-height: 50px;">
                            <?= nl2br(esc($alamat)) ?>
                        </div>
                    </div>

                    <!-- Logout Button: Electric Cyan (High Contrast) -->
                    <div class="mt-5">
                        <a href="<?= site_url('login/logout') ?>" 
                           class="btn btn-warning btn-xl"
                           style="border-radius: 35px; padding: 18px 60px; font-weight: 800;
                                    font-size: 1.2rem;
                                    color: #201c4e; /* Deep Violet Text */
                                    border: none;
                                    background: #00f0ff; /* Electric Cyan */
                                    box-shadow: 0 5px 20px rgba(0, 240, 255, 0.7); /* Cyan Neon Shadow */
                                    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);"
                           onmouseover="this.style.transform='translateY(-6px) scale(1.08)'; 
                                        this.style.boxShadow='0 20px 40px rgba(0, 240, 255, 1)';
                                        this.style.background='#fff';"
                           onmouseout="this.style.transform='translateY(0) scale(1)'; 
                                       this.style.boxShadow='0 5px 20px rgba(0, 240, 255, 0.7)';
                                       this.style.background='#00f0ff'">

                            <i class="fas fa-sign-out-alt me-2"></i> KELUAR SISTEM
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>