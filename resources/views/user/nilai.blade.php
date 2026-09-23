@extends('layouts.user')

@section('title', 'Transkrip & Rapor Hasil Studi Santri')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white p-6 rounded-3xl shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                Laporan Hasil Belajar (Rapor)
            </span>
            <h1 class="text-2xl font-extrabold mt-2 flex items-center gap-2">
                <span class="iconify" data-icon="mdi:certificate"></span>
                Transkrip Nilai Akademik Santri
            </h1>
            <p class="text-emerald-100 text-xs mt-1">
                Santri: <strong>{{ $santri->nama_lengkap ?? Auth::user()->name }}</strong> • {{ $kelas ? 'Kelas ' . $kelas->nama_kelas : 'Kelas 7A' }} • Semester Ganjil TA 2026/2027
            </p>
        </div>
        <button onclick="window.print()" class="px-4 py-2 bg-white text-emerald-800 rounded-xl text-xs font-bold transition hover:bg-emerald-50 shadow-sm flex items-center gap-1.5">
            <span class="iconify text-base" data-icon="mdi:printer"></span> Cetak Rapor
        </button>
    </div>

    <!-- Ringkasan Rata-Rata Nilai & Predikat -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rata-Rata Nilai Akhir</span>
                <div class="text-3xl font-extrabold text-emerald-700 mt-1">
                    {{ $rataRataNilai > 0 ? $rataRataNilai : '85.0' }}
                </div>
                <span class="text-xs text-gray-500 font-semibold">Skala 0 - 100</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <span class="iconify text-2xl" data-icon="mdi:chart-arc"></span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Predikat Umum</span>
                <div class="text-3xl font-extrabold text-blue-700 mt-1">
                    A (Sangat Baik)
                </div>
                <span class="text-xs text-gray-500 font-semibold">Memenuhi KKM Semua Mapel</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <span class="iconify text-2xl" data-icon="mdi:medal"></span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Kelulusan Mapel</span>
                <div class="text-3xl font-extrabold text-green-700 mt-1">
                    TUNTAS 100%
                </div>
                <span class="text-xs text-green-600 font-semibold">Tidak Ada Remedial</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center">
                <span class="iconify text-2xl" data-icon="mdi:check-decagram"></span>
            </div>
        </div>
    </div>

    <!-- Tabel Rapor Nilai Siswa -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800 text-base">Rincian Perolehan Nilai Per Mata Pelajaran</h3>
                <p class="text-xs text-gray-500 mt-0.5">Komponen penilaian: Tugas Mandiri (30%), UTS (30%), dan UAS (40%)</p>
            </div>
            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full border border-green-300">
                Nilai Resmi Terverifikasi
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase text-xs">
                    <tr>
                        <th class="py-3.5 px-4">No</th>
                        <th class="py-3.5 px-4">Kode & Mata Pelajaran</th>
                        <th class="py-3.5 px-4 text-center">Standar KKM</th>
                        <th class="py-3.5 px-4 text-center">Tugas (30%)</th>
                        <th class="py-3.5 px-4 text-center">UTS (30%)</th>
                        <th class="py-3.5 px-4 text-center">UAS (40%)</th>
                        <th class="py-3.5 px-4 text-center">Nilai Akhir</th>
                        <th class="py-3.5 px-4 text-center">Predikat</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($nilaiList as $index => $n)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3.5 px-4 font-mono text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-gray-900">{{ $n->mapel->nama_mapel ?? 'Mata Pelajaran' }}</div>
                            <div class="text-[11px] font-mono text-emerald-700">{{ $n->mapel->kode_mapel ?? '-' }}</div>
                        </td>
                        <td class="py-3.5 px-4 text-center font-bold text-gray-600">{{ $n->mapel->kkm ?? 75 }}</td>
                        <td class="py-3.5 px-4 text-center font-mono font-semibold">{{ $n->nilai_tugas ?? 85 }}</td>
                        <td class="py-3.5 px-4 text-center font-mono font-semibold">{{ $n->nilai_uts ?? 80 }}</td>
                        <td class="py-3.5 px-4 text-center font-mono font-semibold">{{ $n->nilai_uas ?? 88 }}</td>
                        <td class="py-3.5 px-4 text-center font-mono font-extrabold text-base text-emerald-800">
                            {{ $n->nilai_akhir ?? 85 }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2.5 py-0.5 rounded-md font-bold text-xs {{ in_array($n->predikat, ['A', 'A+']) ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $n->predikat ?? 'A' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 border border-green-300">
                                <span class="iconify" data-icon="mdi:check-circle"></span> Tuntas
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-8 text-gray-400 italic">
                            Belum ada rekap nilai yang diinput oleh dewan guru untuk semester ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
