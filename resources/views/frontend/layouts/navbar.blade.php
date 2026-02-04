   <nav class="sticky top-0 z-50 glass-effect shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-car text-3xl text-purple-600"></i>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Manunggal Mobilindo</h1>
                        <p class="text-xs text-gray-600">Showroom Mobil Bekas Terpercaya</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#home" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                    <a href="#katalog" class="text-gray-700 hover:text-purple-600 transition">Katalog</a>
                    <a href="#layanan" class="text-gray-700 hover:text-purple-600 transition">Layanan</a>
                    <a href="#kontak" class="text-gray-700 hover:text-purple-600 transition">Kontak</a>
                </div>
                <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <a href="#home" class="block px-4 py-3 hover:bg-gray-100">Beranda</a>
            <a href="#katalog" class="block px-4 py-3 hover:bg-gray-100">Katalog</a>
            <a href="#layanan" class="block px-4 py-3 hover:bg-gray-100">Layanan</a>
            <a href="#kontak" class="block px-4 py-3 hover:bg-gray-100">Kontak</a>
        </div>
    </nav>
