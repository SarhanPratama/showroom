@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <div class="flex items-center justify-between mb-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Slider Depan
            </h2>
            <a href="{{ route('admin.slider.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <i class="fas fa-plus mr-2"></i> Tambah Slider
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                {{ session('success') }}
            </div>
        @endif

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Gambar</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse($sliders as $slider)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="relative group cursor-pointer"
                                        style="width: 128px; height: 80px; border-radius: 0.5rem;"
                                        @click="$dispatch('open-img-modal', { src: '{{ Storage::url($slider->image) }}' })">
                                        <div style="width: 100%; height: 100%; overflow: hidden; border-radius: 0.5rem;">
                                            <img src="{{ Storage::url($slider->image) }}" alt="Slider"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                            style="border-radius: 0.5rem;">
                                            <i
                                                class="fas fa-search-plus text-white text-2xl drop-shadow-md transform scale-75 group-hover:scale-100 transition-transform duration-300"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold">{{ $slider->title }}</p>
                                    @if($slider->subtitle)
                                        <p class="text-xs text-gray-500">{{ Str::limit($slider->subtitle, 40) }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($slider->is_active)
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Aktif</span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $slider->order }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('admin.slider.edit', $slider) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.slider.destroy', $slider) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus slider ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-red-400 focus:outline-none focus:shadow-outline-gray"
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
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada slider
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection