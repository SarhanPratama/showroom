@extends('frontend.layouts.app')

@section('content')
    <main class="bg-white pt-24">
        <div class="container mx-auto px-4 py-8">
            <!-- Breadcrumbs -->
            <nav class="text-sm mb-6 text-gray-600" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a href="{{ url('/') }}" class="hover:text-purple-600">Beranda</a>
                        <i class="fas fa-chevron-right mx-2"></i>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ url('/') }}#katalog" class="hover:text-purple-600">Katalog</a>
                        <i class="fas fa-chevron-right mx-2"></i>
                    </li>
                    <li>{{ $mobil->merek->nama_merek }} {{ $mobil->nama_mobil }} {{ $mobil->created_at->format('Y') }}</li>
                </ol>
            </nav>

            <!-- Main Detail Section -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <!-- Image Gallery (Left) -->
                <div class="lg:col-span-3">
                    @if($mobil->image)
                        @php $imageUrl = str_starts_with($mobil->image, 'http') ? $mobil->image : Storage::url($mobil->image); @endphp
                        <img id="mainImage" src="{{ $imageUrl }}" alt="{{ $mobil->merek->nama_merek }} {{ $mobil->nama_mobil }}"
                            class="w-full h-auto object-cover rounded-xl shadow-lg mb-4">

                        <div id="thumbnailContainer" class="flex gap-4 overflow-x-auto mt-4 pb-2">
                            <!-- Main Image Thumbnail -->
                            <img src="{{ $imageUrl }}" onclick="changeMainImage(this, '{{ $imageUrl }}')"
                                class="thumbnail-item rounded-lg cursor-pointer transition transform hover:scale-105 border-2 border-purple-600 w-24 h-24 object-cover shrink-0">

                            <!-- Additional Gallery Images -->
                            @if($mobil->images)
                                @foreach($mobil->images as $galleryImg)
                                    @php $galUrl = Storage::url($galleryImg->image); @endphp
                                    <img src="{{ $galUrl }}" onclick="changeMainImage(this, '{{ $galUrl }}')"
                                        class="thumbnail-item rounded-lg cursor-pointer transition transform hover:scale-105 border-2 border-transparent hover:border-purple-400 w-24 h-24 object-cover shrink-0">
                                @endforeach
                            @endif
                        </div>
                    @else
                        <div
                            class="w-full h-[400px] flex items-center justify-center bg-gray-200 text-gray-400 rounded-xl shadow-lg mb-4">
                            <i class="fas fa-car text-[100px]"></i>
                        </div>
                    @endif
                </div>

                <!-- Car Info & Action (Right) -->
                <div class="lg:col-span-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $mobil->merek->nama_merek }}
                        {{ $mobil->nama_mobil }}
                    </h1>
                    <p class="text-xl text-gray-500 mb-4">Tahun {{ $mobil->created_at->format('Y') }}</p>

                    <div class="flex items-center space-x-6 text-gray-600 border-y py-4 my-4">
                        <div class="text-center"><i class="fas fa-calendar-alt mr-1"></i>
                            {{ $mobil->created_at->format('Y') }}</div>
                        <div class="text-center"><i class="fas fa-car-side mr-1"></i> {{ $mobil->tipe->nama_tipe }}</div>
                        <div class="text-center"><i class="fas fa-check-circle mr-1"></i> Stok {{ $mobil->stok }}</div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6 relative overflow-hidden">
                        <p class="text-sm text-gray-600 relative z-10">Harga Cash</p>

                        @php
                            $actualPrice = $mobil->harga;
                        @endphp

                        @if($mobil->promos->count() > 0 && isset($mobil->promos->first()->diskon))
                            @php $actualPrice = $mobil->harga - $mobil->promos->first()->diskon; @endphp
                            <p
                                class="text-sm border-b border-red-500 text-slate-400 line-through inline-block mb-1 relative z-10">
                                Rp {{ number_format($mobil->harga, 0, ',', '.') }}</p>
                            <p class="text-4xl font-extrabold text-purple-600 relative z-10">Rp
                                {{ number_format($actualPrice, 0, ',', '.') }}
                            </p>
                            <div class="absolute top-0 right-0 bg-red-600 text-white font-bold px-4 py-1 rounded-bl-lg text-sm">
                                PROMO</div>
                        @else
                            <p class="text-4xl font-extrabold text-purple-600 relative z-10">Rp
                                {{ number_format($actualPrice, 0, ',', '.') }}
                            </p>
                        @endif
                    </div>

                    <div class="space-y-3">
                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '6281380846977');
                            $waMsg = urlencode("Halo {$settings['site_title']}, saya tertarik dengan unit {$mobil->merek->nama_merek} {$mobil->nama_mobil} {$mobil->created_at->format('Y')}. Apakah unit ini masih tersedia?");
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}?text={{ $waMsg }}" target="_blank"
                            class="w-full flex items-center justify-center bg-green-500 text-white py-3 rounded-lg font-bold text-lg hover:bg-green-600 transition transform hover:scale-105 shadow-lg shadow-green-500/30">
                            <i class="fab fa-whatsapp mr-2 text-xl"></i> Hubungi via WhatsApp
                        </a>
                        <a href="{{ url('/') }}#kontak"
                            class="w-full flex items-center justify-center bg-purple-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-purple-700 transition shadow-md shadow-purple-600/30">
                            <i class="fas fa-map-marker-alt mr-2 text-xl"></i> Kunjungi Showroom
                        </a>
                    </div>
                </div>
            </div>

            <!-- Details, Specs, Credit Sim -->
            <div class="mt-12">
                <!-- Tabs Navigation -->
                <div class="border-b border-gray-200">
                    <nav id="tab-nav" class="-mb-px flex space-x-6" aria-label="Tabs">
                        <button data-tab-target="#spesifikasi" class="tab-button active">Spesifikasi</button>
                        <!-- <button data-tab-target="#fitur" class="tab-button">Fitur</button> -->
                        <button data-tab-target="#simulasi" class="tab-button">Simulasi Kredit</button>
                    </nav>
                </div>

                <!-- Tabs Content -->
                <div class="mt-6">
                    <!-- Spesifikasi Content -->
                    <div id="spesifikasi" class="tab-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <table class="w-full text-left">
                                <tbody>
                                    <tr class="border-b">
                                        <td class="py-3 text-gray-600 w-1/3">Merek</td>
                                        <td class="font-semibold">{{ $mobil->merek->nama_merek }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 text-gray-600">Model</td>
                                        <td class="font-semibold">{{ $mobil->nama_mobil }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 text-gray-600">Tahun</td>
                                        <td class="font-semibold">{{ $mobil->created_at->format('Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-gray-600">Stok</td>
                                        <td class="font-semibold">{{ $mobil->stok }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="w-full text-left">
                                <tbody>
                                    <tr class="border-b">
                                        <td class="py-3 text-gray-600 w-1/3">Tipe Bodi</td>
                                        <td class="font-semibold">{{ $mobil->tipe->nama_tipe }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 text-gray-600">Status</td>
                                        <td class="font-semibold">
                                            @if($mobil->stok > 0)
                                                <span
                                                    class="text-green-600 bg-green-100 px-2 py-0.5 rounded-full text-xs">Tersedia</span>
                                            @else
                                                <span
                                                    class="text-red-600 bg-red-100 px-2 py-0.5 rounded-full text-xs">Habis</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 text-gray-600" colspan="2">Catatan/Deskripsi: <br> <span
                                                class="font-normal text-sm text-gray-700 mt-2 block">{{ $mobil->deskripsi ?? 'Tidak ada catatan tambahan.' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Simulasi Kredit Content -->
                    <div id="simulasi" class="tab-content hidden">
                        <div
                            class="max-w-xl mx-auto bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-8 border border-blue-100 shadow-sm">
                            <h4 class="font-bold text-lg mb-4 text-gray-800">
                                <i class="fas fa-calculator text-blue-600 mr-2"></i>
                                Kalkulator Estimasi Kredit
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <label for="dpInput" class="block text-sm font-medium text-gray-700 mb-1">Jumlah DP
                                        (Minimal 20%)</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-500 font-semibold">Rp</span>
                                        <input type="number" id="dpInput" value="{{ $actualPrice * 0.2 }}"
                                            class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">
                                    </div>
                                </div>
                                <div>
                                    <label for="tenorSelect" class="block text-sm font-medium text-gray-700 mb-1">Jangka
                                        Waktu (Tenor)</label>
                                    <select id="tenorSelect"
                                        class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition">
                                        <option value="12">1 Tahun (12 bulan)</option>
                                        <option value="24">2 Tahun (24 bulan)</option>
                                        <option value="36">3 Tahun (36 bulan)</option>
                                        <option value="48">4 Tahun (48 bulan)</option>
                                        <option value="59" selected>5 Tahun (59 bulan)</option>
                                    </select>
                                </div>
                                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 mt-6">
                                    <p class="text-sm text-gray-500 mb-1">Estimasi Angsuran / Bulan</p>
                                    <p id="hasilAngsuran" class="text-3xl font-black text-blue-600">Rp 0</p>
                                </div>
                                <p class="text-xs text-gray-500 pt-2 flex gap-1 items-start">
                                    <i class="fas fa-info-circle mt-0.5"></i>
                                    <span>*Perhitungan ini adalah estimasi kasar menggunakan bunga flat 8.5%. Suku bunga
                                        sebenarnya dan angka final akan ditentukan oleh pihak leasing.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($rekomendasi && $rekomendasi->count() > 0)
                    <div class="mt-16 pt-8 border-t border-gray-200">
                        <h3 class="text-2xl font-bold mb-6 text-gray-800">Rekomendasi Pilihan Lainnya</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($rekomendasi as $rek)
                                <div
                                    class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition border border-gray-100 group">
                                    <div class="relative overflow-hidden h-48 bg-slate-100">
                                        @if($rek->image)
                                            <img src="{{ str_starts_with($rek->image, 'http') ? $rek->image : Storage::url($rek->image) }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                <i class="fas fa-car text-5xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-gray-800">{{ $rek->merek->nama_merek }} {{ $rek->nama_mobil }}
                                        </h4>
                                        <p class="text-blue-600 font-bold text-lg mt-1">Rp
                                            {{ number_format($rek->harga, 0, ',', '.') }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-2">{{ $rek->created_at->format('Y') }} •
                                            {{ $rek->tipe->nama_tipe }}
                                        </p>
                                        <a href="{{ route('frontend.detail', $rek->id) }}"
                                            class="mt-4 block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 rounded transition">Lihat
                                            Unit</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

    <style>
        .tab-button {
            @apply whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg text-gray-500 hover:text-blue-600 hover:border-blue-300;
            transition: all 0.2s;
        }

        .tab-button.active {
            @apply border-blue-600 text-blue-600 font-bold;
        }
    </style>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tabs
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const target = document.querySelector(this.dataset.tabTarget);

                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    tabContents.forEach(content => content.classList.add('hidden'));
                    target.classList.remove('hidden');
                });
            });

            // Credit Calculator
            const dpInput = document.getElementById('dpInput');
            const tenorSelect = document.getElementById('tenorSelect');
            const hasilAngsuranEl = document.getElementById('hasilAngsuran');
            const actualPriceStr = "{{ $actualPrice }}";
            const hargaMobil = parseInt(actualPriceStr) || 0;

            function hitungKredit() {
                const dp = parseInt(dpInput.value) || 0;
                const tenor = parseInt(tenorSelect.value);

                const pokokHutang = hargaMobil - dp;
                if (pokokHutang <= 0) {
                    hasilAngsuranEl.innerText = "Selesai (Tanpa Kredit)";
                    return;
                }

                const bungaTahunan = 0.085; // Bunga flat 8.5%
                const totalBunga = pokokHutang * bungaTahunan * (tenor / 12);
                const totalHutang = pokokHutang + totalBunga;
                const angsuranBulanan = Math.round(totalHutang / tenor);

                hasilAngsuranEl.innerText = 'Rp ' + angsuranBulanan.toLocaleString('id-ID');
            }

            dpInput.addEventListener('input', hitungKredit);
            tenorSelect.addEventListener('change', hitungKredit);

            // Initial calculation
            hitungKredit();
            // Thumbnail image switching logic
            window.changeMainImage = function (element, newSrc) {
                // Change main image source
                document.getElementById('mainImage').src = newSrc;

                // Reset all thumbnails borders
                const thumbnails = document.querySelectorAll('.thumbnail-item');
                thumbnails.forEach(thumb => {
                    thumb.classList.remove('border-purple-600');
                    thumb.classList.add('border-transparent');
                });

                // Add active border to current thumbnail
                element.classList.remove('border-transparent');
                element.classList.add('border-purple-600');
            }
        });
    </script>
@endpush