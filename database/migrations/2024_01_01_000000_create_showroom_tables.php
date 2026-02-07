<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Admins
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('admin'); // enum('admin')
            $table->timestamps();
        });

        // 2. Mereks
        Schema::create('mereks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_merek');
            $table->timestamps();
        });

        // 3. Tipe Mobils
        Schema::create('tipe_mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tipe');
            $table->timestamps();
        });

        // 4. Mobils
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mobil');
            $table->decimal('harga', 15, 2);
            $table->integer('stok')->default(0);
            $table->text('deskripsi')->nullable();

            // Foreign Keys
            $table->foreignId('merek_id')->constrained('mereks')->onDelete('cascade');
            $table->foreignId('tipe_id')->constrained('tipe_mobils')->onDelete('cascade');

            $table->timestamps();
        });

        // 5. Inventory Mobils
        Schema::create('inventory_mobils', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_stok');
            $table->boolean('status_ready')->default(true);

            // Foreign Keys
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');

            $table->timestamps();
        });

        // 6. Promos
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_promo');
            $table->integer('diskon'); // Percent or Value
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });

        // 7. Mobil Promo (Pivot)
        Schema::create('mobil_promo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            $table->foreignId('promo_id')->constrained('promos')->onDelete('cascade');
            $table->timestamps();
        });

        // 8. Customers
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('password');
            $table->timestamps();
        });

        // 9. Pesanans
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pesan');
            $table->enum('status_pesanan', ['pending', 'diproses', 'selesai', 'batal'])->default('pending');
            $table->decimal('total_harga', 15, 2);

            // Foreign Keys
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');

            $table->timestamps();
        });

        // 10. Laporans
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_laporan', ['penjualan', 'stok', 'promo']);
            $table->date('tanggal_cetak');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps();
        });

        // 11. Kalkulator Kredit
        Schema::create('kalkulator_kredits', function (Blueprint $table) {
            $table->id();
            $table->decimal('uang_muka', 15, 2);
            $table->integer('tenor_bulan');
            $table->decimal('cicilan_bulanan', 15, 2);
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalkulator_kredits');
        Schema::dropIfExists('laporans');
        Schema::dropIfExists('pesanans');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('mobil_promo');
        Schema::dropIfExists('promos');
        Schema::dropIfExists('inventory_mobils');
        Schema::dropIfExists('mobils');
        Schema::dropIfExists('tipe_mobils');
        Schema::dropIfExists('mereks');
        Schema::dropIfExists('admins');
    }
};
