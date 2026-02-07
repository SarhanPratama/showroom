<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeMobil;

class TipeMobilController extends Controller
{
    public function index()
    {
        $tipes = TipeMobil::latest()->paginate(10);
        return view('backend.tipe.index', compact('tipes'));
    }

    public function create()
    {
        return view('backend.tipe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required|string|max:255|unique:tipe_mobils,nama_tipe',
        ]);

        TipeMobil::create($request->all());

        return redirect()->route('tipe.index')->with('success', 'Tipe mobil berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $tipe = TipeMobil::findOrFail($id);
        return view('backend.tipe.edit', compact('tipe'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_tipe' => 'required|string|max:255|unique:tipe_mobils,nama_tipe,' . $id,
        ]);

        $tipe = TipeMobil::findOrFail($id);
        $tipe->update($request->all());

        return redirect()->route('tipe.index')->with('success', 'Tipe mobil berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $tipe = TipeMobil::findOrFail($id);
        $tipe->delete();

        return redirect()->route('tipe.index')->with('success', 'Tipe mobil berhasil dihapus');
    }
}
