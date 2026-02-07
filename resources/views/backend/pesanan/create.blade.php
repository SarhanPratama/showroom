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
                        class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
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

                <!-- Dynamic Items with Alpine.js -->
                <div class="mt-6" x-data="orderItems()">
                    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-200">Daftar Mobil</h4>

                    <div class="space-y-4">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="flex gap-4 items-end p-4 border rounded-lg dark:border-gray-700">
                                <div class="w-full">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Pilih Mobil</span>
                                        <select :name="'items['+index+'][mobil_id]'" x-model="item.mobil_id" required
                                            class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                            <option value="">-- Pilih Mobil --</option>
                                            @foreach($mobils as $mobil)
                                                <option value="{{ $mobil->id }}">
                                                    {{ $mobil->nama_mobil }} (Stok: {{ $mobil->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="w-24">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Jumlah</span>
                                        <input type="number" :name="'items['+index+'][jumlah]'" x-model="item.jumlah"
                                            min="1" required
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray">
                                    </label>
                                </div>
                                <div class="flex-shrink-0" x-show="items.length > 1">
                                    <button type="button" @click="removeItem(index)"
                                        class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-4">
                        <button type="button" @click="addItem()"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                            + Tambah Mobil Lain
                        </button>
                    </div>
                </div>

                <script>
                    function orderItems() {
                        return {
                            items: [{ mobil_id: '', jumlah: 1 }],
                            addItem() {
                                this.items.push({ mobil_id: '', jumlah: 1 });
                            },
                            removeItem(index) {
                                this.items.splice(index, 1);
                            }
                        }
                    }
                </script>

                <!-- Tanggal Pesan -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tanggal Pesanan</span>
                    <input type="date" name="tanggal_pesan" value="{{ date('Y-m-d') }}" required
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray">
                </label>

                <!-- Status -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Status Awal</span>
                    <select name="status_pesanan" required
                        class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
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