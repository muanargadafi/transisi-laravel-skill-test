# Transisi Laravel Skill Test

Aplikasi menggunakan FW Laravel untuk mengelola data companies beserta data employees.

## Prasyarat (Prerequisites)

Sebelum memulai proses instalasi, pastikan mesin lokal Anda sudah terinstal perkakas berikut:

- **PHP** (Minimal versi 8.2 / sesuai dengan versi Laravel yang digunakan)
- **Composer**
- **Database Engine** (MySQL / PostgreSQL / SQLite)
- **Node.js & NPM** (Untuk kompilasi aset frontend)

---

## Langkah Penginstalan di Lokal (Local Installation)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Clone Repositori

Pertama, salin proyek ini dari repositori ke direktori lokal Anda:

```bash
git clone [https://github.com/muanargadafi/transisi-laravel-skill-test.git](https://github.com/muanargadafi/transisi-laravel-skill-test.git)
cd transisi-laravel-skill-test
```

### 2. Clone Repositori

Jalankan Composer untuk menginstal semua package PHP yang dibutuhkan oleh Laravel:

```bash
composer install
```

### 3. Instal Dependensi Frontend

Instal package JavaScript yang diperlukan dan kompilasi asetnya:

```bash
npm install
npm run dev
```

### 4. Salin File Konfigurasi Lingkungan (.env)

Salin file .env.example menjadi .env untuk mengatur konfigurasi lokal Anda:

```bash
cp .env.example .env
```

### 5. Generate Application Key

Buat secure key baru untuk aplikasi Anda:

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file .env yang baru saja dibuat, lalu sesuaikan bagian konfigurasi database dengan environment lokal Anda:
Cuplikan kode

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migrasi & Seeder

Jalankan migrasi untuk membuat struktur tabel database beserta data awal (jika ada):

```bash
php artisan migrate --seed
```

### 8. Jalankan Storage Link (Opsional)

Jika proyek Anda menggunakan fitur unggah file ke direktori publik, jalankan perintah ini:

```bash
php artisan storage:link
```

### 9. Menjalankan Aplikasi

Setelah semua langkah di atas selesai, Anda bisa menjalankan server lokal Laravel dengan perintah:

```bash
php artisan serve
```
