@extends('guru.layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="space-y-6">

    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-emerald-600 via-green-600 to-teal-700 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-emerald-600/10 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 max-w-2xl">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-semibold uppercase tracking-wider mb-3">
                Assalamu'alaikum Warahmatullahi Wabarakatuh
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold mb-2">
                Selamat Datang, {{ $guru->name }}!
            </h1>
            <p class="text-emerald-100 text-sm leading-relaxed">
                Portal khusus Dewan Guru Pondok Pesantren Al-Fattah untuk mengelola input nilai tugas, ujian, absensi harian santri, serta rekapitulasi nilai per mata pelajaran dan kelas.
            </p>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl">
                <span class="iconify text-3xl" data-icon="mdi:google-classroom"></span>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-gray-400">Total Kelas</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $totalKelas }}</h3>
                <span class="text-[11px] text-emerald-600 font-semibold">Rombongan Belajar</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                <span class="iconify text-3xl" data-icon="mdi:book-open-variant"></span>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-gray-400">Mata Pelajaran</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $totalMapel }}</h3>
                <span class="text-[11px] text-blue-600 font-semibold">Kurikulum Terpadu</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-purple-50 text-purple-600 rounded-2xl">
                <span class="iconify text-3xl" data-icon="mdi:account-group"></span>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-gray-400">Santri Aktif</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $totalSantri }}</h3>
                <span class="text-[11px] text-purple-600 font-semibold">Seluruh Jenjang</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                <span class="iconify text-3xl" data-icon="mdi:check-circle-outline"></span>
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-gray-400">Absensi Hari Ini</p>
                <h3 class="text-2xl font-black text-gray-800 mt-0.5">{{ $absensiHariIni }}</h3>
                <span class="text-[11px] text-amber-600 font-semibold">{{ date('d M Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Pintasan Cepat Menu Guru -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <a href="{{ route('guru.nilai.index') }}"
           class="group bg-white p-6 rounded-2xl border border-gray-200 hover:border-emerald-500 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:pencil-box-multiple-outline"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-emerald-700 transition">Input Nilai Santri</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Masukkan nilai tugas harian, UTS, dan UAS santri berdasarkan rombel kelas dan mata pelajaran.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center text-xs font-bold text-emerald-700 gap-1">
                <span>Buka Form Input Nilai</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>

        <a href="{{ route('guru.absensi.index') }}"
           class="group bg-white p-6 rounded-2xl border border-gray-200 hover:border-emerald-500 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:calendar-multiselect"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-emerald-700 transition">Input Absensi Harian</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Catat kehadiran santri (Hadir, Izin, Sakit, Alpa) dengan tombol instan "Set Semua Hadir".
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center text-xs font-bold text-emerald-700 gap-1">
                <span>Buka Form Absensi</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>

        <a href="{{ route('guru.rekap.index') }}"
           class="group bg-white p-6 rounded-2xl border border-gray-200 hover:border-emerald-500 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
            <div class="space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center group-hover:scale-110 transition">
                    <span class="iconify text-2xl" data-icon="mdi:file-chart"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-emerald-700 transition">Rekap Nilai & Cetak</h3>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Tinjau rekapitulasi nilai akhir, KKM, predikat, dan cetak laporan hasil belajar per kelas & mapel.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center text-xs font-bold text-emerald-700 gap-1">
                <span>Lihat Rekap Nilai</span>
                <span class="iconify text-base group-hover:translate-x-1 transition" data-icon="mdi:arrow-right"></span>
            </div>
        </a>
    </div>

    <!-- Riwayat Input Nilai Terakhir -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-emerald-600 text-xl" data-icon="mdi:history"></span>
                <span>Nilai Terakhir yang Diinput</span>
            </h3>
            <a href="{{ route('guru.nilai.index') }}" class="text-xs text-emerald-600 font-bold hover:underline">
                Kelola Nilai Selengkapnya →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-xs">
                <thead>
                    <tr class="text-gray-400 font-bold uppercase text-left">
                        <th class="py-2.5 px-3">Santri</th>
                        <th class="py-2.5 px-3">Kelas</th>
                        <th class="py-2.5 px-3">Mapel</th>
                        <th class="py-2.5 px-3">Tugas</th>
                        <th class="py-2.5 px-3">UTS</th>
                        <th class="py-2.5 px-3">UAS</th>
                        <th class="py-2.5 px-3">Nilai Akhir</th>
                        <th class="py-2.5 px-3">Predikat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($nilaiTerbaru as $n)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2.5 px-3 font-semibold text-gray-800">{{ $n->santri?->nama_lengkap }}</td>
                            <td class="py-2.5 px-3">{{ $n->kelas?->nama_kelas }}</td>
                            <td class="py-2.5 px-3">{{ $n->mapel?->nama_mapel }}</td>
                            <td class="py-2.5 px-3 font-mono">{{ $n->nilai_tugas }}</td>
                            <td class="py-2.5 px-3 font-mono">{{ $n->nilai_uts }}</td>
                            <td class="py-2.5 px-3 font-mono">{{ $n->nilai_uas }}</td>
                            <td class="py-2.5 px-3 font-bold text-emerald-700 font-mono">{{ $n->nilai_akhir }}</td>
                            <td class="py-2.5 px-3">
                                <span class="px-2 py-0.5 bg-green-100 text-green-800 font-bold rounded">
                                    {{ $n->predikat }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-400 italic">
                                Belum ada nilai yang diinput. Silakan buka menu Input Nilai Santri.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
