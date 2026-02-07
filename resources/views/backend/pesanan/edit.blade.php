@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Update Status Pesanan #{{ $pesanan->id }}
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Info Pesanan -->
            <div class="mb-6">
                <h4 class="mb-2 text-lg font-semibold text-gray-600 dark:text-gray-200">Detail Pesanan</h4>
                <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-bold">Customer:</span>
                        {{ $pesanan->customer->nama }} ({{ $pesanan->customer->no_hp }})</p>
                    <div class="mb-2">
                        <span class="font-bold text-sm text-gray-600 dark:text-gray-400">Mobil Dipesan:</span>
                        @if($pesanan->details && $pesanan->details->count() > 0)
                            <ul class="list-disc list-inside mt-1 text-sm text-gray-600 dark:text-gray-400">
                                @foreach($pesanan->details as $detail)
                                    <li>
                                        {{ $detail->mobil->nama_mobil ?? 'Mobil dihapus' }}
                                        Box <span class="font-bold">x{{ $detail->jumlah }}</span>
                                        (Rp {{ number_format($detail->subtotal, 0, ',', '.') }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $pesanan->mobil->nama_mobil ?? '-' }}</p>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-bold">Total Harga:</span> Rp
                        {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><span class="font-bold">Tanggal Pesan:</span>
                        {{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d F Y') }}</p>
                </div>
            </div>

            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Status Pesanan</span>
                    <select name="status_pesanan"
                        class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="pending" {{ $pesanan->status_pesanan == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $pesanan->status_pesanan == 'diproses' ? 'selected' : '' }}>Diproses
                        </option>
                        <option value="selesai" {{ $pesanan->status_pesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="batal" {{ $pesanan->status_pesanan == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                </label>

                <div class="flex mt-6 text-sm">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('pesanan.index') }}"
                        class="ml-4 px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection