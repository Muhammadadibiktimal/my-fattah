@extends('yayasan.layouts.app')

@section('title', 'Dashboard Eksekutif Ketua Yayasan')

@section('content')
<div class="space-y-8">

    <!-- Executive Hero Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-emerald-950 to-slate-900 text-white p-8 rounded-3xl shadow-xl relative overflow-hidden border border-emerald-900/50">
        <div class="absolute -right-10 -bottom-10 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-40 -top-10 w-64 h-64 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div>
                <div class="flex items-center gap-2 flex-wrap mb-3">
                    <span class="px-3 py-1 bg-amber-400 text-slate-950 rounded-full text-xs font-black uppercase tracking-wider shadow">
                        Portal Eksekutif & Pengawasan Yayasan
                    </span>
                    <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 rounded-full text-xs font-semibold">
                        Tahun Ajaran 2026/2027
                    </span>
                </div>
                <h1 class="text-2xl sm:text-4xl font-black tracking-tight">
                    Ahlan wa Sahlan, {{ Auth::user()->name }}
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm mt-2 max-w-2xl leading-relaxed">
                    Pusat pemantauan seluruh divisi operasional Pondok Pesantren Al-Fattah. Seluruh laporan penerimaan santri, keuangan Midtrans, perkembangan akademik, dan kedisiplinan santri terpusat di sini.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2 flex-shrink-0 bg-slate-800/80 backdrop-blur-md p-3 rounded-2xl border border-slate-700">
                <a href="{{ route('yayasan.laporan.keuangan') }}" class="px-4 py-2.5 bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                    <span class="iconify text-base" data-icon="mdi:cash-fast"></span>
                    <span>Laporan Keuangan</span>
                </a>
                <a href="{{ route('yayasan.laporan.pendaftar') }}" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                    <span class="iconify text-base" data-icon="mdi:account-school"></span>
                    <span>Laporan PPDB</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 6 KPI METRICS UTAMA YAYASAN -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- 1. Santri Aktif & Rombel -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Santri Aktif Terdaftar</span>
                <div class="w-11 h-11 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:account-group"></span>
                </div>
            </div>
            <div class="text-3xl font-black text-gray-900 font-mono">
                {{ $totalSantri }} <span class="text-xs font-bold text-emerald-600">Santri</span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>SMP: <strong>{{ $santriSMP }}</strong></span>
                <span>SMA: <strong>{{ $santriSMA }}</strong></span>
                <span>SMK: <strong>{{ $santriSMK }}</strong></span>
            </div>
        </div>

        <!-- 2. Pendaftar PPDB Online -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Pendaftar Santri Baru (PSB)</span>
                <div class="w-11 h-11 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:card-account-details-outline"></span>
                </div>
            </div>
            <div class="text-3xl font-black text-gray-900 font-mono">
                {{ $totalPendaftar }} <span class="text-xs font-bold text-blue-600">Pendaftar</span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span class="text-emerald-700 font-bold">Lunas: {{ $totalPendaftarLunas }}</span>
                <span class="text-blue-700 font-bold">Terverifikasi: {{ $totalPendaftarTerverifikasi }}</span>
            </div>
        </div>

        <!-- 3. Pemasukan Keuangan Midtrans -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Total Pemasukan PSB</span>
                <div class="w-11 h-11 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:cash-check"></span>
                </div>
            </div>
            <div class="text-3xl font-black text-emerald-600 font-mono">
                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Midtrans Gateway Lunas</span>
                <span class="text-[11px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded">100% Sah</span>
            </div>
        </div>

        <!-- 4. Tenaga Pendidik & Rombel -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Dewan Guru & Kelas</span>
                <div class="w-11 h-11 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:teach"></span>
                </div>
            </div>
            <div class="text-3xl font-black text-gray-900 font-mono">
                {{ $totalGuru }} <span class="text-xs font-bold text-purple-600">Guru</span> / {{ $totalKelas }} <span class="text-xs font-bold text-gray-500">Rombel</span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span>Guru & Ustadz Pengampu</span>
                <span class="font-bold text-gray-700">{{ $totalKelas }} Ruang Kelas</span>
            </div>
        </div>

        <!-- 5. Rata-Rata Nilai Akademik -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Mutu Nilai Akademik</span>
                <div class="w-11 h-11 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:chart-timeline-variant-shimmer"></span>
                </div>
            </div>
            <div class="text-3xl font-black text-gray-900 font-mono">
                {{ $rataRataNilai }} <span class="text-xs font-bold text-teal-600">/ 100</span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span class="text-teal-700 font-bold">Rata-rata Gabungan Mapel</span>
                <span class="px-2 py-0.5 bg-teal-100 text-teal-800 rounded font-bold text-[10px]">Predikat A</span>
            </div>
        </div>

        <!-- 6. Persentase Kehadiran Santri -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition relative overflow-hidden group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-extrabold text-gray-400 uppercase tracking-wider">Tingkat Kehadiran KBM</span>
                <div class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:calendar-check-outline"></span>
                </div>
            </div>
            <div class="text-3xl font-black text-indigo-700 font-mono">
                {{ $persentaseKehadiran }}%
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <span class="text-emerald-600 font-bold">Disiplin Sangat Baik</span>
                <span class="text-[10px] text-gray-400">Standar Min. 80%</span>
            </div>
        </div>
    </div>

    <!-- PUSAT AKSES CEPAT 6 LAPORAN EKSEKUTIF -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-lg font-extrabold text-gray-900 flex items-center gap-2">
                    <span class="iconify text-emerald-600 text-2xl" data-icon="mdi:file-chart-outline"></span>
                    <span>Pusat Seluruh Laporan Eksekutif Yayasan</span>
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Akses cepat laporan terperinci dengan filter data dan ekspor PDF resmi.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- 1. Laporan PPDB -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-emerald-300 transition">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-3">
                        <span class="iconify text-2xl" data-icon="mdi:account-school-outline"></span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-1">1. Laporan PPDB & Calon Santri</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Data calon santri baru per jenjang SMP, SMA, SMK, jurusan, kelengkapan berkas, dan status verifikasi.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('yayasan.laporan.pendaftar') }}" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                    <a href="{{ route('yayasan.laporan.cetak', 'pendaftar') }}" class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:file-pdf-box"></span> PDF
                    </a>
                </div>
            </div>

            <!-- 2. Laporan Keuangan -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-amber-300 transition">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center mb-3">
                        <span class="iconify text-2xl" data-icon="mdi:cash-multiple"></span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-1">2. Laporan Keuangan Midtrans</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Rekapitulasi pembayaran biaya formulir PSB online, order ID Midtrans, waktu bayar, dan total dana masuk.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('yayasan.laporan.keuangan') }}" class="text-xs font-bold text-amber-700 hover:underline flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                    <a href="{{ route('yayasan.laporan.cetak', 'keuangan') }}" class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:file-pdf-box"></span> PDF
                    </a>
                </div>
            </div>

            <!-- 3. Laporan Santri & Kenaikan -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-blue-300 transition">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center mb-3">
                        <span class="iconify text-2xl" data-icon="mdi:account-group"></span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-1">3. Laporan Santri & Kenaikan Kelas</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Data santri aktif di 18 rombel kelas, keputusan pleno kenaikan kelas (Naik, Tinggal, Lulus), dan catatan.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('yayasan.laporan.santri') }}" class="text-xs font-bold text-blue-700 hover:underline flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                    <a href="{{ route('yayasan.laporan.cetak', 'santri') }}" class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:file-pdf-box"></span> PDF
                    </a>
                </div>
            </div>

            <!-- 4. Laporan Nilai Akademik -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-purple-300 transition">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center mb-3">
                        <span class="iconify text-2xl" data-icon="mdi:certificate"></span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-1">4. Laporan Akademik & Rapor</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Rekapitulasi perolehan nilai Tugas, UTS, UAS, Nilai Akhir, predikat, dan ketuntasan KKM per mapel.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('yayasan.laporan.nilai') }}" class="text-xs font-bold text-purple-700 hover:underline flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                    <a href="{{ route('yayasan.laporan.cetak', 'nilai') }}" class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:file-pdf-box"></span> PDF
                    </a>
                </div>
            </div>

            <!-- 5. Laporan Presensi & Kehadiran -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-teal-300 transition">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center mb-3">
                        <span class="iconify text-2xl" data-icon="mdi:calendar-check-outline"></span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-1">5. Laporan Presensi & Kehadiran</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Monitoring kedisiplinan santri harian, rekapitulasi hadir, sakit, izin, alpa, dan persentase kehadiran.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('yayasan.laporan.absensi') }}" class="text-xs font-bold text-teal-700 hover:underline flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                    <a href="{{ route('yayasan.laporan.cetak', 'absensi') }}" class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:file-pdf-box"></span> PDF
                    </a>
                </div>
            </div>

            <!-- 6. Laporan Dewan Guru -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-pink-300 transition">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-pink-50 text-pink-700 flex items-center justify-center mb-3">
                        <span class="iconify text-2xl" data-icon="mdi:teach"></span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base mb-1">6. Laporan Dewan Guru & Rombel</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Data seluruh ustadz/ustadzah pengajar, penugasan wali kelas, serta rasio pembimbing santri.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('yayasan.laporan.guru') }}" class="text-xs font-bold text-pink-700 hover:underline flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                    <a href="{{ route('yayasan.laporan.cetak', 'guru') }}" class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-bold flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:file-pdf-box"></span> PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Terkini (Pendaftar & Santri) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pendaftar PSB Terbaru -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <span class="iconify text-emerald-600" data-icon="mdi:account-plus"></span>
                    <span>Pendaftar Calon Santri Terbaru</span>
                </h3>
                <a href="{{ route('yayasan.laporan.pendaftar') }}" class="text-xs font-bold text-emerald-700 hover:underline">
                    Semua →
                </a>
            </div>

            <div class="space-y-3">
                @forelse($pendaftarTerbaru as $p)
                <div class="p-3 bg-gray-50 rounded-xl flex items-center justify-between text-xs">
                    <div>
                        <div class="font-bold text-gray-900">{{ $p->nama }}</div>
                        <div class="text-[11px] text-gray-500">{{ $p->jenjang }} • {{ $p->jurusan ?? 'Reguler' }}</div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $p->status_bayar == 'settlement' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ strtoupper($p->status_bayar) }}
                        </span>
                        <span class="block text-[10px] text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</span>
                    </div>
                </div>
                @empty
                <p class="text-xs text-gray-400 italic text-center py-4">Belum ada data pendaftar.</p>
                @endforelse
            </div>
        </div>

        <!-- Santri Aktif Terbaru -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <span class="iconify text-blue-600" data-icon="mdi:school"></span>
                    <span>Santri Aktif Terdaftar</span>
                </h3>
                <a href="{{ route('yayasan.laporan.santri') }}" class="text-xs font-bold text-blue-700 hover:underline">
                    Semua →
                </a>
            </div>

            <div class="space-y-3">
                @forelse($santriTerbaru as $s)
                <div class="p-3 bg-gray-50 rounded-xl flex items-center justify-between text-xs">
                    <div>
                        <div class="font-bold text-gray-900">{{ $s->nama_lengkap }}</div>
                        <div class="text-[11px] text-gray-500">
                            {{ $s->kelas ? 'Kelas ' . $s->kelas->nama_kelas : 'Belum Ditentukan' }}
                            @if($s->jurusan) • {{ $s->jurusan }} @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                            {{ $s->status_kenaikan ?: $s->status }}
                        </span>
                        <span class="block text-[10px] text-gray-400 mt-0.5">NISN: {{ $s->nisn ?? '-' }}</span>
                    </div>
                </div>
                @empty
                <p class="text-xs text-gray-400 italic text-center py-4">Belum ada data santri.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
