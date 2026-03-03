@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit Testimonial
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('admin.testimonial.update', $testimonial) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Customer *</span>
                        <input type="text" name="name" required value="{{ $testimonial->name }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Jabatan / Keterangan</span>
                        <input type="text" name="role" value="{{ $testimonial->role }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                </div>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Isi Ulasan/Testimonial *</span>
                    <textarea name="content" required rows="4"
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">{{ $testimonial->content }}</textarea>
                </label>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/3 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Rating (1-5) *</span>
                        <select name="rating"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="5" {{ $testimonial->rating == 5 ? 'selected' : '' }}>5 Bintang</option>
                            <option value="4" {{ $testimonial->rating == 4 ? 'selected' : '' }}>4 Bintang</option>
                            <option value="3" {{ $testimonial->rating == 3 ? 'selected' : '' }}>3 Bintang</option>
                            <option value="2" {{ $testimonial->rating == 2 ? 'selected' : '' }}>2 Bintang</option>
                            <option value="1" {{ $testimonial->rating == 1 ? 'selected' : '' }}>1 Bintang</option>
                        </select>
                    </label>

                    <label class="block w-2/3 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Foto Profil (Opsional)</span>
                        @if($testimonial->avatar)
                            <div class="mt-2 mb-2">
                                <img src="{{ Storage::url($testimonial->avatar) }}" class="w-16 h-16 object-cover rounded-full">
                            </div>
                        @endif
                        <input type="file" name="avatar" accept="image/*"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>
                </div>

                <div class="flex gap-4 mb-4">
                    <label class="block w-1/2 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Urutan (Order)</span>
                        <input type="number" name="order" value="{{ $testimonial->order }}"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                    </label>

                    <label class="flex items-center w-1/2 mt-7 text-sm">
                        <input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}
                            class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                        <span class="ml-2 text-gray-700 dark:text-gray-400">Aktif</span>
                    </label>
                </div>

                <div class="mt-8 border-t dark:border-gray-700 pt-4 flex justify-end gap-2">
                    <a href="{{ route('admin.testimonial.index') }}"
                        class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Perbarui Testimonial
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection