<?php

use App\Models\Hero;
use App\Models\Post;
use App\Models\Video;
use App\Models\Alumni;
use App\Models\DataPendaftar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\DataPendaftarController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\PendaftarController; // 🔹 Controller baru untuk kelola pendaftar

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Formulir Pendaftaran (untuk user umum)
Route::get('/pendaftaran', [PendaftaranController::class, 'form'])->name('pendaftaran.form');
Route::post('/pendaftaran/bayar', [PendaftaranController::class, 'bayar'])->name('pendaftaran.bayar');
Route::get('/pendaftaran/finish', [PendaftaranController::class, 'finish'])->name('pendaftaran.finish');
Route::post('/midtrans/notification', [PendaftaranController::class, 'notification'])->name('midtrans.notification');

// 🔹 Landing Page (TIDAK perlu login)
Route::get('/', function () {
    $heroes = Hero::all();
    $posts = Post::latest()->take(3)->get();
    $videos = Video::latest()->take(6)->get();
    $alumnis = Alumni::latest()->take(6)->get();
    return view('dashboard.home', compact('heroes', 'posts', 'videos', 'alumnis'));
})->name('home');

Route::get('/posts/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('admin.posts.show', compact('post'));
})->name('posts.show');

// 🔹 Halaman semua berita
Route::get('/berita', function () {
    $posts = Post::latest()->paginate(6);
    return view('posts.index', compact('posts'));
})->name('posts.index');

// 🔹 Halaman statis
Route::view('/visi-misi', 'pages.visi-misi')->name('visi-misi');
Route::view('/sejarah', 'pages.sejarah')->name('sejarah');

// 🔹 Route untuk Admin (Hanya bisa diakses oleh admin login)

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Resource utama
        Route::resource('heroes', HeroController::class);
        Route::resource('posts', PostController::class);
        Route::resource('videos', VideoController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('campaigns', CampaignController::class);
        Route::resource('alumnis', AlumniController::class);
        Route::resource('school_profiles', SchoolProfileController::class);
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | 🔹 Kelola Data Pendaftar
        |--------------------------------------------------------------------------
        */
        Route::resource('users', UserController::class)->except(['show']);

        Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/pendaftar', [DataPendaftarController::class, 'index'])->name('pendaftar.index');

        // Form tambah data
        Route::get('/pendaftar/create', [DataPendaftarController::class, 'create'])->name('pendaftar.create');
        // routes/web.php
        Route::get('/pendaftar/export', [PendaftarController::class, 'export'])->name('pendaftar.export');

        // Simpan data baru
        Route::post('/pendaftar', [DataPendaftarController::class, 'store'])->name('pendaftar.store');

        // Form edit data
        Route::get('/pendaftar/{id}/edit', [DataPendaftarController::class, 'edit'])->name('pendaftar.edit');
        Route::get('/admin/pendaftar/export', [App\Http\Controllers\Admin\PendaftarController::class, 'export'])
            ->name('admin.pendaftar.export');
        Route::get('/pendaftar/export-pdf', [PendaftarController::class, 'exportPdf'])
            ->name('pendaftar.exportPdf');
        // Update data
        Route::put('/pendaftar/{id}', [DataPendaftarController::class, 'update'])->name('pendaftar.update');

        // Hapus data
        Route::delete('/pendaftar/{id}', [DataPendaftarController::class, 'destroy'])->name('pendaftar.destroy');

        // Update status (Pending / Terverifikasi / Ditolak)
        Route::post('/pendaftar/{id}/status', [DataPendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');

        // ✅ Verifikasi Pendaftar
        Route::get('/pendaftar/verifikasi', [PendaftarController::class, 'verifikasi'])->name('pendaftar.verifikasi');

        // ✅ Arsip Pendaftar
        Route::get('/pendaftar/arsip', [PendaftarController::class, 'arsip'])->name('pendaftar.arsip');
        Route::get('/pendaftar/{id}', [PendaftarController::class, 'show'])->name('pendaftar.show');

        // ✅ Update Status Pendaftar
        Route::post('/pendaftar/{id}/update-status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');

        // 🔹 Buat Akun Santri Baru oleh Admin
        Route::post('/pendaftar/{id}/buat-akun', [PendaftarController::class, 'buatAkun'])->name('pendaftar.buatAkun');

        // 🔹 Kelola Pembayaran Midtrans
        Route::get('/transaksi', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('transaksi.index');
        Route::post('/transaksi/{id}/manual-lunas', [\App\Http\Controllers\Admin\PaymentController::class, 'manualLunas'])->name('transaksi.manualLunas');

        // 🔹 Kelola Akademik (Santri, Guru, Kelas, Mapel)
        Route::post('/santri/{id}/account', [\App\Http\Controllers\Admin\SantriController::class, 'setAccount'])->name('santri.account');
        Route::post('/santri/{id}/kenaikan-kelas', [\App\Http\Controllers\Admin\SantriController::class, 'kenaikanKelas'])->name('santri.kenaikanKelas');
        Route::resource('santri', \App\Http\Controllers\Admin\SantriController::class);
        Route::resource('guru', \App\Http\Controllers\Admin\GuruController::class);
        Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);
        Route::resource('mapel', \App\Http\Controllers\Admin\MapelController::class);
    });

// 🔹 Route untuk Guru (Hanya untuk Input Nilai, Absensi, dan Rekap Nilai)
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard');

        // 1. Input Nilai Siswa/Santri
        Route::get('/nilai', [\App\Http\Controllers\Guru\NilaiController::class, 'index'])->name('nilai.index');
        Route::post('/nilai', [\App\Http\Controllers\Guru\NilaiController::class, 'store'])->name('nilai.store');

        // 2. Input Absensi Siswa/Santri
        Route::get('/absensi', [\App\Http\Controllers\Guru\AbsensiController::class, 'index'])->name('absensi.index');
        Route::post('/absensi', [\App\Http\Controllers\Guru\AbsensiController::class, 'store'])->name('absensi.store');

        // 3. Rekap Nilai untuk Setiap Mapel dan Kelas
        Route::get('/rekap', [\App\Http\Controllers\Guru\RekapNilaiController::class, 'index'])->name('rekap.index');
        Route::get('/rekap/cetak', [\App\Http\Controllers\Guru\RekapNilaiController::class, 'cetak'])->name('rekap.cetak');
    });

// 🔹 Route untuk Ketua Yayasan (Pusat Seluruh Laporan Lembaga)
Route::middleware(['auth', 'role:yayasan'])
    ->prefix('yayasan')
    ->name('yayasan.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'index'])->name('dashboard');
        Route::get('/laporan/pendaftar', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'laporanPendaftar'])->name('laporan.pendaftar');
        Route::get('/laporan/keuangan', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'laporanKeuangan'])->name('laporan.keuangan');
        Route::get('/laporan/santri', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'laporanSantri'])->name('laporan.santri');
        Route::get('/laporan/nilai', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'laporanNilai'])->name('laporan.nilai');
        Route::get('/laporan/absensi', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'laporanAbsensi'])->name('laporan.absensi');
        Route::get('/laporan/guru', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'laporanGuru'])->name('laporan.guru');
        Route::get('/laporan/{kategori}/cetak-pdf', [\App\Http\Controllers\Yayasan\LaporanYayasanController::class, 'cetakPdf'])->name('laporan.cetak');
    });

// 🔹 Route untuk Kepala Sekolah (Lihat Laporan & Statistik)
Route::middleware(['auth', 'role:kepsek'])
    ->prefix('kepsek')
    ->name('kepsek.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Kepsek\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/laporan/export-pdf', [\App\Http\Controllers\Admin\PendaftarController::class, 'exportPdf'])->name('laporan.exportPdf');
        Route::get('/laporan/export-excel', [\App\Http\Controllers\Admin\PendaftarController::class, 'export'])->name('laporan.exportExcel');
    });

// 🔹 Route untuk Portal Santri (Dashboard, Jadwal, Nilai, Pembayaran, Biodata)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/jadwal', [\App\Http\Controllers\User\DashboardController::class, 'jadwal'])->name('user.jadwal');
    Route::get('/kehadiran', [\App\Http\Controllers\User\DashboardController::class, 'kehadiran'])->name('user.kehadiran');
    Route::get('/nilai', [\App\Http\Controllers\User\DashboardController::class, 'nilai'])->name('user.nilai');
    Route::get('/pembayaran', [\App\Http\Controllers\User\DashboardController::class, 'pembayaran'])->name('user.pembayaran');
    Route::get('/biodata', [\App\Http\Controllers\User\DashboardController::class, 'biodata'])->name('user.biodata');

    Route::get('/data', [UserDataController::class, 'data'])->name('user.data');
    Route::post('/data/store', [UserDataController::class, 'store'])->name('user.data.store');

    Route::get('/status', [UserDataController::class, 'status'])->name('user.status');

    // Bukti Pendaftaran
    Route::get('/bukti', [UserDataController::class, 'bukti'])->name('user.bukti');
    Route::get('/bukti/cetak', [UserDataController::class, 'cetakBukti'])->name('user.bukti.cetak');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 Auth routes (login, register, lupa password, dll)
require __DIR__ . '/auth.php';
