@extends('frontend.layouts.app')

@section('content')

    <!-- Hero Section Slider -->
    <section id="home" class="relative w-full h-[85vh] overflow-hidden bg-slate-900">
        <!-- Slider Container -->
        <div id="slider-container" class="flex h-full transition-transform duration-700 ease-in-out">

            @forelse($sliders as $slider)
                <div class="slide min-w-full h-full relative bg-cover bg-center"
                    style="background-image: url('{{ str_starts_with($slider->image, 'http') ? $slider->image : Storage::url($slider->image) }}');">
                    <div class="absolute inset-0 bg-slate-900/70 flex items-center">
                        <div class="container mx-auto px-6 text-white">
                            <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="1000">
                                @if($slider->badge_text)
                                    <span
                                        class="{{ str_contains(strtolower($slider->badge_text), 'promo') ? 'bg-red-600' : 'bg-blue-600' }} text-white py-1.5 px-4 rounded-full text-xs font-bold tracking-wider uppercase mb-6 inline-block shadow-lg">
                                        {{ $slider->badge_text }}
                                    </span>
                                @endif
                                <h2 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight tracking-tight text-white">
                                    {!! nl2br(e($slider->title)) !!}
                                </h2>
                                @if($slider->subtitle)
                                    <p class="text-lg md:text-xl mb-10 text-slate-300 font-light leading-relaxed max-w-2xl">
                                        {{ $slider->subtitle }}
                                    </p>
                                @endif
                                <div class="flex flex-wrap gap-4">
                                    @if($slider->button_text && $slider->button_link)
                                        <a href="{{ $slider->button_link }}"
                                            class="btn-primary px-8 py-4 rounded-lg font-bold flex items-center gap-2 transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-blue-500/30">
                                            <i class="fas fa-car shadow-none group-hover:animate-bounce"></i> {{ $slider->button_text }}
                                        </a>
                                    @endif
                                    @if($loop->first && isset($settings['whatsapp']))
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}"
                                            target="_blank"
                                            class="bg-white text-slate-900 px-8 py-4 rounded-lg font-bold hover:bg-slate-100 transform transition-all duration-300 hover:scale-105 shadow-lg flex items-center gap-2">
                                            <i class="fab fa-whatsapp text-green-500 group-hover:scale-110 transition-transform"></i> Hubungi Kami
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="slide min-w-full h-full relative bg-slate-800 flex items-center justify-center">
                    <div class="text-white text-center">
                        <h2 class="text-4xl font-bold">Selamat Datang di {{ $settings['site_tagline'] ?? 'Showroom' }}</h2>
                    </div>
                </div>
            @endforelse

        </div>

        @if($sliders->count() > 1)
            <!-- Navigation Buttons -->
            <button id="prevBtn"
                class="absolute top-1/2 left-4 md:left-8 transform -translate-y-1/2 bg-slate-900/40 hover:bg-blue-600 text-white p-4 rounded-full backdrop-blur-sm transition-all duration-300 border border-white/20 hover:scale-110 hover:shadow-[0_0_20px_rgba(37,99,235,0.5)] z-30">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button id="nextBtn"
                class="absolute top-1/2 right-4 md:right-8 transform -translate-y-1/2 bg-slate-900/40 hover:bg-blue-600 text-white p-4 rounded-full backdrop-blur-sm transition-all duration-300 border border-white/20 hover:scale-110 hover:shadow-[0_0_20px_rgba(37,99,235,0.5)] z-30">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
        @endif
    </section>

    <!-- Search Section (Clean Layout) -->
    <section class="py-12 bg-white border-b border-slate-100">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <form action="{{ url('/') }}#katalog" method="GET"
                    class="bg-white rounded-xl shadow-lg border border-slate-200 p-8 flex flex-col md:flex-row gap-6 items-end -mt-24 relative z-20">
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Merek</label>
                        <div class="relative">
                            <select name="merek"
                                class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition bg-slate-50 text-slate-700">
                                <option value="Semua Merek">Semua Merek</option>
                                @foreach(\App\Models\Merek::all() as $merek)
                                    <option value="{{ $merek->id }}" {{ request('merek') == $merek->id ? 'selected' : '' }}>{{ $merek->nama_merek }}</option>
                                @endforeach
                            </select>
                            <i
                                class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tipe</label>
                        <div class="relative">
                            <select name="tipe"
                                class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition bg-slate-50 text-slate-700">
                                <option value="Semua Tipe">Semua Tipe</option>
                                @foreach(\App\Models\TipeMobil::all() as $tipe)
                                    <option value="{{ $tipe->id }}" {{ request('tipe') == $tipe->id ? 'selected' : '' }}>{{ $tipe->nama_tipe }}</option>
                                @endforeach
                            </select>
                            <i
                                class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga</label>
                        <div class="relative">
                            <select name="harga"
                                class="w-full appearance-none border border-slate-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition bg-slate-50 text-slate-700">
                                <option value="Semua Harga">Semua Harga</option>
                                <option value="< 100 Juta" {{ request('harga') == '< 100 Juta' ? 'selected' : '' }}>< 100 Juta</option>
                                <option value="100 - 200 Juta" {{ request('harga') == '100 - 200 Juta' ? 'selected' : '' }}>100 - 200 Juta</option>
                                <option value="> 200 Juta" {{ request('harga') == '> 200 Juta' ? 'selected' : '' }}>> 200 Juta</option>
                            </select>
                            <i
                                class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                        </div>
                    </div>
                    <div class="w-full md:w-auto">
                        <button type="submit"
                            class="w-full btn-accent px-8 py-3 rounded-lg font-bold shadow-lg flex items-center justify-center gap-2 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/40 group">
                            <i class="fas fa-search group-hover:rotate-12 transition-transform"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Keunggulan Layanan -->
    <section id="layanan" class="py-20 bg-slate-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Layanan Kami</h3>
                <p class="text-slate-600 max-w-2xl mx-auto">Kami berkomitmen memberikan pengalaman jual beli mobil bekas
                    terbaik dengan pelayanan profesional.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($layanans as $layanan)
                    <div class="card-clean p-8 rounded-2xl group border border-slate-100/50 hover:border-blue-100 transition-all duration-500" data-aos="fade-up"
                        data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div
                            class="w-16 h-16 bg-blue-50/80 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:-translate-y-2 transition-all duration-500 shadow-sm group-hover:shadow-[0_10px_30px_rgba(37,99,235,0.3)] shrink-0">
                            <i
                                class="{{ $layanan->icon_class }} text-3xl text-blue-600 group-hover:text-white transition-colors duration-500 group-hover:scale-110"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-slate-900 group-hover:text-blue-600 transition-colors duration-300">{{ $layanan->title }}</h4>
                        <p class="text-slate-600 leading-relaxed">{{ $layanan->description }}</p>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-slate-500">Layanan sedang diperbarui.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Katalog Mobil -->
    <section id="katalog" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6" data-aos="fade-up">
                <div>
                    <span class="text-blue-600 font-bold tracking-wider uppercase text-sm mb-2 block">Pilihan Terbaik</span>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900">Stok Mobil Terbaru</h3>
                </div>

                <a href="#" class="text-blue-600 font-bold hover:text-blue-800 transition flex items-center gap-2">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($mobils as $mobil)
                    <div class="card-clean rounded-2xl overflow-hidden group hover:-translate-y-2 transition-all duration-500 hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)] border border-slate-100" data-aos="fade-up"
                        data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="relative overflow-hidden h-60 bg-slate-100">
                            @if($mobil->image)
                                <img src="{{ str_starts_with($mobil->image, 'http') ? $mobil->image : Storage::url($mobil->image) }}"
                                    alt="{{ $mobil->merek->nama_merek }} {{ $mobil->nama_mobil }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300 group-hover:bg-slate-200 transition-colors duration-500">
                                    <i class="fas fa-car text-6xl group-hover:scale-110 transition-transform duration-500"></i>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            @if($mobil->promos->count() > 0)
                                <span
                                    class="absolute top-4 left-4 bg-red-600 text-white px-3 py-1 rounded text-xs font-bold shadow-md transform -translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">PROMO</span>
                            @elseif($loop->first)
                                <span
                                    class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded text-xs font-bold shadow-md transform -translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">TERBARU</span>
                            @endif
                        </div>
                        <div class="p-6 relative">
                            <!-- Floating Action Button effect on hover -->
                            <a href="{{ route('frontend.detail', $mobil->id) }}" class="absolute -top-6 right-6 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-lg transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 hover:bg-blue-700">
                                <i class="fas fa-arrow-right"></i>
                            </a>

                            <div class="mb-2 flex items-center gap-2">
                                <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">{{ $mobil->merek->nama_merek }}</span>
                            </div>

                            <h4 class="text-xl font-extrabold text-slate-900 mb-1 group-hover:text-blue-600 transition-colors duration-300 line-clamp-1">
                                {{ $mobil->nama_mobil }}
                            </h4>
                            
                            <!-- Promo Price Check -->
                            @if($mobil->promos->count() > 0 && isset($mobil->promos->first()->diskon))
                                <p class="text-sm border-b border-red-500 text-slate-400 line-through inline-block mb-1">Rp
                                    {{ number_format($mobil->harga, 0, ',', '.') }}</p>
                                <p class="text-blue-600 font-black text-2xl mb-4 tracking-tight">Rp
                                    {{ number_format($mobil->harga - $mobil->promos->first()->diskon, 0, ',', '.') }}</p>
                            @else
                                <p class="text-blue-600 font-black text-2xl mb-4 tracking-tight mt-6">Rp
                                    {{ number_format($mobil->harga, 0, ',', '.') }}</p>
                            @endif

                            <div class="flex items-center justify-between text-sm text-slate-500 border-t border-slate-100 pt-4 mt-2">
                                <span class="flex items-center gap-1.5 font-medium"><i class="fas fa-calendar text-slate-400"></i> {{ $mobil->created_at->format('Y') }}</span>
                                <span class="flex items-center gap-1.5 font-medium"><i class="fas fa-car-side text-slate-400"></i>
                                    {{ $mobil->tipe->nama_tipe }}</span>
                                <span class="flex items-center gap-1.5 font-medium text-blue-600 bg-blue-50 px-2 py-1 rounded-md"><i class="fas fa-check-circle"></i> Stok: {{ $mobil->stok }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-slate-500">
                        <i class="fas fa-car-slash text-4xl mb-4 text-slate-300"></i>
                        <p>Belum ada stok mobil tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Kontak & Lokasi -->
    <section id="kontak" class="py-20 bg-slate-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Lokasi & Kontak</h3>
                <p class="text-slate-600 max-w-2xl mx-auto">Kunjungi showroom kami untuk melihat langsung unit yang
                    tersedia.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Contact Info -->
                <div data-aos="fade-right">
                    <div class="card-clean p-8 rounded-xl bg-white mb-8">
                        <h4 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-building text-blue-600"></i> Kantor Pusat
                        </h4>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-900 text-sm mb-1">Alamat</h5>
                                    <p class="text-slate-600 leading-relaxed text-sm">
                                        {!! nl2br(e($settings['address'] ?? 'Pekanbaru, Riau')) !!}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                                    <i class="fas fa-clock text-blue-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-900 text-sm mb-1">Jam Operasional</h5>
                                    <p class="text-slate-600 text-sm">Senin - Sabtu: 08:00 - 17:00 WIB</p>
                                    <p class="text-slate-600 text-sm">Minggu: 09:00 - 15:00 WIB</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center shrink-0">
                                    <i class="fas fa-phone-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-900 text-sm mb-1">Hubungi Kami</h5>
                                    <p class="text-slate-600 font-medium text-sm">{{ $settings['whatsapp'] ?? '-' }}
                                        (WhatsApp)</p>
                                    <p class="text-slate-600 text-sm">{{ $settings['phone'] ?? '-' }} (Office)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($settings['whatsapp']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank"
                            class="w-full bg-green-500 text-white py-4 rounded-xl font-bold text-center hover:bg-green-600 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-green-500/40 flex items-center justify-center gap-2 group mt-8">
                            <i class="fab fa-whatsapp text-2xl group-hover:scale-125 transition-transform duration-300"></i> <span class="group-hover:tracking-wide transition-all">Chat WhatsApp Sekarang</span>
                        </a>
                    @endif
                </div>

                <!-- Map -->
                <div class="h-full min-h-[400px] w-full rounded-xl overflow-hidden shadow-lg border border-slate-200 relative group"
                    data-aos="fade-left">
                    @if(!empty($settings['maps_iframe']))
                        <!-- Embedded Maps from Database -->
                        @if(str_contains($settings['maps_iframe'], '<iframe'))
                            {!! $settings['maps_iframe'] !!}
                        @else
                            <iframe src="{{ $settings['maps_iframe'] }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="absolute inset-0 w-full h-full grayscale group-hover:grayscale-0 transition-all duration-500"></iframe>
                        @endif
                    @else
                        <div class="flex items-center justify-center h-full bg-slate-200 text-slate-500">
                            Peta Google Maps belum diset.
                        </div>
                    @endif
                    <div class="absolute inset-0 pointer-events-none border-4 border-white/20 rounded-xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h3 class="text-3xl md:text-4xl font-extrabold mb-6">Apa Kata Mereka?</h3>
                <p class="text-slate-400 max-w-2xl mx-auto">Kepuasan pelanggan adalah prioritas utama kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($testimonials as $testimonial)
                    <div class="bg-slate-800 p-8 rounded-xl border border-slate-700" data-aos="fade-up"
                        data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="flex items-center gap-1 text-yellow-500 mb-6">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for($i = $testimonial->rating; $i < 5; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-slate-300 leading-relaxed mb-6 italic">
                            "{{ $testimonial->content }}"
                        </p>
                        <div class="flex items-center gap-4">
                            @if($testimonial->avatar)
                                <img src="{{ Storage::url($testimonial->avatar) }}" class="w-10 h-10 object-cover rounded-full">
                            @else
                                <div
                                    class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center font-bold text-white">
                                    {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                                </div>
                            @endif
                            <div>
                                <h5 class="font-bold text-white">{{ $testimonial->name }}</h5>
                                <p class="text-xs text-slate-400">{{ $testimonial->role ?? 'Customer' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-slate-400">Belum ada testimoni.</div>
                @endforelse
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Simple Slider Script
            const sliderContainer = document.getElementById('slider-container');
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;
            let currentSlide = 0;

            if (totalSlides > 1) {
                function goToSlide(index) {
                    if (index < 0) index = totalSlides - 1;
                    if (index >= totalSlides) index = 0;
                    currentSlide = index;
                    sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
                }

                document.getElementById('nextBtn')?.addEventListener('click', () => goToSlide(currentSlide + 1));
                document.getElementById('prevBtn')?.addEventListener('click', () => goToSlide(currentSlide - 1));
                setInterval(() => goToSlide(currentSlide + 1), 6000);
            }
        </script>
    @endpush

@endsection