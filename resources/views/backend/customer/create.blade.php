@extends('backend.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tambah Customer Baru
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('customer.store') }}" method="POST" autocomplete="off">
                @csrf
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Nama Lengkap</span>
                    <input type="text" name="nama" required
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        placeholder="Nama Customer">
                </label>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input type="email" name="email" required autocomplete="off"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        placeholder="email@example.com">
                </label>

                <div class="mt-4" x-data="{ show: false }">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required minlength="8"
                                autocomplete="new-password"
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input pr-10"
                                placeholder="********">
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </label>
                </div>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">No HP</span>
                    <input type="text" name="no_hp" required
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-200 dark:focus:shadow-outline-gray form-input"
                        placeholder="08123456789">
                </label>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                    <textarea name="alamat" required rows="3"
                        class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        placeholder="Alamat lengkap"></textarea>
                </label>

                <div class="flex mt-6 justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Simpan Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection