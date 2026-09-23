@extends('admin.layouts.app')

@section('title', 'Dashboard Validator Administrator')

@section('content')
<div class="space-y-8">
    <!-- Header Welcome Card -->
    <div class="bg-gradient-to-r from-green-800 via-emerald-700 to-green-900 text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                    Portal Kontrol & Validasi Administrator
                </span>
                <h1 class="text-2xl font-extrabold mt-2">
                    Selamat Datang, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-green-100 text-xs mt-1">
                    Tugas Utama Admin: Memvalidasi dokumen (KK, Akta, Ijazah) calon santri dan mengelola konten publik Al-Fattah.
                </p>
            </div>
            
            <a href="{{ route('admin.pendaftar.verifikasi') }}" class="px-5 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold rounded-xl shadow-lg transition text-xs flex items-center gap-2">
                <span class="iconify text-lg" data-icon="mdi:check-decagram-outline"></span>
                Buka Antrean Verifikasi Dokumen
            </a>
        </div>
    </div>

    <!-- Highlight Callout: Tugas Validasi Dokumen -->
    <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-2xl flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center flex-shrink-0">
                <span class="iconify text-2xl" data-icon="mdi:file-certificate-outline"></span>
            </div>
            <div>
                <h3 class="font-bold text-blue-900 text-base">Validasi Dokumen Santri Baru</h3>
                <p class="text-xs text-blue-700 mt-1">
                    Periksa pratinjau berkas yang diupload oleh calon santri (Kartu Keluarga, Akta Kelahiran, dan Ijazah). Berikan keputusan **"Verifikasi"** jika sah atau **"Tolak"** jika dokumen buram/salah.
                </p>
            </div>
        </div>
        <a href="{{ route('admin.pendaftar.verifikasi') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow transition flex-shrink-0">
            Validasi Sekarang
        </a>
    </div>

    <!-- Stats Cards Grid (6 Ringkasan Stats) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Pendaftar -->
        <a href="{{ route('admin.pendaftar.index') }}" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between group">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Data Masuk</span>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalPendaftar }}</h3>
                <p class="text-xs text-blue-600 font-semibold mt-1 group-hover:underline">Semua Pendaftar →</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition">
                <span class="iconify text-3xl" data-icon="mdi:clipboard-account-outline"></span>
            </div>
        </a>

        <!-- Berita Artikel -->
        <a href="{{ route('admin.posts.index') }}" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between group">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Berita & Artikel</span>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalBerita }}</h3>
                <p class="text-xs text-green-600 font-semibold mt-1 group-hover:underline">Kelola Berita →</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center group-hover:scale-110 transition">
                <span class="iconify text-3xl" data-icon="mdi:newspaper-variant-outline"></span>
            </div>
        </a>

        <!-- Hero Slider Banner -->
        <a href="{{ route('admin.heroes.index') }}" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between group">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Hero Banner Slide</span>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalHero }}</h3>
                <p class="text-xs text-yellow-600 font-semibold mt-1 group-hover:underline">Kelola Banner →</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center group-hover:scale-110 transition">
                <span class="iconify text-3xl" data-icon="mdi:image-multiple-outline"></span>
            </div>
        </a>

        <!-- Video Kegiatan -->
        <a href="{{ route('admin.videos.index') }}" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between group">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Video Youtube</span>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalVideo }}</h3>
                <p class="text-xs text-purple-600 font-semibold mt-1 group-hover:underline">Kelola Video →</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition">
                <span class="iconify text-3xl" data-icon="mdi:video-outline"></span>
            </div>
        </a>

        <!-- Testimoni Alumni -->
        <a href="{{ route('admin.alumnis.index') }}" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between group">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Testimoni Alumni</span>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalAlumni }}</h3>
                <p class="text-xs text-pink-600 font-semibold mt-1 group-hover:underline">Kelola Alumni →</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center group-hover:scale-110 transition">
                <span class="iconify text-3xl" data-icon="mdi:account-group-outline"></span>
            </div>
        </a>

        <!-- Total Akun User -->
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex items-center justify-between group">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pengguna Terdaftar</span>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalUser }}</h3>
                <p class="text-xs text-indigo-600 font-semibold mt-1 group-hover:underline">Kelola User →</p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition">
                <span class="iconify text-3xl" data-icon="mdi:account-key-outline"></span>
            </div>
        </a>
    </div>

    <!-- Tabel Pendaftar Terbaru -->
    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Pratinjau Antrean Validasi Santri</h3>
            <a href="{{ route('admin.pendaftar.verifikasi') }}" class="text-xs font-bold text-blue-600 hover:underline">Ke Halaman Verifikasi Berkas →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Santri</th>
                        <th class="py-3 px-4">NIK</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi Validasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($pendaftarTerbaru as $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 font-semibold text-gray-800">{{ $p->nama_lengkap ?? $p->nama }}</td>
                            <td class="py-3 px-4 text-gray-600 text-xs">{{ $p->nik ?? '-' }}</td>
                            <td class="py-3 px-4">
                                @if($p->status == 'Terverifikasi' || $p->status == 'lulus')
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Terverifikasi</span>
                                @elseif($p->status == 'Ditolak' || $p->status == 'gagal')
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Ditolak</span>
                                @else
                                    <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Pending / Perlu Validasi</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.pendaftar.verifikasi') }}" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-semibold inline-flex items-center gap-1 shadow-sm">
                                    <span class="iconify" data-icon="mdi:eye"></span>
                                    Cek Berkas
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-500 italic">Belum ada data pendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
