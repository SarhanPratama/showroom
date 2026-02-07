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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });

        // Optional: Remove mobil_id from pesanans if you want to strictly enforce DetailPesanan
        // But for safety, I'll keep it nullable or ignore it for now, 
        // OR better, drop it to force using DetailPesanan.
        Schema::table('pesanans', function (Blueprint $table) {
            // We can drop the foreign key first, then the column
            // $table->dropForeign(['mobil_id']);
            // $table->dropColumn('mobil_id');
            // For now, let's just make it nullable to avoid breaking existing data immediately if any
            $table->foreignId('mobil_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
