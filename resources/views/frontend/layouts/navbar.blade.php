<nav class="fixed w-full z-50 transition-all duration-300 top-0" id="navbar">
    <div class="bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-100 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="#" class="flex items-center gap-3 group">
                    <div class="bg-slate-900 text-white p-2.5 rounded-lg group-hover:bg-blue-600 transition-colors">
                        <i class="fas fa-car-side text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight leading-none">
                            {{ $settings['site_title'] ?? 'Showroom' }}
                        </h1>
                        <p
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest group-hover:text-blue-500 transition-colors">
                            {{ $settings['site_tagline'] ?? 'Premium Cars' }}
                        </p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}#home"
                        class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition relative group py-2">
                        Beranda
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ url('/') }}#katalog"
                        class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition relative group py-2">
                        Katalog
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ url('/') }}#layanan"
                        class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition relative group py-2">
                        Layanan
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ url('/') }}#kontak"
                        class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition relative group py-2">
                        Kontak
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    @if(!empty($settings['whatsapp']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank"
                            class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-700 transition transform hover:-translate-y-0.5 shadow-lg shadow-blue-600/20">
                            Hubungi Kami
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-slate-800 focus:outline-none" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobileMenu"
        class="hidden md:hidden bg-white border-b border-slate-100 shadow-xl absolute w-full top-full left-0 z-40">
        <div class="flex flex-col p-4 space-y-2">
            <a href="{{ url('/') }}#home"
                class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-slate-700 font-medium hover:text-blue-600 transition"
                onclick="toggleMobileMenu()">Beranda</a>
            <a href="{{ url('/') }}#katalog"
                class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-slate-700 font-medium hover:text-blue-600 transition"
                onclick="toggleMobileMenu()">Katalog</a>
            <a href="{{ url('/') }}#layanan"
                class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-slate-700 font-medium hover:text-blue-600 transition"
                onclick="toggleMobileMenu()">Layanan</a>
            <a href="{{ url('/') }}#kontak"
                class="block px-4 py-3 rounded-lg hover:bg-blue-50 text-slate-700 font-medium hover:text-blue-600 transition"
                onclick="toggleMobileMenu()">Kontak</a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }

    // Navbar Scroll Effect
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('#navbar > div');
        if (window.scrollY > 10) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });
</script>