@extends('layouts.user')

@section('title', 'Dashboard Santri Aktif')

@section('content')
<div class="space-y-6">

    <!-- Header Welcome Hero Card -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white rounded-3xl p-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                        Santri Aktif Terdaftar • TA 2026/2027
                    </span>
                    <span class="px-3 py-1 bg-emerald-500/30 text-emerald-200 border border-emerald-400/30 rounded-full text-xs font-semibold">
                        Status Berkas: Terverifikasi Sah ✓
                    </span>
                </div>
                <h1 class="text-3xl font-extrabold mt-3">
                    Assalamu'alaikum, {{ $santri->nama_lengkap ?? Auth::user()->name }} 👋
                </h1>
                <p class="text-emerald-100 text-sm mt-1 max-w-2xl">
                    Selamat datang di Portal Akademik Santri Pondok Pesantren Al-Fattah Tigaraksa. Berkas pendaftaran Anda telah tervalidasi dan Anda resmi menjadi santri aktif.
                </p>
            </div>
            
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('user.jadwal') }}" class="px-5 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold rounded-2xl shadow-lg transition flex items-center gap-2 text-xs">
                    <span class="iconify text-base" data-icon="mdi:calendar-clock"></span>
                    <span>Lihat Jadwal Pelajaran</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Kartu Metrik Ringkasan Akademik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- 1. Kelas & Rombel -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kelas / Rombel</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="mdi:google-classroom"></span>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-gray-800">
                {{ $kelas ? 'Kelas ' . $kelas->nama_kelas : 'Kelas 7A' }}
            </div>
            <p class="text-xs text-gray-500 mt-1">
                Wali Kelas: <span class="font-semibold text-emerald-700">{{ $kelas->wali_kelas ?? 'Ustadz Ahmad Fauzi, S.Pd.I' }}</span>
            </p>
        </div>

        <!-- 2. NISN & Jenjang -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nomor Induk / NISN</span>
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="mdi:card-account-details-outline"></span>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-gray-800 font-mono">
                {{ $santri->nisn ?? $pendaftar->nisn ?? '21201' }}
            </div>
            <p class="text-xs text-gray-500 mt-1">
                Jenjang: <span class="font-semibold text-blue-700">{{ $pendaftar->jenjang ?? 'SMP Al-Fattah' }}</span>
            </p>
        </div>

        <!-- 3. Rata-Rata Nilai Akademik -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rata-Rata Nilai</span>
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="mdi:chart-line"></span>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-gray-800">
                {{ $rataRataNilai > 0 ? $rataRataNilai : '85.0' }}
            </div>
            <p class="text-xs text-emerald-600 font-bold mt-1 flex items-center gap-1">
                <span class="iconify" data-icon="mdi:check-circle"></span>
                <span>Predikat A (Sangat Baik)</span>
            </p>
        </div>

        <!-- 4. Status Administrasi & Pembayaran -->
        <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Pembayaran</span>
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="mdi:cash-check"></span>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-emerald-600">
                Lunas
            </div>
            <p class="text-xs text-gray-500 mt-1">
                Biaya PSB: <span class="font-bold text-gray-700">Rp 200.000</span> (Settlement)
            </p>
        </div>
    </div>

    <!-- 4 Menu Fitur Utama Santri (Jadwal, Nilai, Pembayaran, Biodata) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Fitur 1: Jadwal Pelajaran -->
        <a href="{{ route('user.jadwal') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md hover:border-emerald-300 transition flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:calendar-clock"></span>
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-1">Jadwal & Kelas</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Jadwal pelajaran mingguan, ruang kelas, dan daftar ustadz/ustadzah pengampu mapel.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-bold text-emerald-700">
                <span>Buka Jadwal</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>

        <!-- Fitur 2: Nilai & Rapor -->
        <a href="{{ route('user.nilai') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md hover:border-amber-300 transition flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:certificate"></span>
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-1">Nilai & Rapor</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Rekapitulasi perolehan nilai Tugas, UTS, UAS, Nilai Akhir, dan predikat kelulusan KKM.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-bold text-amber-700">
                <span>Lihat Nilai</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>

        <!-- Fitur 3: Status Pembayaran -->
        <a href="{{ route('user.pembayaran') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-300 transition flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:credit-card-check-outline"></span>
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-1">Informasi Pembayaran</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Bukti transaksi Midtrans, rincian biaya pendaftaran lunas, serta administrasi SPP pesantren.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-bold text-blue-700">
                <span>Rincian Pembayaran</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>

        <!-- Fitur 4: Biodata & Dokumen -->
        <a href="{{ route('user.biodata') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md hover:border-indigo-300 transition flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:card-account-details-outline"></span>
                </div>
                <h3 class="text-base font-bold text-gray-900 mb-1">Biodata & Berkas</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Data lengkap santri, data orang tua, sekolah asal, dan pratinjau dokumen yang sudah terverifikasi.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-bold text-indigo-700">
                <span>Cek Biodata</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>

    </div>

    <!-- Ringkasan Mata Pelajaran & Jadwal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Mata Pelajaran Semester Ini -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-gray-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="iconify text-xl text-emerald-600" data-icon="mdi:book-open-page-variant"></span>
                    <h3 class="font-bold text-gray-800 text-sm">Mata Pelajaran Kelas {{ $kelas->nama_kelas ?? '7A' }}</h3>
                </div>
                <a href="{{ route('user.jadwal') }}" class="text-xs text-emerald-700 font-bold hover:underline">
                    Jadwal Lengkap →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($mapelList as $mapel)
                <div class="p-3.5 rounded-xl border border-gray-100 bg-gray-50 flex items-center justify-between hover:bg-emerald-50/50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center font-mono">
                            {{ $mapel->kode_mapel }}
                        </div>
                        <div>
                            <div class="font-bold text-xs text-gray-800">{{ $mapel->nama_mapel }}</div>
                            <div class="text-[10px] text-gray-400">Standar KKM: {{ $mapel->kkm }}</div>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded">
                        Aktif
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Kolom Kanan: Kartu Santri & Pengumuman -->
        <div class="space-y-6">
            <!-- Kartu Bukti Tanda Santri -->
            <div class="bg-gradient-to-br from-emerald-700 to-green-800 text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-200">
                        Kartu Tanda Santri (KTS)
                    </span>
                    <span class="iconify text-2xl text-yellow-300" data-icon="mdi:school"></span>
                </div>
                <h4 class="text-lg font-extrabold">{{ $santri->nama_lengkap ?? Auth::user()->name }}</h4>
                <p class="font-mono text-xs text-emerald-100 mt-0.5">NISN: {{ $santri->nisn ?? $pendaftar->nisn ?? '21201' }}</p>
                <div class="mt-4 pt-3 border-t border-emerald-600/50 flex items-center justify-between text-xs">
                    <span class="text-emerald-200">Kelas {{ $kelas->nama_kelas ?? '7A' }}</span>
                    <a href="{{ route('user.bukti') }}" class="px-3 py-1.5 bg-white text-emerald-800 rounded-lg font-bold hover:bg-emerald-50 transition shadow-sm flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:printer"></span> Cetak KTS
                    </a>
                </div>
            </div>

            <!-- Pengumuman Pesantren -->
            <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-sm space-y-3">
                <h4 class="font-bold text-gray-800 text-xs uppercase tracking-wider flex items-center gap-1.5 text-yellow-600">
                    <span class="iconify text-base" data-icon="mdi:bullhorn-outline"></span>
                    Informasi Penting Santri Baru
                </h4>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-900 space-y-1">
                    <p class="font-bold">Kedatangan & Seragam Santri</p>
                    <p class="text-[11px] text-amber-800">
                        Santri baru diharapkan hadir di asrama pada tanggal 10 Juli 2026 pukul 08.00 WIB dengan membawa Kartu Bukti Tanda Santri.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
