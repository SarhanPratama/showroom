@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tambah Layanan
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Class Ikon FontAwesome *</span>
                    <input type="text" name="icon_class" required placeholder="fas fa-check-circle"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    <span class="text-xs text-gray-500">Contoh: fas fa-car, fas fa-wallet, fas fa-exchange-alt</span>
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Judul Layanan *</span>
                    <input type="text" name="title" required placeholder="Jaminan Kualitas"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Deskripsi *</span>
                    <textarea name="description" required rows="3"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"></textarea>
                </label>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Urutan (Order)</span>
                        <input type="number" name="order" value="0"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="flex items-center w-1/2 mt-7 text-sm">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                        <span class="ml-2 text-gray-700 dark:text-gray-400">Aktif</span>
                    </label>
                </div>

                <div class="mt-8 border-t dark:border-gray-700 pt-4 flex justify-end gap-2">
                    <a href="{{ route('admin.layanan.index') }}"
                        class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection