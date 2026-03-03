<footer class="bg-slate-950 text-white pt-16 pb-8 border-t border-slate-900">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="bg-blue-600 p-2 rounded-lg text-white">
                        <i class="fas fa-car-side text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold tracking-tight">{{ $settings['site_title'] ?? 'Showroom' }}</h4>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">
                    {{ $settings['site_description'] ?? 'Showroom mobil bekas terpercaya dengan standar kualitas terbaik. Aman, Cepat, dan Menguntungkan.' }}
                </p>
                <div class="flex space-x-4">
                    @if(!empty($settings['facebook']))
                        <a href="{{ $settings['facebook'] }}" target="_blank"
                            class="w-8 h-8 rounded bg-slate-900 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                    @endif
                    @if(!empty($settings['instagram']))
                        <a href="{{ $settings['instagram'] }}" target="_blank"
                            class="w-8 h-8 rounded bg-slate-900 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:text-white transition">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    @endif
                    @if(!empty($settings['whatsapp']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank"
                            class="w-8 h-8 rounded bg-slate-900 flex items-center justify-center text-slate-400 hover:bg-green-500 hover:text-white transition">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-6">Menu</h5>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ url('/') }}#home" class="text-slate-300 hover:text-blue-500 transition">Beranda</a>
                    </li>
                    <li><a href="{{ url('/') }}#katalog"
                            class="text-slate-300 hover:text-blue-500 transition">Katalog</a></li>
                    <li><a href="{{ url('/') }}#layanan"
                            class="text-slate-300 hover:text-blue-500 transition">Layanan</a></li>
                    <li><a href="{{ url('/') }}#kontak" class="text-slate-300 hover:text-blue-500 transition">Hubungi
                            Kami</a></li>
                </ul>
            </div>

            <!-- Layanan -->
            <div>
                <h5 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-6">Pintasan Layanan</h5>
                <ul class="space-y-3 text-sm">
                    @php
                        // Coba ambil layanan jika ada, ini view global jadi perlu fallback jika $layanans tidak dikirim
                        $footerLayanans = \App\Models\Layanan::where('is_active', true)->orderBy('order')->take(4)->get();
                    @endphp
                    @forelse($footerLayanans as $lay)
                        <li class="text-slate-300">{{ $lay->title }}</li>
                    @empty
                        <li class="text-slate-300">Jual Beli Mobil</li>
                        <li class="text-slate-300">Tukar Tambah</li>
                        <li class="text-slate-300">Kredit Fleksibel</li>
                    @endforelse
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h5 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-6">Kantor</h5>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3 text-slate-300">
                        <i class="fas fa-map-marker-alt mt-1 text-blue-500 border-none"></i>
                        <span
                            class="border-none">{!! nl2br(e($settings['address'] ?? 'Jl. Soekarno Hatta No. 88, Pekanbaru')) !!}</span>
                    </li>
                    <li class="flex items-center gap-3 text-slate-300">
                        <i class="fas fa-phone border-none text-blue-500"></i>
                        {{ $settings['phone'] ?? '0813-8084-6977' }}
                    </li>
                    <li class="flex items-center gap-3 text-slate-300 border-none">
                        <i class="fas fa-envelope text-blue-500 border-none"></i>
                        {{ $settings['email'] ?? 'info@showroom.com' }}
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-slate-900 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 border-none">
            <p class="text-slate-500 text-xs text-center md:text-left">&copy; {{ date('Y') }}
                {{ $settings['site_title'] ?? 'Showroom' }}. All rights
                reserved.</p>
        </div>
    </div>
</footer>