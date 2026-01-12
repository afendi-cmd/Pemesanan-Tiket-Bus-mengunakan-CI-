    <!-- Footer CTA -->
    <footer class="bg-white pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-950 rounded-[80px] p-12 lg:p-32 text-center relative overflow-hidden" data-aos="fade-up">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
                <div class="relative z-10">
                    <h2 class="text-5xl lg:text-8xl font-black text-white mb-10 tracking-tighter leading-[0.9]">Mulai <br/> Petualanganmu.</h2>
                    <p class="text-blue-100 text-xl mb-16 max-w-2xl mx-auto font-medium leading-relaxed opacity-80">Jangan kompromikan kenyamanan Anda. Hubungi kami sekarang dan dapatkan penawaran spesial untuk booking pertama Anda.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-6">
                        <a href="#" class="bg-white text-blue-900 px-12 py-6 rounded-[28px] font-black hover:scale-105 transition-all shadow-[0_20px_50px_rgba(255,255,255,0.2)] text-lg">
                            Dapatkan Penawaran
                        </a>
                        <a href="#" class="bg-transparent border-2 border-white/30 text-white px-12 py-6 rounded-[28px] font-black hover:bg-white/10 transition-all text-lg backdrop-blur-md">
                            Katalog Armada
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-32 grid grid-cols-1 md:grid-cols-4 gap-16 text-center md:text-left border-b border-slate-100 pb-20">
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-2 justify-center md:justify-start mb-8">
                        <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg">
                            <i data-lucide="bus" size="24"></i>
                        </div>
                        <span class="text-2xl font-black text-blue-900 tracking-tighter">TRANS<span class="italic text-blue-600">BUS</span></span>
                    </div>
                    <p class="text-slate-500 font-medium leading-loose">Menetapkan standar baru dalam transportasi darat mewah di seluruh Indonesia.</p>
                </div>
                <div>
                    <h5 class="font-black text-[10px] uppercase tracking-[0.3em] text-slate-300 mb-8">Informasi</h5>
                    <ul class="space-y-5 text-slate-800 font-bold text-sm">
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Katalog Armada</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">Cara Pemesanan</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-black text-[10px] uppercase tracking-[0.3em] text-slate-300 mb-8">Kontak Kami</h5>
                    <p class="text-slate-800 font-bold text-sm leading-loose mb-6">The Plaza Office Tower, Lt. 24, <br/> Jakarta Pusat, Indonesia</p>
                    <p class="text-slate-800 font-black text-lg tracking-tight underline">hello@transbus.co.id</p>
                </div>
                <div>
                    <h5 class="font-black text-[10px] uppercase tracking-[0.3em] text-slate-300 mb-8">Ikuti Kami</h5>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white hover:rotate-12 transition-all cursor-pointer"><i data-lucide="instagram" size="20"></i></div>
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white hover:-rotate-12 transition-all cursor-pointer"><i data-lucide="facebook" size="20"></i></div>
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white hover:rotate-12 transition-all cursor-pointer"><i data-lucide="twitter" size="20"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">© 2024 Transbus Luxury Transport. Made with Passion for Travel.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Initialize Animate on Scroll
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Navbar Scroll Logic
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.classList.add('py-3');
                navbar.classList.remove('py-6');
            } else {
                navbar.classList.add('py-6');
                navbar.classList.remove('py-3');
            }
        });

        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const menuClose = document.getElementById('menu-close');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        menuClose.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });

        // Close menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        });
    </script>
</body>
</html>
