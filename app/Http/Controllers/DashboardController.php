<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Pesanan;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter Parameters
        $currentYear = date('Y');
        $filterYear = $request->input('year', $currentYear);
        $filterMonth = $request->input('month');

        $totalMobil = Mobil::count();
        $totalCustomer = Customer::count();

        // Filtered Stats for specific metrics if needed, but keeping global Stats per request context often implies overview.
        // However, for "Realtime" feel based on filter, let's filter the "Pesanan Baru" and "Pendapatan".

        $queryPesanan = Pesanan::query();
        if ($filterYear) {
            $queryPesanan->whereYear('tanggal_pesan', $filterYear);
        }
        if ($filterMonth) {
            $queryPesanan->whereMonth('tanggal_pesan', $filterMonth);
        }

        $pesananBaru = (clone $queryPesanan)->where('status_pesanan', 'pending')->count();
        $pendapatan = (clone $queryPesanan)->where('status_pesanan', 'selesai')->sum('total_harga');

        $pesananTerbaru = Pesanan::with(['customer', 'mobil'])
            ->latest()
            ->take(5)
            ->get();

        // --- CHARTS DATA ---

        // Chart 1: Pendapatan (Line Chart)
        $salesLabels = [];
        $salesData = [];

        $salesQuery = Pesanan::where('status_pesanan', 'selesai')
            ->whereYear('tanggal_pesan', $filterYear);

        if ($filterMonth) {
            $salesQuery->whereMonth('tanggal_pesan', $filterMonth);
            $dailySales = $salesQuery->selectRaw('DAY(tanggal_pesan) as day, SUM(total_harga) as total')
                ->groupBy('day')->orderBy('day')->pluck('total', 'day');

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $filterMonth, $filterYear);
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $salesLabels[] = (string) $i;
                $salesData[] = $dailySales[$i] ?? 0;
            }
        } else {
            $monthlySales = $salesQuery->selectRaw('MONTH(tanggal_pesan) as month, SUM(total_harga) as total')
                ->groupBy('month')->orderBy('month')->pluck('total', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $salesLabels[] = date('F', mktime(0, 0, 0, $i, 1));
                $salesData[] = $monthlySales[$i] ?? 0;
            }
        }

        // Chart 2: Status Pesanan (Pie Chart)
        $statusQuery = Pesanan::whereYear('tanggal_pesan', $filterYear);
        if ($filterMonth) {
            $statusQuery->whereMonth('tanggal_pesan', $filterMonth);
        }
        $statusCounts = $statusQuery->selectRaw('status_pesanan, count(*) as count')
            ->groupBy('status_pesanan')
            ->pluck('count', 'status_pesanan');

        $pieLabels = ['Pending', 'Diproses', 'Selesai', 'Batal'];
        $pieData = [
            $statusCounts['pending'] ?? 0,
            $statusCounts['diproses'] ?? 0,
            $statusCounts['selesai'] ?? 0,
            $statusCounts['batal'] ?? 0,
        ];

        // Chart 3: Top 5 Mobil Terlaris
        $topModelsQuery = Pesanan::where('status_pesanan', 'selesai')
            ->whereYear('tanggal_pesan', $filterYear);
        if ($filterMonth) {
            $topModelsQuery->whereMonth('tanggal_pesan', $filterMonth);
        }
        $topModels = $topModelsQuery->selectRaw('mobil_id, count(*) as total_sold')
            ->with('mobil')
            ->groupBy('mobil_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $topModelLabels = $topModels->map(fn($item) => $item->mobil->nama_mobil ?? 'Unknown');
        $topModelData = $topModels->pluck('total_sold');

        // Chart 4: Customer Growth
        $customerLabels = $salesLabels;
        $customerData = [];

        $customerQuery = Customer::whereYear('created_at', $filterYear);
        if ($filterMonth) {
            $customerQuery->whereMonth('created_at', $filterMonth);
            $dailyCustomers = $customerQuery->selectRaw('DAY(created_at) as day, count(*) as count')
                ->groupBy('day')->orderBy('day')->pluck('count', 'day');

            for ($i = 1; $i <= count($salesLabels); $i++) {
                $customerData[] = $dailyCustomers[$i] ?? 0;
            }
        } else {
            $monthlyCustomers = $customerQuery->selectRaw('MONTH(created_at) as month, count(*) as count')
                ->groupBy('month')->orderBy('month')->pluck('count', 'month');

            for ($i = 1; $i <= 12; $i++) {
                $customerData[] = $monthlyCustomers[$i] ?? 0;
            }
        }

        return view('backend.dashboard.index', compact(
            'totalMobil',
            'pesananBaru',
            'pendapatan',
            'totalCustomer',
            'pesananTerbaru',
            'salesLabels',
            'salesData',
            'pieLabels',
            'pieData',
            'topModelLabels',
            'topModelData',
            'customerLabels',
            'customerData',
            'filterYear',
            'filterMonth'
        ));
    }
}
