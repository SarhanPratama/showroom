@extends('backend.layouts.app')

@section('content')
    <div class="container grid px-6 mx-auto"
        x-data="{ isModalOpen: false, deleteUrl: '', isSelesai: false, openDeleteModal(url, status) { this.isModalOpen = true; this.deleteUrl = url; this.isSelesai = (status === 'selesai'); setTimeout(() => { document.getElementById('restore_stock_input').value = 'no'; }, 100); } }">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Data Transaksi Pesanan
        </h2>

        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('pesanan.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Tambah Pesanan &plus;
            </a>
        </div>

        <!-- TABLE -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID Order</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Mobil</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse($pesanans as $pesanan)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <span class="font-bold">#{{ $pesanan->id }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">{{ $pesanan->customer->nama }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $pesanan->customer->no_hp }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($pesanan->details && $pesanan->details->count() > 0)
                                        <ul class="list-disc list-inside">
                                            @foreach($pesanan->details as $detail)
                                                <li>
                                                    {{ $detail->mobil->nama_mobil ?? 'Mobil dihapus' }}
                                                    <span class="font-bold">x{{ $detail->jumlah }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ $pesanan->mobil->nama_mobil ?? '-' }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($pesanan->status_pesanan == 'selesai')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Selesai
                                        </span>
                                    @elseif($pesanan->status_pesanan == 'pending')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Pending
                                        </span>
                                    @elseif($pesanan->status_pesanan == 'diproses')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:text-white dark:bg-blue-600">
                                            Diproses
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-600">
                                            Batal
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('pesanan.edit', $pesanan->id) }}"
                                            class="px-2 py-2 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('pesanan.destroy', $pesanan->id) }}', '{{ $pesanan->status_pesanan }}')"
                                            class="px-2 py-2 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                                    Belum ada data pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 sm:grid-cols-9">
                <span class="flex items-center col-span-3">
                    Showing {{ $pesanans->firstItem() }}-{{ $pesanans->lastItem() }} of {{ $pesanans->total() }}
                </span>
            </div>
        </div>
    </div>
    </div>

    <!-- Delete Modal -->
    <div x-data="{ isModalOpen: false, deleteUrl: '', isSelesai: false }" x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        style="display: none;"> <!-- Hide by default to prevent flash -->

        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @keydown.escape="isModalOpen = false"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="modal">

            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="isModalOpen = false">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </header>

            <div class="mt-4 mb-6">
                <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Konfirmasi Hapus Pesanan
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-400">
                    Apakah Anda yakin ingin menghapus data pesanan ini?
                </p>

                <!-- Conditional Option for 'Selesai' -->
                <div x-show="isSelesai"
                    class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md dark:bg-yellow-900 dark:border-yellow-700">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2 mt-0.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-bold text-yellow-800 dark:text-yellow-300">Peringatan: Pesanan Selesai
                            </h4>
                            <p class="mt-1 text-xs text-yellow-700 dark:text-yellow-400">
                                Pesanan ini sudah selesai. Menghapus pesanan ini akan mempengaruhi validitas data penjualan.
                            </p>

                            <div class="mt-3 space-y-2" x-data="{ choice: 'no' }">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="restore_stock_option" value="no" x-model="choice"
                                        @change="document.getElementById('restore_stock_input').value = 'no'"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Biarkan Stok (Rekomendasi)
                                    </span>
                                </label>
                                <p class="ml-6 text-xs text-gray-500 dark:text-gray-400">Stok mobil tidak akan berubah.</p>

                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="restore_stock_option" value="yes" x-model="choice"
                                        @change="document.getElementById('restore_stock_input').value = 'yes'"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Kembalikan Stok
                                    </span>
                                </label>
                                <p class="ml-6 text-xs text-gray-500 dark:text-gray-400">Stok mobil akan bertambah kembali
                                    (+Qty).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                <button @click="isModalOpen = false"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Batal
                </button>

                <form :action="deleteUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="restore_stock" id="restore_stock_input" value="no">

                    <button type="submit"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Hapus Pesanan
                    </button>
                </form>
            </footer>
        </div>
    </div>

    <!-- Script to Handle Modal -->
    <script>
        function openDeleteModal(url, status) {
            // Get Alpine data from the modal element
            let modal = document.querySelector('[x-data="{ isModalOpen: false, deleteUrl: \'\', isSelesai: false }"]');

            // Dispatch event or modify state logic depending on implementation
            // Since we use x-data inline, we can use a global event or helper
            // Simplest way with Alpine 2/3 inline:
            modal.__x.$data.deleteUrl = url;
            modal.__x.$data.isSelesai = (status === 'selesai');
            modal.__x.$data.isModalOpen = true;

            // Reset hidden input
            document.getElementById('restore_stock_input').value = 'no';

            // Check radio button "no" manually
            document.querySelector('input[name="restore_stock_option"][value="no"]').checked = true;
        }
    </script>
@endsection