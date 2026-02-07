<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $query = Pesanan::with(['customer', 'mobil'])->latest();

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_pesan', [$startDate, $endDate]);
        }

        if ($status) {
            $query->where('status_pesanan', $status);
        }

        $laporans = $query->get();
        $totalPendapatan = $laporans->where('status_pesanan', 'selesai')->sum('total_harga');

        return view('backend.laporan.index', compact('laporans', 'startDate', 'endDate', 'status', 'totalPendapatan'));
    }

    public function cetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $query = Pesanan::with(['customer', 'mobil'])->latest();

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_pesan', [$startDate, $endDate]);
        }

        if ($status) {
            $query->where('status_pesanan', $status);
        }

        $laporans = $query->get();
        $totalPendapatan = $laporans->where('status_pesanan', 'selesai')->sum('total_harga');

        return view('backend.laporan.cetak', compact('laporans', 'startDate', 'endDate', 'status', 'totalPendapatan'));
    }
}
