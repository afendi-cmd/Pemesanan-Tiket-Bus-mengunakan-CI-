<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk ke Akun - Aether Console</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            fontFamily: { sans: ['Inter', 'sans-serif'] },
            colors: {
                'primary-accent': '#00f0ff',
                'secondary-accent': '#ff206e',
                'deep-bg': '#0D0B20',
                'card-bg': '#201c4e',
                'dark-purple': '#1C163E',
            }
        }
    }
}
</script>

<style>
body {
    background: radial-gradient(circle at center, rgba(28,22,62,1) 0%, #0D0B20 80%);
    min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 4px;
    font-family: 'Inter', sans-serif;
}
.neon-card-shadow {
    background-color: rgba(32,28,78,0.65);
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 50px rgba(0,0,0,0.9),
                0 0 40px rgba(0,240,255,0.4),
                inset 0 0 25px rgba(255,32,110,0.3);
    border-radius: 2rem;
    padding: 2rem;
    transition: all 0.3s ease-in-out;
}
.neon-button-glow {
    box-shadow: 0 5px 25px rgba(0,240,255,0.6);
    transition: all 0.3s ease-in-out;
}
.neon-button-glow:hover {
    box-shadow: 0 10px 40px rgba(0,240,255,1), 0 0 20px #ff206e;
}
.led-input-container {
    position: relative; padding: 2px; border-radius: 1rem; overflow: hidden;
}
.led-border {
    position: absolute; inset: 0; border-radius: 1rem;
    background: conic-gradient(from 180deg at 50% 50%, rgba(0,240,255,0) 0deg,#00f0ff 90deg,rgba(0,240,255,0) 360deg);
    opacity: 0; transform: scale(1.02); transition: opacity 0.5s ease;
    z-index: 5;
}
@keyframes rotate-border { to { transform: rotate(360deg); } }
.led-input-container:focus-within .led-border { opacity: 1; animation: rotate-border 2.5s linear infinite; }
.input-clarity {
    position: relative; z-index: 10;
    background-color: #1a163a; border: 1px solid #3a3375; border-color: transparent !important;
    padding-left: 1rem; padding-right: 1rem;
}
.modal-bg { background: rgba(0,0,0,0.75); backdrop-filter: blur(6px); }
.fade-in { animation: fadeIn 1s ease forwards; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>

</head>
<body class="antialiased">

<div class="w-full max-w-sm mx-auto relative z-30">

    <!-- Notifikasi sukses registrasi -->
    <?php if(session()->getFlashdata('success_register')): ?>
    <div class="fade-in mb-6 bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-xl text-center font-medium">
        <?= session()->getFlashdata('success_register') ?>
    </div>
    <?php endif; ?>

    <!-- Notifikasi error login -->
    <?php if(session()->getFlashdata('error')): ?>
    <div class="fade-in mb-6 bg-secondary-accent/20 border border-secondary-accent text-secondary-accent px-4 py-3 rounded-xl text-center font-medium">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <!-- Login Card -->
    <div class="neon-card-shadow border border-primary-accent/30">
        <h2 class="text-4xl font-extrabold text-white mb-3 text-center tracking-wider" style="text-shadow:0 0 10px #00f0ff;">AETHER CONSOLE</h2>
        <p class="text-primary-accent mb-8 text-center text-sm font-medium">Sistem Otentikasi</p>

        <form method="post" action="/login/authenticate">
            <?= csrf_field() ?>
            <!-- Email -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-primary-accent mb-2">
                    <i class="fas fa-envelope text-secondary-accent mr-2"></i> Email
                </label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input class="w-full px-4 py-3 rounded-xl text-white placeholder-slate-500 input-clarity"
                           type="email" name="identifier" placeholder="user.access@aether.net" required>
                </div>
            </div>
            <!-- Password -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-primary-accent mb-2">
                    <i class="fas fa-key text-secondary-accent mr-2"></i> Kata Sandi
                </label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input class="w-full px-4 py-3 rounded-xl text-white placeholder-slate-500 input-clarity"
                           type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
            <button class="w-full bg-primary-accent text-card-bg font-extrabold py-3 rounded-xl neon-button-glow hover:bg-white">
                MASUK SISTEM
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="#" class="text-sm text-secondary-accent hover:text-primary-accent">Lupa Kode Akses?</a>
        </div>
    </div>

    <!-- Register Trigger -->
    <p class="mt-8 text-center text-sm text-slate-400">
        Status Akun: Belum Terdaftar?
        <button onclick="openRegisterModal()"
            class="font-semibold text-primary-accent hover:text-white transition-ease"
            style="text-shadow:0 0 5px #00f0ff;">Minta Akses Sekarang</button>
    </p>

</div>

<!-- Modal Register -->
<div id="registerModal" class="fixed inset-0 hidden items-center justify-center modal-bg z-50 p-3">
    <div class="neon-card-shadow p-8 w-full max-w-md relative">

        <button onclick="closeRegisterModal()" class="absolute top-4 right-4 text-primary-accent text-xl hover:text-white">
            <i class="fas fa-times"></i>
        </button>

        <h2 class="text-3xl font-extrabold text-white mb-6 text-center" style="text-shadow:0 0 10px #00f0ff;">
            Daftar Akun
        </h2>

        <form action="/penyewa/save" method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label class="text-primary-accent text-sm mb-2 block">Nama Penyewa</label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input type="text" name="nama_penyewa" required class="w-full px-4 py-3 rounded-xl text-white input-clarity" placeholder="Nama lengkap Anda">
                </div>
            </div>
            <div class="mb-4">
                <label class="text-primary-accent text-sm mb-2 block">Alamat</label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input type="text" name="alamat" required class="w-full px-4 py-3 rounded-xl text-white input-clarity" placeholder="Alamat Anda">
                </div>
            </div>
            <div class="mb-4">
                <label class="text-primary-accent text-sm mb-2 block">No Telp</label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input type="text" name="no_hp" required class="w-full px-4 py-3 rounded-xl text-white input-clarity" placeholder="08xxxxxxxxxx">
                </div>
            </div>
            <div class="mb-4">
                <label class="text-primary-accent text-sm mb-2 block">Email Penyewa</label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl text-white input-clarity" placeholder="email@domain.com">
                </div>
            </div>
            <div class="mb-6">
                <label class="text-primary-accent text-sm mb-2 block">Password</label>
                <div class="led-input-container">
                    <div class="led-border"></div>
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl text-white input-clarity" placeholder="••••••••">
                </div>
            </div>
            <button class="w-full bg-primary-accent text-card-bg font-extrabold py-3 rounded-xl neon-button-glow hover:bg-white">
                DAFTAR SEKARANG
            </button>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
function openRegisterModal() {
    document.getElementById("registerModal").classList.remove("hidden");
    document.getElementById("registerModal").classList.add("flex");
}
function closeRegisterModal() {
    document.getElementById("registerModal").classList.add("hidden");
    document.getElementById("registerModal").classList.remove("flex");
}
</script>

</body>
</html>
