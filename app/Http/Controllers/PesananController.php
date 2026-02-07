<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::with(['customer', 'mobil'])->latest()->paginate(10);
        return view('backend.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = \App\Models\Customer::all();
        $mobils = \App\Models\Mobil::where('stok', '>', 0)->get();
        return view('backend.pesanan.create', compact('customers', 'mobils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_pesan' => 'required|date',
            'status_pesanan' => 'required|in:pending,diproses,selesai,batal',
        ]);

        $mobil = \App\Models\Mobil::findOrFail($request->mobil_id);

        if ($mobil->stok < 1) {
            return back()->with('error', 'Stok mobil habis!');
        }

        // Create Order
        Pesanan::create([
            'customer_id' => $request->customer_id,
            'mobil_id' => $request->mobil_id,
            'tanggal_pesan' => $request->tanggal_pesan,
            'status_pesanan' => $request->status_pesanan,
            'total_harga' => $mobil->harga, // Auto price from Mobil
        ]);

        // Decrement Stock
        $mobil->decrement('stok');

        // Update Inventory Log if exists
        $inventory = \App\Models\InventoryMobil::where('mobil_id', $mobil->id)->first();
        if ($inventory) {
            $inventory->update(['jumlah_stok' => $mobil->stok, 'status_ready' => $mobil->stok > 0]);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pesanan = Pesanan::with(['customer', 'mobil'])->findOrFail($id);
        return view('backend.pesanan.show', compact('pesanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('backend.pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_pesanan' => 'required|in:pending,diproses,selesai,batal',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update([
            'status_pesanan' => $request->status_pesanan,
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Status pesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
