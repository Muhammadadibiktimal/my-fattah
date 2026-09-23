# 🏫 Sistem Informasi Penerimaan Santri Baru (PSB) & Profil Web - Pondok Pesantren Al-Fattah

Sistem Informasi Penerimaan Santri Baru (PSB) berbasis web untuk **Pondok Pesantren Al-Fattah Tigaraksa, Kabupaten Tangerang**. Aplikasi ini dikembangkan menggunakan **Laravel 12**, **Tailwind CSS**, dan database **SQLite / MySQL** dengan arsitektur **Multi-Role Access Control (RBAC)** serta modul pelaporan eksekutif.

---

## 🌟 Fitur Utama & Multi-Role Access Control

Sistem ini memiliki 3 level hak akses pengguna dengan antarmuka (UI/UX) dan fitur yang disesuaikan:

### 1. 🧑‍🎓 Portal Calon Santri / Pendaftar
* **Pendaftaran Akun Santri Baru**: Calon santri membuat akun terlebih dahulu sebelum melengkapi biodata.
* **Formulir Biodata Interaktif**: Pengisian data diri, NIK, tempat/tanggal lahir, biodata orang tua, serta upload berkas dokumen (**Kartu Keluarga, Akta Kelahiran, Ijazah**).
* **Tracking Status Seleksi Real-time**: Memantau status verifikasi dokumen (*Pending / Dalam Proses*, *Terverifikasi / Lulus*, atau *Ditolak*).
* **Cetak Kartu Bukti Pendaftaran (PDF)**: Mengunduh Kartu Bukti Pendaftaran resmi berformat PDF untuk dibawa saat tes masuk.

### 2. 👑 Portal Administrator (Validator & Content Manager)
* **Verifikasi & Validasi Dokumen**: Pratinjau (*preview*) dokumen KK, Akta, dan Ijazah calon santri via modal interaktif, lalu melakukan verifikasi (`Approve`) atau penolakan (`Reject`).
* **Kelola Data Pendaftar & Arsip**: Pencarian, penyaringan (*filtering*), pengeditan, serta pengarsipan data pendaftar.
* **Kelola Content Management System (CMS)**:
  * Hero Banner Carousel Landing Page
  * Berita & Pengumuman
  * Video Kegiatan Youtube
  * Testimoni Alumni
* **Manajemen Pengguna (User Management)**: Pengelolaan seluruh akun terdaftar dan pembagian role.

### 3. 🎓 Portal Eksekutif Kepala Sekolah
* **Dashboard Laporan Real-time**: Ringkasan statistik jumlah pendaftar masuk, diterima/lulus, dalam proses, dan tidak lulus.
* **Export Laporan Eksekutif (Excel & PDF)**: Mengunduh rekapitulasi data pendaftaran santri baru secara otomatis.

---

## 🛠️ Tech Stack & Dependencies

* **Backend Framework**: Laravel 12.x (PHP 8.2+)
* **Frontend UI**: Blade Templating, Tailwind CSS, Alpine.js, Bootstrap 5, Iconify, Lucide Icons
* **Database**: SQLite (Default Quick Setup) / MySQL / MariaDB
* **PDF Generator**: `barryvdh/laravel-dompdf`
* **Excel Export**: `maatwebsite/excel`
* **Development Server**: Laragon / XAMPP & Vite

---

## 🚀 Langkah Instalasi & Cara Menjalankan Project

### 1. Prasyarat Sistem
* PHP >= 8.2 (dengan extension `sqlite3`, `pdo_sqlite`, `gd`, `zip`, dan `pdo_mysql` aktif)
* Composer >= 2.x
* Node.js >= 18.x & npm
* Web server lokal (misalnya **Laragon** atau **XAMPP**)

### 2. Pindah ke Folder Project & Install Dependencies
Jika baru mengekstrak folder project, buka terminal PowerShell dan masuk ke direktori:
```bash
cd "D:\Kuliah\Semester 8\ProjectWork\my-fattah-main"
```

Jika vendor/node_modules belum di-install:
```bash
composer install
npm install
```

### 3. Konfigurasi Environment & Key
File `.env` sudah dikonfigurasi menggunakan database SQLite (`database/database.sqlite`).
Jika file `.env` belum ada:
```bash
copy .env.example .env
php artisan key:generate
```

### 4. Migration & Seeder Database
Jalankan migrasi tabel beserta data dummy default:
```bash
# Menggunakan PATH PHP Laragon (jika PHP belum masuk ke Global Environment Path):
$env:Path += ";C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64"; php artisan migrate:fresh --seed

# Atau jika PHP sudah terdaftar secara global:
php artisan migrate:fresh --seed
```

### 5. Storage Link Asset
Hubungkan folder penyimpanan publik agar berkas/foto pendaftar dapat diakses:
```bash
$env:Path += ";C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64"; php artisan storage:link
```

### 6. Menjalankan Server Development

Buka **2 Terminal PowerShell**:

**Terminal 1 (Laravel Server):**
```bash
$env:Path += ";C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64"; php artisan serve
```

**Terminal 2 (Vite Server):**
```bash
npm run dev
```

Buka browser di: **`http://127.0.0.1:8000`**

---

## 🔑 Akun Demo Default (Database Seeder)

Anda dapat langsung mencoba login menggunakan akun default berikut di halaman **`/login`**:

| Role | Email | Password | Hak Akses Dashboard |
|---|---|---|---|
| 👑 **Administrator** | `admin@gmail.com` | `password` | `/admin/dashboard` |
| 🎓 **Kepala Sekolah** | `kepsek@gmail.com` | `password` | `/kepsek/dashboard` |
| 🧑‍คับ **Calon Santri** | `pendaftar@gmail.com` | `password` | `/user/dashboard` |

---

## 🌐 Cara Hosting Gratis untuk Demo Pihak Yayasan

Agar pihak yayasan sekolah dapat melihat dan mencoba sistem ini secara online tanpa biaya, berikut 2 opsi paling direkomendasikan:

### Opsi A: Menggunakan Ngrok (Paling Cepat & Instan tanpa Setup Server)
Opsi ini mempublikasikan localhost komputer Anda ke internet secara temporer saat Anda presentasi.
1. Download **[Ngrok](https://ngrok.com/)**.
2. Jalankan server Laravel Anda (`php artisan serve` di port `8000`).
3. Di terminal baru, jalankan:
   ```bash
   ngrok http 8000
   ```
4. Ngrok akan memberikan URL publik (contoh: `https://abcd-123.ngrok-free.app`). Bagikan URL tersebut ke pihak yayasan!

### Opsi B: Cloud Hosting Gratis via Render.com / Railway.app
1. Push folder project ini ke **GitHub** repository Anda.
2. Buat akun di **[Render.com](https://render.com/)** atau **[Railway.app](https://railway.app/)**.
3. Hubungkan repository GitHub Anda.
4. Set Environment Variables di dashboard hosting (`APP_KEY`, `DB_CONNECTION=sqlite`, dll).
5. Aplikasi akan otomatis ter-deploy dan dapat diakses 24/7 secara gratis.

---

## 📄 Lisensi & Peruntukan
Project ini dikembangkan untuk kepentingan akademik **Skripsi / Tugas Akhir Sarjana Komputer (S.Kom)** di Pondok Pesantren Al-Fattah Tigaraksa, Kabupaten Tangerang.
