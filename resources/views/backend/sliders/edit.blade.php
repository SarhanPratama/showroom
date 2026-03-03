@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit Slider
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('admin.slider.update', $slider) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Gambar Banner Saat Ini</span>
                    <div class="mt-2 mb-2">
                        <img src="{{ Storage::url($slider->image) }}" class="w-64 h-32 object-cover rounded-lg">
                    </div>
                    <span class="text-gray-700 dark:text-gray-400 text-xs">Upload baru jika ingin mengganti</span>
                    <input type="file" name="image" accept="image/*"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    @error('image') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Teks Badge (Label Kecil)</span>
                    <input type="text" name="badge_text" value="{{ $slider->badge_text }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Judul Utama *</span>
                    <input type="text" name="title" required value="{{ $slider->title }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Subjudul (Deskripsi Lengkap)</span>
                    <textarea name="subtitle" rows="3"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">{{ $slider->subtitle }}</textarea>
                </label>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Teks Tombol Aksi</span>
                        <input type="text" name="button_text" value="{{ $slider->button_text }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Link Tombol Aksi</span>
                        <input type="text" name="button_link" value="{{ $slider->button_link }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                </div>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Urutan (Order)</span>
                        <input type="number" name="order" value="{{ $slider->order }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="flex items-center w-1/2 mt-6 text-sm">
                        <input type="checkbox" name="is_active" value="1" {{ $slider->is_active ? 'checked' : '' }}
                            class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                        <span class="ml-2 text-gray-700 dark:text-gray-400">Aktif (Tampilkan di Beranda)</span>
                    </label>
                </div>

                <div class="mt-8 border-t dark:border-gray-700 pt-4 flex justify-end gap-2">
                    <a href="{{ route('admin.slider.index') }}"
                        class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Perbarui Slider
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection