<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('backend.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('backend.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'diskon' => 'required|numeric|min:0|max:100', // Assuming percentage
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Promo::create($request->all());

        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $promo = Promo::findOrFail($id);
        return view('backend.promo.edit', compact('promo'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'diskon' => 'required|numeric|min:0|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $promo = Promo::findOrFail($id);
        $promo->update($request->all());

        return redirect()->route('promo.index')->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus');
    }
}
