<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\TipeMobilController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;

Route::get('/install/frontend-data', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'FrontendDataSeeder', '--force' => true]);
    return "✅ Database Migrations Applied & Frontend Data Seeded Successfully! Data aman!";
});

Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('frontend.home');

// Auth Routes
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Master Data
    Route::delete('admin/mobil/image/{id}', [MobilController::class, 'destroyImage'])->name('admin.mobil.destroyImage');
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
    // Manajemen Konten Frontend
    Route::resource('admin/slider', \App\Http\Controllers\SliderController::class)->names([
        'index' => 'admin.slider.index',
        'create' => 'admin.slider.create',
        'store' => 'admin.slider.store',
        'edit' => 'admin.slider.edit',
        'update' => 'admin.slider.update',
        'destroy' => 'admin.slider.destroy',
    ]);
    Route::resource('admin/layanan', \App\Http\Controllers\LayananController::class)->names([
        'index' => 'admin.layanan.index',
        'create' => 'admin.layanan.create',
        'store' => 'admin.layanan.store',
        'edit' => 'admin.layanan.edit',
        'update' => 'admin.layanan.update',
        'destroy' => 'admin.layanan.destroy',
    ]);
    Route::resource('admin/testimonial', \App\Http\Controllers\TestimonialController::class)->names([
        'index' => 'admin.testimonial.index',
        'create' => 'admin.testimonial.create',
        'store' => 'admin.testimonial.store',
        'edit' => 'admin.testimonial.edit',
        'update' => 'admin.testimonial.update',
        'destroy' => 'admin.testimonial.destroy',
    ]);
    Route::get('admin/setting', [\App\Http\Controllers\SettingController::class, 'index'])->name('admin.setting.index');
    Route::post('admin/setting', [\App\Http\Controllers\SettingController::class, 'update'])->name('admin.setting.update');

});

Route::get('/detail/{id}', [\App\Http\Controllers\FrontendController::class, 'detail'])->name('frontend.detail');
