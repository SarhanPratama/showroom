<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Merek;
use App\Models\TipeMobil;
use App\Models\InventoryMobil;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobils = Mobil::with(['merek', 'tipe'])->latest()->paginate(10);
        return view('backend.mobil.index', compact('mobils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mereks = Merek::all();
        $tipes = TipeMobil::all();
        return view('backend.mobil.create', compact('mereks', 'tipes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'merek_id' => 'required|exists:mereks,id',
            'tipe_id' => 'required|exists:tipe_mobils,id',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $mobil = Mobil::create([
            'nama_mobil' => $request->nama_mobil,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'merek_id' => $request->merek_id,
            'tipe_id' => $request->tipe_id,
        ]);

        // Sync with Inventory
        InventoryMobil::create([
            'mobil_id' => $mobil->id,
            'jumlah_stok' => $mobil->stok,
            'status_ready' => $mobil->stok > 0,
        ]);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mobil = Mobil::findOrFail($id);
        $mereks = Merek::all();
        $tipes = TipeMobil::all();
        return view('backend.mobil.edit', compact('mobil', 'mereks', 'tipes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'merek_id' => 'required|exists:mereks,id',
            'tipe_id' => 'required|exists:tipe_mobils,id',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $mobil = Mobil::findOrFail($id);
        $mobil->update([
            'nama_mobil' => $request->nama_mobil,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'merek_id' => $request->merek_id,
            'tipe_id' => $request->tipe_id,
        ]);

        // Update Inventory
        $inventory = InventoryMobil::where('mobil_id', $mobil->id)->first();
        if ($inventory) {
            $inventory->update([
                'jumlah_stok' => $mobil->stok,
                'status_ready' => $mobil->stok > 0,
            ]);
        } else {
            InventoryMobil::create([
                'mobil_id' => $mobil->id,
                'jumlah_stok' => $mobil->stok,
                'status_ready' => $mobil->stok > 0,
            ]);
        }

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->delete();

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus');
    }
}
