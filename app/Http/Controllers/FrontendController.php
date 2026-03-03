<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Merek;
use App\Models\TipeMobil;
use App\Models\Slider;
use App\Models\Layanan;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::where('is_active', true)->orderBy('order', 'asc')->get();
        $layanans = Layanan::where('is_active', true)->orderBy('order', 'asc')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order', 'asc')->get();

        // Base query for cars
        $query = Mobil::with(['merek', 'tipe', 'promos'])->latest();

        // Apply filters if present
        if ($request->filled('merek') && $request->merek != 'Semua Merek') {
            $query->where('merek_id', $request->merek);
        }

        if ($request->filled('tipe') && $request->tipe != 'Semua Tipe') {
            $query->where('tipe_id', $request->tipe);
        }

        if ($request->filled('harga') && $request->harga != 'Semua Harga') {
            if ($request->harga == '< 100 Juta') {
                $query->where('harga', '<', 100000000);
            } elseif ($request->harga == '100 - 200 Juta') {
                $query->whereBetween('harga', [100000000, 200000000]);
            } elseif ($request->harga == '> 200 Juta') {
                $query->where('harga', '>', 200000000);
            }
        }

        // Ambil hasil filter atau 6 mobil terbaru untuk katalog depan jika tidak ada filter
        if ($request->hasAny(['merek', 'tipe', 'harga'])) {
            $mobils = $query->get();
        } else {
            $mobils = $query->take(6)->get();
        }

        return view('frontend.frontend', compact('sliders', 'layanans', 'testimonials', 'mobils'));
    }

    public function detail($id)
    {
        $mobil = Mobil::with(['merek', 'tipe', 'promos'])->findOrFail($id);

        // Ambil rekomendasi mobil lain yang sejenis atau merek sama
        $rekomendasi = Mobil::with(['merek', 'tipe', 'promos'])
            ->where('id', '!=', $id)
            ->where('merek_id', $mobil->merek_id)
            ->take(3)
            ->get();

        // Jika rekomendasi kurang, ambil secara random
        if ($rekomendasi->count() < 3) {
            $random = Mobil::with(['merek', 'tipe', 'promos'])
                ->where('id', '!=', $id)
                ->whereNotIn('id', $rekomendasi->pluck('id'))
                ->inRandomOrder()
                ->take(3 - $rekomendasi->count())
                ->get();
            $rekomendasi = $rekomendasi->concat($random);
        }

        return view('frontend.detail', compact('mobil', 'rekomendasi'));
    }
}
