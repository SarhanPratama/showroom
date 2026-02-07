# Panduan Menjalankan Project Laravel (Showroom)
Berikut adalah panduan langkah demi langkah untuk menjalankan project ini di komputermu.

## 1. Persiapan (Prerequisites)
Pastikan kamu sudah menginstall aplikasi berikut. Jika belum, silakan download dan install terlebih dahulu:

1.  **XAMPP** (atau Laragon): Untuk database MySQL dan PHP.
    *   Download: [apachefriends.org](https://www.apachefriends.org/download.html)
    *   *Pastikan PHP yang terinstall versi 8.2 atau lebih baru.*
2.  **Composer**: Untuk menginstall library PHP (Laravel).
    *   Download: [getcomposer.org](https://getcomposer.org/download/)
3.  **Node.js**: Untuk mengurus tampilan (frontend/CSS).
    *   Download: [nodejs.org](https://nodejs.org/en) (Pilih versi LTS)

## 2. Persiapan Database
1.  Buka aplikasi **XAMPP Control Panel**.
2.  Klik **Start** pada module **Apache** dan **MySQL**.
3.  Buka browser dan akses: `http://localhost/phpmyadmin`
4.  Buat database baru dengan nama: `showroom`
    *   Klik menu **New** di sidebar kiri.
    *   Isi nama database: `showroom`
    *   Klik **Create**.

## 3. Instalasi Project
Buka terminal (Command Prompt, PowerShell, atau Git Bash) di dalam folder project ini, lalu ikuti langkah berikut:

### Langkah Otomatis (Rekomendasi)
Project ini memiliki script otomatis untuk instalasi. Cukup jalankan perintah ini di terminal:

```bash
composer run setup
```

Perintah ini akan otomatis:
*   Menginstall dependencies PHP (`composer install`)
*   Membuat file `.env` dari `.env.example`
*   Menghasilkan App Key (`key:generate`)
*   Membuat tabel di database (`migrate`)
*   Menginstall dependencies JavaScript (`npm install`)
*   Membuild aset frontend (`npm run build`)

---

### Langkah Manual (Jika langkah otomatis gagal)
Jika perintah di atas error, kamu bisa menjalankannya satu per satu:

1.  **Install PHP Library:**
    ```bash
    composer install
    ```
2.  **Duplikat file konfigurasi:**
    Copy file `.env.example` lalu ubah namanya menjadi `.env`.
3.  **Generate Key:**
    ```bash
    php artisan key:generate
    ```
4.  **Setting Database:**
    Buka file `.env` dengan text editor (Notepad/VS Code), pastikan bagian ini sesuai (biasanya sudah default):
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=showroom
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5.  **Migrasi Database:**
    ```bash
    php artisan migrate
    ```
6.  **Install & Build Frontend:**
    ```bash
    npm install
    npm run build
    ```

## 4. Menjalankan Aplikasi
Setelah instalasi selesai, kamu perlu membuka **dua terminal** terpisah agar aplikasi berjalan lancar.

**Terminal 1 (Menjalankan Server Laravel):**
```bash
php artisan serve
```
*Akan muncul pesan: Server running on [http://127.0.0.1:8000](http://127.0.0.1:8000)*

**Terminal 2 (Menjalankan Vite untuk reload otomatis):**
```bash
npm run dev
```

Sekarang, buka browser dan akses alamat yang muncul di Terminal 1 (biasanya `http://127.0.0.1:8000` atau `http://localhost:8000`).

Selamat! Project Laravel-mu sudah berjalan. 🚀
