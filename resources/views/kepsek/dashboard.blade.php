@extends('kepsek.layouts.app')

@section('title', 'Dashboard Supervisi Kepala Sekolah')

@section('content')
<div class="space-y-8">
    <!-- Header Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-green-900 text-white rounded-3xl p-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-yellow-400/10 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3.5 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                    Supervisi Pendidikan & Eksekutif KBM
                </span>
                <h1 class="text-2xl md:text-3xl font-extrabold mt-3">
                    Selamat Datang, {{ Auth::user()->name }}
                </h1>
                <p class="text-slate-300 text-sm mt-1 max-w-2xl leading-relaxed">
                    Portal eksekutif Kepala Sekolah Pondok Pesantren Al-Fattah untuk memantau capaian penerimaan santri baru, aktivitas dewan guru, serta mutu akademik dan kedisiplinan santri.
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('kepsek.laporan.exportExcel') }}" class="px-4 py-2.5 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold rounded-xl shadow-md transition flex items-center gap-1.5 text-xs">
                    <span class="iconify text-base" data-icon="mdi:file-excel"></span>
                    Export Excel
                </a>
                <a href="{{ route('kepsek.laporan.exportPdf') }}" target="_blank" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold rounded-xl shadow-md transition flex items-center gap-1.5 text-xs">
                    <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                    Export PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Cards Stats Ringkasan PPDB & Kesiswaan -->
    <div>
        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3 px-1">
            Indikator Penerimaan Santri Baru (PPDB Online)
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Pendaftar -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:account-group"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Masuk</span>
                </div>
                <h3 class="text-2xl font-black text-gray-800">{{ $totalPendaftar }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Calon pendaftar online</p>
            </div>

            <!-- Diterima / Lulus -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:check-circle-outline"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Lulus Dokumen</span>
                </div>
                <h3 class="text-2xl font-black text-green-700">{{ $pendaftarLulus }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Berkas terverifikasi</p>
            </div>

            <!-- Dalam Proses -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-yellow-100 text-yellow-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:clock-outline"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Proses Verifikasi</span>
                </div>
                <h3 class="text-2xl font-black text-yellow-600">{{ $pendaftarProses }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Menunggu pemeriksaan</p>
            </div>

            <!-- Lunas Midtrans -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:credit-card-check"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Lunas Biaya PSB</span>
                </div>
                <h3 class="text-2xl font-black text-emerald-700">{{ $pendaftarLunas }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Sudah settlement</p>
            </div>
        </div>
    </div>

    <!-- Cards Stats Akademik & Mutu Pembelajaran -->
    <div>
        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3 px-1">
            Indikator Akademik & Tenaga Pendidik
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Santri Aktif -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:account-school"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Santri Aktif</span>
                </div>
                <h3 class="text-2xl font-black text-purple-700">{{ $totalSantri }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Belajar di pesantren</p>
            </div>

            <!-- Dewan Guru -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:teach"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Dewan Guru</span>
                </div>
                <h3 class="text-2xl font-black text-pink-700">{{ $totalGuru }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Ustadz & Ustadzah</p>
            </div>

            <!-- Rata-rata Nilai -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:certificate"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Rata-rata Nilai</span>
                </div>
                <h3 class="text-2xl font-black text-indigo-700">{{ $rataRataNilai }}</h3>
                <p class="text-xs text-gray-500 mt-0.5">Standar mutu KBM</p>
            </div>

            <!-- Persentase Kehadiran -->
            <div class="bg-white rounded-2xl p-5 shadow-xs border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center">
                        <span class="iconify text-xl" data-icon="mdi:calendar-check"></span>
                    </div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tingkat Kehadiran</span>
                </div>
                <h3 class="text-2xl font-black text-teal-700">{{ $persentaseKehadiran }}%</h3>
                <p class="text-xs text-gray-500 mt-0.5">Kedisiplinan harian</p>
            </div>
        </div>
    </div>

    <!-- Tabel 2 Kolom: Pendaftar Terkini & Santri Terkini -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pendaftar Baru -->
        <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm space-y-4">
            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                <h4 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <span class="iconify text-emerald-600 text-lg" data-icon="mdi:account-plus"></span>
                    <span>Pendaftar Masuk Terkini</span>
                </h4>
                <a href="{{ route('kepsek.laporan.pendaftar') }}" class="text-xs text-emerald-700 font-bold hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-400 font-bold uppercase border-b border-gray-100">
                            <th class="pb-2">Nama</th>
                            <th class="pb-2">Jenjang</th>
                            <th class="pb-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pendaftarTerbaru as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2.5 font-semibold text-gray-800">{{ $p->nama }}</td>
                            <td class="py-2.5 text-gray-500">{{ $p->jenjang ?? 'Pesantren' }}</td>
                            <td class="py-2.5 text-center">
                                @if(in_array($p->status, ['Terverifikasi', 'lulus']))
                                    <span class="px-2 py-0.5 bg-green-100 text-green-700 font-bold rounded-full text-[10px]">Lulus</span>
                                @elseif(in_array($p->status, ['Ditolak', 'gagal']))
                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 font-bold rounded-full text-[10px]">Gagal</span>
                                @else
                                    <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 font-bold rounded-full text-[10px]">Proses</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-400 italic">Belum ada pendaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Santri Aktif Terkini -->
        <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm space-y-4">
            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                <h4 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <span class="iconify text-blue-600 text-lg" data-icon="mdi:school"></span>
                    <span>Santri Aktif Terdaftar</span>
                </h4>
                <a href="{{ route('kepsek.laporan.santri') }}" class="text-xs text-blue-700 font-bold hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-gray-400 font-bold uppercase border-b border-gray-100">
                            <th class="pb-2">Nama Santri</th>
                            <th class="pb-2">Kelas</th>
                            <th class="pb-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($santriTerbaru as $s)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2.5 font-semibold text-gray-800">{{ $s->nama_lengkap }}</td>
                            <td class="py-2.5 text-gray-500">{{ $s->kelas?->nama_kelas ?? 'Kelas I' }}</td>
                            <td class="py-2.5 text-center">
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-700 font-bold rounded-full text-[10px]">
                                    {{ $s->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-400 italic">Belum ada santri aktif.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
