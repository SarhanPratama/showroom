@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Edit Promo</h2>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('promo.update', $promo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Nama Promo</span>
                    <input name="nama_promo" value="{{ $promo->nama_promo }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        required />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Diskon (%)</span>
                    <input type="number" name="diskon" value="{{ $promo->diskon }}" min="0" max="100"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        required />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Mulai</span>
                    <input type="date" name="tanggal_mulai" value="{{ $promo->tanggal_mulai }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        required />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Selesai</span>
                    <input type="date" name="tanggal_selesai" value="{{ $promo->tanggal_selesai }}"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        required />
                </label>

                <div class="flex mt-6 text-sm">
                    <button type="submit"
                        class="px-4 py-2 font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">Perbarui</button>
                    <a href="{{ route('promo.index') }}"
                        class="ml-4 px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection