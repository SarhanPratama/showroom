<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merek;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mereks = Merek::latest()->paginate(10);
        return view('backend.merek.index', compact('mereks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.merek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_merek' => 'required|string|max:255|unique:mereks,nama_merek',
        ]);

        Merek::create($request->all());

        return redirect()->route('merek.index')->with('success', 'Merek berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $merek = Merek::findOrFail($id);
        return view('backend.merek.edit', compact('merek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_merek' => 'required|string|max:255|unique:mereks,nama_merek,' . $id,
        ]);

        $merek = Merek::findOrFail($id);
        $merek->update($request->all());

        return redirect()->route('merek.index')->with('success', 'Merek berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merek = Merek::findOrFail($id);
        $merek->delete();

        return redirect()->route('merek.index')->with('success', 'Merek berhasil dihapus');
    }
}
