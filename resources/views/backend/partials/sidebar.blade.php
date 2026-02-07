<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
  <div class="py-4 text-gray-500 dark:text-gray-400">
    <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ url('admin/dashboard') }}">
      Showroom
    </a>
    <ul class="mt-6">
      <!-- Dashboard -->
      <li class="relative px-2 py-1">
        <a class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold transition-colors duration-150 rounded-lg {{ request()->is('admin/dashboard') ? 'text-white bg-purple-600 shadow-md' : 'text-gray-800 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-800 dark:hover:text-gray-200' }}"
          href="{{ url('admin/dashboard') }}">
          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
          </svg>
          <span class="ml-4">Dashboard</span>
        </a>
      </li>
    </ul>

    <ul>
      <!-- Master Data -->
      <li class="relative px-2 py-1"
        x-data="{ isMasterMenuOpen: {{ request()->is('admin/merek*', 'admin/tipe*', 'admin/mobil*', 'admin/promo*') ? 'true' : 'false' }} }">
        <button
          class="inline-flex items-center justify-between w-full px-4 py-2 text-sm font-semibold transition-colors duration-150 rounded-lg hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/merek*', 'admin/tipe*', 'admin/mobil*', 'admin/promo*') ? 'text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-800' : 'text-gray-800 dark:text-gray-400' }}"
          @click="isMasterMenuOpen = !isMasterMenuOpen" aria-haspopup="true">
          <span class="inline-flex items-center">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
              </path>
            </svg>
            <span class="ml-4">Master Data</span>
          </span>
          <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': isMasterMenuOpen }"
            aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isMasterMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
            x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 bg-gray-50 dark:bg-gray-900 rounded-md shadow-inner dark:text-gray-400"
            aria-label="submenu">
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('merek.index') }}">Merek</a>
            </li>
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('tipe.index') }}">Tipe Mobil</a>
            </li>
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('mobil.index') }}">Mobil</a>
            </li>
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('promo.index') }}">Promo</a>
            </li>
          </ul>
        </template>
      </li>

      <!-- Transaksi -->
      <li class="relative px-2 py-1"
        x-data="{ isTransaksiMenuOpen: {{ request()->is('admin/pesanan*', 'admin/laporan*') ? 'true' : 'false' }} }">
        <button
          class="inline-flex items-center justify-between w-full px-4 py-2 text-sm font-semibold transition-colors duration-150 rounded-lg hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/pesanan*', 'admin/laporan*') ? 'text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-800' : 'text-gray-800 dark:text-gray-400' }}"
          @click="isTransaksiMenuOpen = !isTransaksiMenuOpen" aria-haspopup="true">
          <span class="inline-flex items-center">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
              </path>
            </svg>
            <span class="ml-4">Transaksi</span>
          </span>
          <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': isTransaksiMenuOpen }"
            aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isTransaksiMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
            x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 bg-gray-50 dark:bg-gray-900 rounded-md shadow-inner dark:text-gray-400"
            aria-label="submenu">
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('pesanan.index') }}">Pesanan</a>
            </li>
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('laporan.index') }}">Laporan</a>
            </li>
          </ul>
        </template>
      </li>

      <!-- Pengguna -->
      <li class="relative px-2 py-1"
        x-data="{ isPenggunaMenuOpen: {{ request()->is('admin/customer*', 'admin/admin*') ? 'true' : 'false' }} }">
        <button
          class="inline-flex items-center justify-between w-full px-4 py-2 text-sm font-semibold transition-colors duration-150 rounded-lg hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/customer*', 'admin/admin*') ? 'text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-800' : 'text-gray-800 dark:text-gray-400' }}"
          @click="isPenggunaMenuOpen = !isPenggunaMenuOpen" aria-haspopup="true">
          <span class="inline-flex items-center">
            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
              </path>
            </svg>
            <span class="ml-4">Pengguna</span>
          </span>
          <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': isPenggunaMenuOpen }"
            aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <template x-if="isPenggunaMenuOpen">
          <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0"
            x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 bg-gray-50 dark:bg-gray-900 rounded-md shadow-inner dark:text-gray-400"
            aria-label="submenu">
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('customer.index') }}">Customer</a>
            </li>
            <li
              class="px-2 py-1 transition-colors duration-150 rounded-md hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
              <a class="block w-full" href="{{ route('admin.index') }}">Admin</a>
            </li>
          </ul>
        </template>
      </li>
    </ul>


  </div>
</aside>