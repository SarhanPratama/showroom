@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Pengaturan Website
        </h2>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                {{ session('success') }}
            </div>
        @endif

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('admin.setting.update') }}" method="POST">
                @csrf

                <h4
                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">
                    Informasi Umum
                </h4>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Website / Brand</span>
                        <input type="text" name="site_title" value="{{ $settings['site_title'] ?? '' }}"
                            placeholder="Contoh: Manunggal Mobilindo"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            required />
                    </label>

                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Tagline / Semboyan Utama</span>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}"
                            placeholder="Solusi Mobil Impian Anda"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                </div>

                <label class="block mb-8 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Deskripsi Singkat (Footer)</span>
                    <textarea name="site_description" rows="3"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">{{ $settings['site_description'] ?? '' }}</textarea>
                </label>

                <h4
                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">
                    Kontak & Lokasi
                </h4>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/3 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">No. Telepon / HP</span>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" placeholder="08123456789"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="block w-1/3 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">WhatsApp (Gunakan awalan 62)</span>
                        <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}"
                            placeholder="628123456789"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="block w-1/3 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Email Utama</span>
                        <input type="email" name="email" value="{{ $settings['email'] ?? '' }}"
                            placeholder="info@showroom.com"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                </div>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Alamat Lengkap</span>
                    <textarea name="address" rows="3"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">{{ $settings['address'] ?? '' }}</textarea>
                </label>

                <label class="block mb-8 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Link Google Maps (URL / src)</span>
                    <input type="url" name="maps_iframe" value="{{ $settings['maps_iframe'] ?? '' }}"
                        placeholder="https://www.google.com/maps/embed?pb=..."
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                    <span class="text-xs text-gray-500 mt-1 block">Cukup masukkan link URL-nya saja tanpa tag
                        &lt;iframe&gt;.</span>
                </label>

                <h4
                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">
                    Sosial Media
                </h4>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Link Facebook</span>
                        <input type="url" name="facebook" value="{{ $settings['facebook'] ?? '' }}"
                            placeholder="https://facebook.com/showroom"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Link Instagram</span>
                        <input type="url" name="instagram" value="{{ $settings['instagram'] ?? '' }}"
                            placeholder="https://instagram.com/showroom"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                </div>

                <div class="mt-8 border-t dark:border-gray-700 pt-4 flex justify-end gap-2">
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <i class="fas fa-save mr-2"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection