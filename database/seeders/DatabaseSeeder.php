<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Merek;
use App\Models\TipeMobil;
use App\Models\Mobil;
use App\Models\InventoryMobil;
use App\Models\Customer;
use App\Models\Pesanan;
use App\Models\Promo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin
        Admin::create([
            'nama' => 'Super Admin',
            'email' => 'admin@showroom.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Merek
        $mereks = ['Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Daihatsu', 'BMW', 'Mercedes-Benz'];
        foreach ($mereks as $m) {
            Merek::create(['nama_merek' => $m]);
        }

        // 3. Tipe Mobil
        $tipes = ['SUV', 'MPV', 'Sedan', 'Hatchback', 'LCGC', 'Coupe'];
        foreach ($tipes as $t) {
            TipeMobil::create(['nama_tipe' => $t]);
        }

        // 4. Mobil & Inventory
        $daftarMobil = [
            ['nama' => 'Avanza G', 'harga' => 250000000, 'merek' => 'Toyota', 'tipe' => 'MPV'],
            ['nama' => 'Brio RS', 'harga' => 190000000, 'merek' => 'Honda', 'tipe' => 'Hatchback'],
            ['nama' => 'Pajero Sport', 'harga' => 600000000, 'merek' => 'Mitsubishi', 'tipe' => 'SUV'],
            ['nama' => 'Civic Turbo', 'harga' => 550000000, 'merek' => 'Honda', 'tipe' => 'Sedan'],
            ['nama' => 'Xpander Cross', 'harga' => 320000000, 'merek' => 'Mitsubishi', 'tipe' => 'MPV'],
            ['nama' => 'Innova Zenix', 'harga' => 450000000, 'merek' => 'Toyota', 'tipe' => 'MPV'],
            ['nama' => 'Sigra R', 'harga' => 160000000, 'merek' => 'Daihatsu', 'tipe' => 'LCGC'],
            ['nama' => 'BMW 320i', 'harga' => 900000000, 'merek' => 'BMW', 'tipe' => 'Sedan'],
            ['nama' => 'Jimny', 'harga' => 450000000, 'merek' => 'Suzuki', 'tipe' => 'SUV'],
            ['nama' => 'Alphard', 'harga' => 1200000000, 'merek' => 'Toyota', 'tipe' => 'MPV'],
        ];

        foreach ($daftarMobil as $data) {
            $merekId = Merek::where('nama_merek', $data['merek'])->first()->id;
            $tipeId = TipeMobil::where('nama_tipe', $data['tipe'])->first()->id;
            $stok = rand(2, 10);

            $mobil = Mobil::create([
                'nama_mobil' => $data['nama'],
                'harga' => $data['harga'],
                'stok' => $stok,
                'deskripsi' => 'Mobil ' . $data['nama'] . ' terbaik di kelasnya with fitur canggih.',
                'merek_id' => $merekId,
                'tipe_id' => $tipeId,
            ]);

            InventoryMobil::create([
                'mobil_id' => $mobil->id,
                'jumlah_stok' => $stok,
                'status_ready' => true,
            ]);
        }

        // 5. Customer
        $customers = [
            ['nama' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'hp' => '08123456789'],
            ['nama' => 'Siti Aminah', 'email' => 'siti@gmail.com', 'hp' => '08987654321'],
            ['nama' => 'Andi Wijaya', 'email' => 'andi@gmail.com', 'hp' => '08129876543'],
            ['nama' => 'Rina Kartika', 'email' => 'rina@gmail.com', 'hp' => '08121234567'],
            ['nama' => 'Doni Irawan', 'email' => 'doni@gmail.com', 'hp' => '08123344556'],
        ];

        foreach ($customers as $c) {
            Customer::create([
                'nama' => $c['nama'],
                'email' => $c['email'],
                'no_hp' => $c['hp'],
                'alamat' => 'Jl. Sudirman No. ' . rand(1, 100) . ', Jakarta',
                'password' => Hash::make('password'),
            ]);
        }

        // 6. Promo
        Promo::create([
            'nama_promo' => 'Diskon Akhir Tahun',
            'diskon' => 10,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonth(),
        ]);

        // 7. Pesanan
        $customerIds = Customer::pluck('id')->toArray();
        $mobilIds = Mobil::pluck('id')->toArray();
        $statuses = ['pending', 'diproses', 'selesai', 'batal'];

        for ($i = 0; $i < 15; $i++) {
            $mobil = Mobil::find($mobilIds[array_rand($mobilIds)]);

            Pesanan::create([
                'tanggal_pesan' => now()->subDays(rand(0, 30)),
                'status_pesanan' => $statuses[array_rand($statuses)],
                'total_harga' => $mobil->harga,
                'customer_id' => $customerIds[array_rand($customerIds)],
                'mobil_id' => $mobil->id,
            ]);
        }
    }
}
