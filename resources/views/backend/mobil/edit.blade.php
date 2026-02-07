@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit Data Mobil
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('mobil.update', $mobil->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Mobil -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Nama Mobil</span>
                    <input name="nama_mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        required />
                </label>

                <!-- Harga -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Harga (Rp)</span>
                    <input type="number" name="harga" value="{{ old('harga', $mobil->harga) }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        required />
                </label>

                <div class="flex gap-4 mt-4">
                    <!-- Merek -->
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Merek</span>
                        <select name="merek_id"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            required>
                            <option value="">Pilih Merek</option>
                            @foreach($mereks as $merek)
                                <option value="{{ $merek->id }}" {{ $mobil->merek_id == $merek->id ? 'selected' : '' }}>
                                    {{ $merek->nama_merek }}
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <!-- Tipe -->
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Tipe Mobil</span>
                        <select name="tipe_id"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            required>
                            <option value="">Pilih Tipe</option>
                            @foreach($tipes as $tipe)
                                <option value="{{ $tipe->id }}" {{ $mobil->tipe_id == $tipe->id ? 'selected' : '' }}>
                                    {{ $tipe->nama_tipe }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <!-- Stok -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Stok Saat Ini</span>
                    <input type="number" name="stok" value="{{ old('stok', $mobil->stok) }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        min="0" required />
                </label>

                <!-- Deskripsi -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Deskripsi</span>
                    <textarea name="deskripsi"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        rows="3">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>
                </label>

                <!-- Buttons -->
                <div class="flex mt-6 text-sm">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Perbarui Data
                    </button>
                    <a href="{{ route('mobil.index') }}"
                        class="ml-4 px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection