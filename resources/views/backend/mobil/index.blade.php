@extends('backend.layouts.app')

@section('content')
    <div class="container grid px-6 mx-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Data Mobil
        </h2>

        <!-- CTA -->
        <div
            class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                </svg>
                <span>Kelola data mobil showroom anda di sini.</span>
            </div>
            <a href="{{ route('mobil.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-purple-600 transition-colors duration-150 bg-white border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 hover:text-white focus:outline-none focus:shadow-outline-purple">
                Tambah Mobil &plus;
            </a>
        </div>

        <!-- TABLE -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Nama Mobil</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">Merek / Tipe</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse($mobils as $mobil)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar with image -->
                                        @if($mobil->image)
                                            <div class="relative w-12 h-12 mr-3 rounded-full md:block group cursor-pointer"
                                                @click="$dispatch('open-img-modal', { src: '{{ str_starts_with($mobil->image, 'http') ? $mobil->image : Storage::url($mobil->image) }}' })">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ str_starts_with($mobil->image, 'http') ? $mobil->image : Storage::url($mobil->image) }}"
                                                    alt="{{ $mobil->nama_mobil }}" loading="lazy" />
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    <i
                                                        class="fas fa-search-plus text-white text-sm transform scale-75 group-hover:scale-100 transition-transform duration-300"></i>
                                                </div>
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                        @else
                                            <div class="relative hidden w-12 h-12 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="https://ui-avatars.com/api/?name={{ urlencode($mobil->merek->nama_merek) }}&background=random"
                                                    alt="{{ $mobil->nama_mobil }}" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold">{{ $mobil->nama_mobil }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                ID: #{{ $mobil->id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Rp {{ number_format($mobil->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($mobil->stok > 0)
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            {{ $mobil->stok }} Unit
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-600">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $mobil->merek ? $mobil->merek->nama_merek : '-' }} /
                                    {{ $mobil->tipe ? $mobil->tipe->nama_tipe : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('mobil.edit', $mobil->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('mobil.destroy', $mobil->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                    Belum ada data mobil.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 sm:grid-cols-9">
                <span class="flex items-center col-span-3">
                    Showing {{ $mobils->firstItem() }}-{{ $mobils->lastItem() }} of {{ $mobils->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination logic can be added here -->
            </div>
        </div>
    </div>
@endsection