<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSBUS - Solusi Perjalanan Mewah & Terpercaya</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- AOS (Animate on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            overflow-x: hidden;
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .text-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }

        .bg-mesh {
            background-color: #FAFBFF;
            background-image: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.05) 0, transparent 50%), 
                radial-gradient(at 100% 100%, rgba(30, 58, 138, 0.05) 0, transparent 50%);
        }

        .card-hover {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 40px 80px -15px rgba(59, 130, 246, 0.25);
        }

        .btn-glow:hover {
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.5);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { 
            background: #3b82f6; 
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-mesh text-slate-900 selection:bg-blue-600 selection:text-white">

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-500 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass flex justify-between items-center py-3 px-6 rounded-[28px] shadow-sm">
                <div class="flex items-center space-x-2 group cursor-pointer">
                    <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-300 group-hover:rotate-12 transition-transform">
                        <i data-lucide="bus" size="24"></i>
                    </div>
                    <span class="text-xl font-extrabold text-blue-900 tracking-tighter">TRANS<span class="italic text-blue-600">BUS</span></span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8 font-semibold text-sm tracking-tight text-slate-600">
                    <a href="#" class="relative group hover:text-blue-600 transition-colors">
                        Beranda
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#armada" class="relative group hover:text-blue-600 transition-colors">
                        Armada
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#keunggulan" class="relative group hover:text-blue-600 transition-colors">
                        Keunggulan
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#testimoni" class="relative group hover:text-blue-600 transition-colors">
                        Testimoni
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="https://wa.me/6281234567890" class="btn-glow bg-blue-600 text-white px-7 py-3 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 active:scale-95 text-sm">
                        Konsultasi Gratis
                    </a>
                </div>

                <button class="md:hidden p-2 text-slate-900" id="menu-toggle">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-white/98 backdrop-blur-2xl z-[60] flex flex-col p-8 hidden animate-in fade-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-12">
            <span class="text-2xl font-black text-blue-900 tracking-tighter">TRANS<span class="text-blue-600 italic">BUS</span></span>
            <button id="menu-close" class="p-3 bg-slate-100 rounded-2xl active:scale-90 transition-all"><i data-lucide="x"></i></button>
        </div>
        <div class="flex flex-col space-y-8 text-2xl font-bold text-slate-800">
            <a href="#" class="hover:text-blue-600">Beranda</a>
            <a href="#armada" class="hover:text-blue-600">Katalog Armada</a>
            <a href="#keunggulan" class="hover:text-blue-600">Keunggulan</a>
            <a href="#testimoni" class="hover:text-blue-600">Testimoni</a>
        </div>
        <button class="mt-auto bg-blue-600 text-white py-5 rounded-[24px] font-bold shadow-2xl shadow-blue-200 text-lg">Booking via WhatsApp</button>
    </div>
