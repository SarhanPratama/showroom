@extends('frontend.layouts.app')

@section('content')
<main class="bg-white">
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumbs -->
        <nav class="text-sm mb-6 text-gray-600" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/" class="hover:text-purple-600">Beranda</a>
                    <i class="fas fa-chevron-right mx-2"></i>
                </li>
                <li class="flex items-center">
                    <a href="/katalog" class="hover:text-purple-600">Katalog</a>
                    <i class="fas fa-chevron-right mx-2"></i>
                </li>
                <li>Toyota Avanza 1.3 G MT 2018</li>
            </ol>
        </nav>

        <!-- Main Detail Section -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Image Gallery (Left) -->
            <div class="lg:col-span-3">
                <img id="mainImage" src="https://images.unsplash.com/photo-1550355291-bbee04a92027?w=800&auto=format&fit=crop" alt="Toyota Avanza" class="w-full h-auto object-cover rounded-xl shadow-lg mb-4">
                <div id="thumbnailContainer" class="grid grid-cols-4 gap-4">
                    <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?w=150&h=100&fit=crop" alt="Thumbnail 1" class="rounded-lg cursor-pointer transition transform hover:scale-105 border-2 border-purple-600">
                    <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=150&h=100&fit=crop" alt="Thumbnail 2" class="rounded-lg cursor-pointer transition transform hover:scale-105 border-2 border-transparent">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=150&h=100&fit=crop" alt="Thumbnail 3" class="rounded-lg cursor-pointer transition transform hover:scale-105 border-2 border-transparent">
                    <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?w=150&h=100&fit=crop" alt="Thumbnail 4" class="rounded-lg cursor-pointer transition transform hover:scale-105 border-2 border-transparent">
                </div>
            </div>

            <!-- Car Info & Action (Right) -->
            <div class="lg:col-span-2">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Toyota Avanza 1.3 G MT</h1>
                <p class="text-xl text-gray-500 mb-4">Tahun 2018</p>

                <div class="flex items-center space-x-6 text-gray-600 border-y py-4 my-4">
                    <div class="text-center"><i class="fas fa-calendar-alt mr-1"></i> 2018</div>
                    <div class="text-center"><i class="fas fa-road mr-1"></i> 60rb km</div>
                    <div class="text-center"><i class="fas fa-cogs mr-1"></i> Manual</div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-600">Harga Cash</p>
                    <p class="text-4xl font-extrabold text-purple-600">Rp 158.000.000</p>
                    <p class="text-orange-500 font-semibold">(Nego di tempat)</p>
                </div>

                <div class="space-y-3">
                    <a href="https://wa.me/6281380846977?text=Halo%20Manunggal%20Mobilindo,%20saya%20tertarik%20dengan%20Toyota%20Avanza%202018.%20Apakah%20unit%20masih%20tersedia?" target="_blank" class="w-full flex items-center justify-center bg-green-500 text-white py-3 rounded-lg font-bold text-lg hover:bg-green-600 transition transform hover:scale-105">
                        <i class="fab fa-whatsapp mr-2"></i> Hubungi via WhatsApp
                    </a>
                    <a href="#kontak" class="w-full flex items-center justify-center bg-purple-600 text-white py-3 rounded-lg font-bold text-lg hover:bg-purple-700 transition">
                        <i class="fas fa-car mr-2"></i> Jadwalkan Test Drive
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
                    <button data-tab-target="#fitur" class="tab-button">Fitur</button>
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
                                <tr class="border-b"><td class="py-3 text-gray-600">Merek</td><td class="font-semibold">Toyota</td></tr>
                                <tr class="border-b"><td class="py-3 text-gray-600">Model</td><td class="font-semibold">Avanza 1.3 G</td></tr>
                                <tr class="border-b"><td class="py-3 text-gray-600">Tahun</td><td class="font-semibold">2018</td></tr>
                                <tr class="border-b"><td class="py-3 text-gray-600">Warna</td><td class="font-semibold">Silver Metalik</td></tr>
                                <tr><td class="py-3 text-gray-600">Kapasitas</td><td class="font-semibold">7 Penumpang</td></tr>
                            </tbody>
                        </table>
                        <table class="w-full text-left">
                            <tbody>
                                <tr class="border-b"><td class="py-3 text-gray-600">Kapasitas Mesin</td><td class="font-semibold">1329 cc</td></tr>
                                <tr class="border-b"><td class="py-3 text-gray-600">Transmisi</td><td class="font-semibold">Manual 5-Speed</td></tr>
                                <tr class="border-b"><td class="py-3 text-gray-600">Bahan Bakar</td><td class="font-semibold">Bensin</td></tr>
                                <tr class="border-b"><td class="py-3 text-gray-600">Kilometer</td><td class="font-semibold">60.000 km</td></tr>
                                <tr><td class="py-3 text-gray-600">Pajak</td><td class="font-semibold">Panjang s/d 2025</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Fitur Content -->
                <div id="fitur" class="tab-content hidden">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> AC Double Blower</div>
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Power Steering</div>
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Power Window</div>
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Velg Racing</div>
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Dual SRS Airbag</div>
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Sistem Pengereman ABS</div>
                        <div class="bg-gray-100 rounded-lg p-4 flex items-center"><i class="fas fa-check-circle text-green-500 mr-3"></i> Sensor Parkir</div>
                    </div>
                </div>

                <!-- Simulasi Kredit Content -->
                <div id="simulasi" class="tab-content hidden">
                    <div class="max-w-xl mx-auto bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-8">
                         <h4 class="font-bold text-lg mb-4 text-gray-800">
                            <i class="fas fa-calculator text-green-600 mr-2"></i>
                            Kalkulator Estimasi Kredit
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <label for="dpInput" class="block text-sm font-medium text-gray-700">Jumlah DP (Rp)</label>
                                <input type="number" id="dpInput" value="20000000" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                            </div>
                             <div>
                                <label for="tenorSelect" class="block text-sm font-medium text-gray-700">Jangka Waktu (Tenor)</label>
                                <select id="tenorSelect" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                    <option value="36">3 Tahun (36 bulan)</option>
                                    <option value="48">4 Tahun (48 bulan)</option>
                                    <option value="59" selected>5 Tahun (59 bulan)</option>
                                </select>
                            </div>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-sm text-gray-600">Estimasi Angsuran / Bulan</p>
                                <p id="hasilAngsuran" class="text-3xl font-bold text-gray-800">Rp 0</p>
                            </div>
                            <p class="text-xs text-gray-500 pt-2">*Perhitungan ini adalah estimasi. Suku bunga dan angka final akan ditentukan oleh pihak leasing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<style>
    .tab-button {
        @apply whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg text-gray-500 hover:text-purple-600 hover:border-purple-300;
    }
    .tab-button.active {
        @apply border-purple-600 text-purple-600;
    }
</style>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Gallery
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('#thumbnailContainer img');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainImage.src = this.src.replace('w=150&h=100&fit=crop', 'w=800&auto=format&fit=crop');
                thumbnails.forEach(t => t.classList.remove('border-purple-600'));
                this.classList.add('border-purple-600');
            });
        });

        // Tabs
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
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

        function hitungKredit() {
            const hargaMobil = 158000000;
            const dp = parseInt(dpInput.value) || 0;
            const tenor = parseInt(tenorSelect.value);

            const pokokHutang = hargaMobil - dp;
            if (pokokHutang <= 0) {
                hasilAngsuranEl.innerText = "Lunas";
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
    });
</script>
@endpush
