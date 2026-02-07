@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Buat Pesanan Baru
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf

                <!-- Customer Selection -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Pilih Customer</span>
                    <select name="customer_id" required
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="">-- Pilih Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->nama }} ({{ $customer->no_hp }})</option>
                        @endforeach
                    </select>
                </label>
                <div class="mt-1">
                    <a href="{{ route('customer.create') }}" class="text-xs text-purple-600 hover:underline">+ Buat Customer
                        Baru</a>
                </div>

                <!-- Mobil Selection -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Pilih Mobil (Unit Ready)</span>
                    <select name="mobil_id" required
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="">-- Pilih Mobil --</option>
                        @foreach($mobils as $mobil)
                            <option value="{{ $mobil->id }}">
                                {{ $mobil->nama_mobil }} - Rp {{ number_format($mobil->harga, 0, ',', '.') }}
                                (Stok: {{ $mobil->stok }})
                            </option>
                        @endforeach
                    </select>
                </label>

                <!-- Tanggal Pesan -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Pesanan</span>
                    <input type="date" name="tanggal_pesan" value="{{ date('Y-m-d') }}" required
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray">
                </label>

                <!-- Status -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Status Awal</span>
                    <select name="status_pesanan" required
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai (Langsung Bayar)</option>
                    </select>
                </label>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Simpan Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection