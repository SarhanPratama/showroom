@extends('backend.layouts.app')

@section('content')
  <div class="container grid px-6 mx-auto animate-fade-in-up">

    <div class="flex items-center justify-between my-6">
      <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Dashboard
      </h2>

      <!-- Filter Button & Dropdown -->
      <div x-data="{ open: false }" @click.away="open = false" @keydown.escape="open = false" class="relative z-30">
        <button @click="open = !open"
          class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple shadow-md">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
            </path>
          </svg>
          <span>Filter Project</span>
          <svg class="w-4 h-4 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="currentColor"
            viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
          x-transition:leave-end="transform opacity-0 scale-95"
          class="absolute right-0 w-64 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
          style="display: none;">

          <div class="px-4 py-3 border-b dark:border-gray-700">
            <span class="block text-sm font-medium text-gray-900 dark:text-white">Filter Dashboard</span>
          </div>

          <form action="{{ route('admin.dashboard') }}" method="GET" class="p-4">
            <div class="mb-4">
              <label class="block mb-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                Bulan
              </label>
              <select name="month"
                class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray rounded-md">
                <option value="">Semua Bulan</option>
                @foreach(range(1, 12) as $m)
                  <option value="{{ $m }}" {{ $filterMonth == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-4">
              <label class="block mb-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                Tahun
              </label>
              <select name="year"
                class="block w-full mt-1 text-sm dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray rounded-md">
                @foreach(range(date('Y'), 2020) as $y)
                  <option value="{{ $y }}" {{ $filterYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex items-center justify-between pt-2 border-t dark:border-gray-700 mt-2">
              <a href="{{ route('admin.dashboard') }}"
                class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Reset</a>
              <button type="submit"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Terapkan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
      <!-- Card 1 -->
      <div
        class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 transform hover:scale-105 transition duration-300">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
            </path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Mobil</p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalMobil }}</p>
        </div>
      </div>
      <!-- Card 2 -->
      <div
        class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 transform hover:scale-105 transition duration-300">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
              clip-rule="evenodd"></path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pesanan Baru
            ({{ $filterMonth ? date('M', mktime(0, 0, 0, $filterMonth, 1)) : 'All' }})</p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $pesananBaru }}</p>
        </div>
      </div>
      <!-- Card 3 -->
      <div
        class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 transform hover:scale-105 transition duration-300">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
            </path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pendapatan
            ({{ $filterMonth ? date('M', mktime(0, 0, 0, $filterMonth, 1)) : 'All' }})</p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Rp
            {{ number_format($pendapatan, 0, ',', '.') }}
          </p>
        </div>
      </div>
      <!-- Card 4 -->
      <div
        class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 transform hover:scale-105 transition duration-300">
        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
              clip-rule="evenodd"></path>
          </svg>
        </div>
        <div>
          <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Customer</p>
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalCustomer }}</p>
        </div>
      </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
      <!-- Sales Chart -->
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-200">
          Trend Pendapatan
        </h4>
        <canvas id="salesChart"></canvas>
      </div>
      <!-- Status Chart -->
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-200">
          Distribusi Status Pesanan
        </h4>
        <canvas id="statusChart"></canvas>
      </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="grid gap-6 mb-8 md:grid-cols-2">
      <!-- Top Models Chart -->
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-200">
          5 Mobil Terlaris
        </h4>
        <canvas id="topModelsChart"></canvas>
      </div>
      <!-- Customer Growth Chart -->
      <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-200">
          Pertumbuhan Customer Baru
        </h4>
        <canvas id="customerGrowthChart"></canvas>
      </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-8">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Customer</th>
              <th class="px-4 py-3">Mobil</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Tanggal</th>
              <th class="px-4 py-3">Harga</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @forelse($pesananTerbaru as $pesanan)
              <tr
                class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-150">
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold">{{ $pesanan->customer->nama }}</p>
                      <p class="text-xs text-gray-600 dark:text-gray-400">{{ $pesanan->customer->no_hp }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 text-sm">
                  @if($pesanan->details->count() > 0)
                    <ul class="list-disc list-inside text-xs">
                      @foreach($pesanan->details->take(2) as $detail)
                        <li>{{ $detail->mobil ? $detail->mobil->nama_mobil : 'Mobil dihapus' }}</li>
                      @endforeach
                      @if($pesanan->details->count() > 2)
                        <li class="italic text-gray-500">+{{ $pesanan->details->count() - 2 }} lainnya</li>
                      @endif
                    </ul>
                  @elseif($pesanan->mobil)
                    {{ $pesanan->mobil->nama_mobil }}
                  @else
                    <span class="text-red-500 italic text-xs">Data mobil tidak ditemukan</span>
                  @endif
                </td>
                <td class="px-4 py-3 text-xs">
                  @if($pesanan->status_pesanan == 'selesai')
                    <span
                      class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Selesai</span>
                  @elseif($pesanan->status_pesanan == 'pending')
                    <span
                      class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-500">Pending</span>
                  @elseif($pesanan->status_pesanan == 'diproses')
                    <span
                      class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">Diproses</span>
                  @else
                    <span
                      class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-white dark:bg-red-600">Batal</span>
                  @endif
                </td>
                <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y') }}</td>
                <td class="px-4 py-3 text-sm">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-4 py-3 text-center">Belum ada pesanan terbaru.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Common DataLabels Options
      const commonDataLabels = {
        backgroundColor: function (context) {
          return context.dataset.backgroundColor;
        },
        borderRadius: 4,
        color: 'white',
        font: {
          weight: 'bold'
        },
        formatter: Math.round,
        padding: 6
      };

      // --- 1. Pendapatan Chart ---
      const salesCtx = document.getElementById('salesChart').getContext('2d');
      new Chart(salesCtx, {
        type: 'line',
        data: {
          labels: @json($salesLabels),
          datasets: [{
            label: 'Pendapatan (Rp)',
            backgroundColor: 'rgba(126, 58, 242, 0.1)',
            borderColor: '#7e3af2', // Purple
            data: @json($salesData),
            fill: true,
            datalabels: {
              align: 'end',
              anchor: 'end',
              backgroundColor: '#7e3af2',
              borderRadius: 4,
              color: 'white',
              font: { weight: 'bold' },
              formatter: function (value) {
                if (value >= 1000000) return (value / 1000000).toFixed(1) + 'Jt';
                if (value >= 1000) return (value / 1000).toFixed(1) + 'K';
                return value;
              }
            }
          }]
        },
        options: {
          responsive: true,
          legend: { display: false },
          tooltips: { mode: 'index', intersect: false },
          scales: {
            xAxes: [{ gridLines: { display: false } }],
            yAxes: [{ ticks: { beginAtZero: true } }]
          },
          plugins: {
            datalabels: { display: 'auto' }
          }
        }
      });

      // --- 2. Status Chart ---
      const statusCtx = document.getElementById('statusChart').getContext('2d');
      new Chart(statusCtx, {
        type: 'doughnut',
        data: {
          datasets: [{
            data: @json($pieData),
            backgroundColor: ['#ff5a1f', '#3f83f8', '#0e9f6e', '#e02424'],
          }],
          labels: @json($pieLabels)
        },
        options: {
          responsive: true,
          cutoutPercentage: 70,
          legend: { position: 'right' },
          plugins: {
            datalabels: {
              color: 'white',
              font: { size: 14, weight: 'bold' },
              formatter: (value, ctx) => {
                let sum = 0;
                let dataArr = ctx.chart.data.datasets[0].data;
                dataArr.map(data => {
                  sum += data;
                });
                let percentage = (value * 100 / sum).toFixed(0) + "%";
                return value > 0 ? value : '';
              }
            }
          }
        }
      });

      // --- 3. Top Models Chart ---
      const topModelsCtx = document.getElementById('topModelsChart').getContext('2d');
      new Chart(topModelsCtx, {
        type: 'bar',
        data: {
          labels: @json($topModelLabels),
          datasets: [{
            label: 'Unit Terjual',
            backgroundColor: '#1c64f2',
            data: @json($topModelData),
            datalabels: {
              anchor: 'end',
              align: 'top',
              color: 'gray', // Dark mode compatible color handling might be needed, using gray for visibility on white/dark
              font: { weight: 'bold' }
            }
          }]
        },
        options: {
          responsive: true,
          legend: { display: false },
          scales: {
            xAxes: [{ gridLines: { display: false } }],
            yAxes: [{ ticks: { beginAtZero: true, stepSize: 1 } }]
          }
        }
      });

      // --- 4. Customer Growth Chart ---
      const customerCtx = document.getElementById('customerGrowthChart').getContext('2d');
      new Chart(customerCtx, {
        type: 'line',
        data: {
          labels: @json($customerLabels),
          datasets: [{
            label: 'Customer Baru',
            backgroundColor: 'rgba(28, 100, 242, 0.1)',
            borderColor: '#1c64f2',
            data: @json($customerData),
            fill: true,
            datalabels: {
              align: 'end',
              anchor: 'end',
              backgroundColor: '#1c64f2',
              borderRadius: 4,
              color: 'white',
              font: { weight: 'bold' },
              display: 'auto'
            }
          }]
        },
        options: {
          responsive: true,
          legend: { display: false },
          tooltips: { mode: 'index', intersect: false },
          scales: {
            xAxes: [{ gridLines: { display: false } }],
            yAxes: [{ ticks: { beginAtZero: true, stepSize: 1 } }]
          }
        }
      });
    });
  </script>
@endsection