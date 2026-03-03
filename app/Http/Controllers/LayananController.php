<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::orderBy('order', 'asc')->get();
        return view('backend.layanans.index', compact('layanans'));
    }

    public function create()
    {
        return view('backend.layanans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon_class' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Layanan::create([
            'icon_class' => $request->icon_class,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function edit(Layanan $layanan)
    {
        return view('backend.layanans.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'icon_class' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $layanan->update([
            'icon_class' => $request->icon_class,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? $layanan->order,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}
