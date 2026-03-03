<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Layanan;
use App\Models\Testimonial;
use App\Models\Setting;

class FrontendDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Setings
        $settings = [
            'site_tagline' => 'Showroom Terpercaya Pekanbaru',
            'site_description' => 'Koleksi mobil bekas berkualitas dengan inspeksi ketat, harga transparan, dan jaminan keamanan dokumen.',
            'address' => "Jl. Soekarno Hatta No. 88, Arengka,\nPekanbaru, Riau 28293",
            'phone' => '0761-123456',
            'whatsapp' => '6281380846977',
            'email' => 'info@showroom.com',
            'facebook' => 'https://facebook.com/showroom',
            'instagram' => 'https://instagram.com/showroom',
            'maps_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6583684773!2d101.45506541475336!3d0.5070693996084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aedefc5b6b51%3A0x5f5160f9c2c3b9f2!2sPekanbaru%2C%20Riau!5e0!3m2!1sen!2sid!4v1234567890" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="absolute inset-0 w-full h-full grayscale group-hover:grayscale-0 transition-all duration-500"></iframe>'
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Seed Sliders
        Slider::truncate();
        Slider::create([
            'title' => 'Temukan Mobil Impian Anda',
            'badge_text' => 'Showroom Terpercaya Pekanbaru',
            'subtitle' => 'Koleksi mobil bekas berkualitas dengan inspeksi ketat, harga transparan, dan jaminan keamanan dokumen.',
            'button_text' => 'Lihat Katalog',
            'button_link' => '#katalog',
            'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=1600&auto=format&fit=crop',
            'is_active' => true,
            'order' => 1
        ]);
        Slider::create([
            'title' => 'DP Ringan Angsuran Murah',
            'badge_text' => 'Promo Spesial',
            'subtitle' => 'Kami tawarkan solusi kredit fleksibel yang menyesuaikan dengan budget Anda. Proses cepat dan dibantu sampai approved.',
            'button_text' => 'Hitung Simulasi',
            'button_link' => '#katalog',
            'image' => 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=1600&auto=format&fit=crop',
            'is_active' => true,
            'order' => 2
        ]);

        // 3. Seed Layanans
        Layanan::truncate();
        Layanan::create([
            'title' => 'Jaminan Kualitas',
            'icon_class' => 'fas fa-check-circle',
            'description' => 'Setiap unit melewati inspeksi 100+ titik. Garansi mesin dan transmisi untuk ketenangan pikiran Anda.',
            'order' => 1
        ]);
        Layanan::create([
            'title' => 'Tukar Tambah',
            'icon_class' => 'fas fa-exchange-alt',
            'description' => 'Terima mobil lama Anda dengan harga kompetitif. Proses taksir cepat, transparan, dan langsung deal.',
            'order' => 2
        ]);
        Layanan::create([
            'title' => 'Kredit Fleksibel',
            'icon_class' => 'fas fa-wallet',
            'description' => 'Bekerjasama dengan leasing terkemuka. DP rendah, bunga ringan, dan tenor hingga 5 tahun.',
            'order' => 3
        ]);

        // 4. Seed Testimonial
        Testimonial::truncate();
        Testimonial::create([
            'name' => 'Budi Santoso',
            'role' => 'Customer',
            'rating' => 5,
            'content' => 'Unitnya benar-benar berkualitas. Mesin halus, bodi mulus. Proses kredit sangat dibantu.',
            'order' => 1
        ]);
        Testimonial::create([
            'name' => 'Siti Rahma',
            'role' => 'Customer',
            'rating' => 5,
            'content' => 'Pelayanan ramah dan profesional. Harga masih bisa nego. Recommended!',
            'order' => 2
        ]);
        Testimonial::create([
            'name' => 'Ahmad Fauzi',
            'role' => 'Customer',
            'rating' => 5,
            'content' => 'Tukar tambah dihargai tinggi. Proses cepat ga ribet. Puas banget!',
            'order' => 3
        ]);

    }
}
