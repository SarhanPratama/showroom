<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\TipeMobilController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('frontend.frontend');
});

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Master Data
Route::resource('admin/mobil', MobilController::class);
Route::resource('admin/merek', MerekController::class);
Route::resource('admin/tipe', TipeMobilController::class);
Route::resource('admin/promo', PromoController::class);
// Transaksi
Route::resource('admin/pesanan', PesananController::class);

// Pengguna
Route::resource('admin/customer', CustomerController::class);
Route::resource('admin/admin', AdminController::class);

// Laporan
Route::get('admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('admin/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

Route::get('/detail', function () {
    return view('frontend.detail');
});
