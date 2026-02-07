@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Laporan Transaksi
        </h2>

        <!-- Filter -->
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto flex-1">
                    <label class="block text-sm flex-1">
                        <span class="text-gray-700 dark:text-gray-400">Dari Tanggal</span>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input" />
                    </label>
                    <label class="block text-sm flex-1">
                        <span class="text-gray-700 dark:text-gray-400">Sampai Tanggal</span>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input" />
                    </label>
                    <label class="block text-sm flex-1">
                        <span class="text-gray-700 dark:text-gray-400">Status</span>
                        <select name="status"
                            class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="">Semua Status</option>
                            <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="batal" {{ $status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </label>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Filter
                    </button>

                    @if(count($laporans) > 0)
                        <a href="{{ route('laporan.cetak', ['start_date' => $startDate, 'end_date' => $endDate, 'status' => $status]) }}"
                            target="_blank"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:shadow-outline-gray">
                            Cetak Laporan
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Summary -->
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Pendapatan (Selesai): Rp
                {{ number_format($totalPendapatan, 0, ',', '.') }}
            </p>
        </div>

        <!-- Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Mobil</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse($laporans as $laporan)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ \Carbon\Carbon::parse($laporan->tanggal_pesan)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-semibold">
                                    {{ $laporan->customer->nama }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($laporan->details->count() > 0)
                                        <ul class="list-disc list-inside">
                                            @foreach($laporan->details as $detail)
                                                <li>
                                                    {{ $detail->mobil ? $detail->mobil->nama_mobil : 'Mobil dihapus' }}
                                                    <span class="text-xs text-gray-500">({{ $detail->jumlah }}x)</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @elseif($laporan->mobil)
                                        {{ $laporan->mobil->nama_mobil }}
                                    @else
                                        <span class="text-red-500 italic">Data mobil tidak ditemukan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($laporan->status_pesanan == 'selesai')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Selesai</span>
                                    @elseif($laporan->status_pesanan == 'pending')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-500">Pending</span>
                                    @elseif($laporan->status_pesanan == 'diproses')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">Diproses</span>
                                    @elseif($laporan->status_pesanan == 'batal')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-600">Batal</span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-white dark:bg-gray-600">{{ ucfirst($laporan->status_pesanan) }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format($laporan->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">Tidak ada data laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection