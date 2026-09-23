@extends('guru.layouts.app')

@section('title', 'Rekap Nilai Santri')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-emerald-600 text-3xl" data-icon="mdi:file-chart-outline"></span>
                <span>Rekapitulasi Nilai Siswa/Santri</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Laporan rekap nilai hasil evaluasi belajar santri per kelas dan mata pelajaran.
            </p>
        </div>

        @if($rekapData->isNotEmpty())
            <a href="{{ route('guru.rekap.cetak', ['kelas_id' => $kelasId, 'mapel_id' => $mapelId, 'semester' => $semester, 'tahun_ajaran' => $tahunAjaran]) }}"
               target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 hover:bg-black text-white rounded-xl text-xs font-bold shadow-md transition transform hover:-translate-y-0.5">
                <span class="iconify text-lg" data-icon="mdi:printer"></span>
                <span>Cetak / Export Laporan</span>
            </a>
        @endif
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('guru.rekap.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            <!-- Pilih Kelas -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Kelas / Rombel</label>
                <select name="kelas_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>
                            Kelas {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Mapel -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Mata Pelajaran</label>
                <select name="mapel_id" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    @foreach($mapelList as $m)
                        <option value="{{ $m->id }}" {{ $mapelId == $m->id ? 'selected' : '' }}>
                            {{ $m->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Semester -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Semester</label>
                <select name="semester" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>
            </div>

            <!-- Tahun Ajaran -->
            <div>
                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5">Tahun Ajaran</label>
                <select name="tahun_ajaran" class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="2026/2027" {{ $tahunAjaran == '2026/2027' ? 'selected' : '' }}>2026/2027</option>
                    <option value="2025/2026" {{ $tahunAjaran == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                </select>
            </div>

            <div>
                <button type="submit"
                        class="w-full py-2.5 bg-gray-800 hover:bg-gray-900 text-white font-bold text-xs rounded-xl transition flex items-center justify-center gap-1">
                    <span class="iconify text-base" data-icon="mdi:filter-variant"></span>
                    <span>Tampilkan Rekap</span>
                </button>
            </div>
        </form>
    </div>

    @if($selectedKelas && $selectedMapel)
        <!-- Stat Cards Evaluasi -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
                <span class="text-xs font-bold uppercase text-gray-400">Rata-rata Nilai Kelas</span>
                <div class="text-2xl font-black text-emerald-700 mt-1 font-mono">{{ $avgNilai }}</div>
                <span class="text-[11px] text-gray-500">Standar KKM: {{ $selectedMapel->kkm }}</span>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
                <span class="text-xs font-bold uppercase text-gray-400">Nilai Tertinggi</span>
                <div class="text-2xl font-black text-blue-700 mt-1 font-mono">{{ $maxNilai }}</div>
                <span class="text-[11px] text-gray-500">Nilai Maksimal Ujian</span>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
                <span class="text-xs font-bold uppercase text-gray-400">Santri Tuntas</span>
                <div class="text-2xl font-black text-green-700 mt-1">{{ $tuntasCount }} Santri</div>
                <span class="text-[11px] text-green-600 font-semibold">Memenuhi KKM</span>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
                <span class="text-xs font-bold uppercase text-gray-400">Perlu Remedial</span>
                <div class="text-2xl font-black text-red-600 mt-1">{{ $belumTuntasCount }} Santri</div>
                <span class="text-[11px] text-red-500 font-semibold">Di bawah KKM</span>
            </div>
        </div>

        <!-- Tabel Rekapitulasi -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h4 class="font-bold text-gray-800 text-sm">
                    Daftar Nilai Kelas {{ $selectedKelas->nama_kelas }} • {{ $selectedMapel->nama_mapel }}
                </h4>
                <span class="text-xs text-gray-500 font-semibold">Semester {{ $semester }} ({{ $tahunAjaran }})</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4 text-center w-12">#</th>
                            <th class="py-3 px-4 text-left">Nama Santri</th>
                            <th class="py-3 px-4 text-center">Tugas (30%)</th>
                            <th class="py-3 px-4 text-center">UTS (30%)</th>
                            <th class="py-3 px-4 text-center">UAS (40%)</th>
                            <th class="py-3 px-4 text-center">Nilai Akhir</th>
                            <th class="py-3 px-4 text-center">Predikat</th>
                            <th class="py-3 px-4 text-center">Ketuntasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($rekapData as $index => $item)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3 px-4 text-center text-gray-400 font-mono">{{ $index + 1 }}</td>
                                <td class="py-3 px-4">
                                    <span class="font-semibold text-gray-800">{{ $item->santri->nama_lengkap }}</span>
                                    <div class="text-[11px] text-gray-400 font-mono">NISN: {{ $item->santri->nisn ?? '-' }}</div>
                                </td>
                                <td class="py-3 px-4 text-center font-mono">{{ $item->tugas }}</td>
                                <td class="py-3 px-4 text-center font-mono">{{ $item->uts }}</td>
                                <td class="py-3 px-4 text-center font-mono">{{ $item->uas }}</td>
                                <td class="py-3 px-4 text-center font-mono font-bold text-base {{ $item->akhir >= $selectedMapel->kkm ? 'text-emerald-700' : 'text-red-600' }}">
                                    {{ $item->akhir }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2.5 py-1 font-bold text-xs rounded-lg
                                        {{ $item->predikat == 'A' ? 'bg-green-100 text-green-800' : ($item->predikat == 'B' ? 'bg-blue-100 text-blue-800' : ($item->predikat == 'C' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ $item->predikat }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($item->status == 'Tuntas')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                            <span class="iconify" data-icon="mdi:check"></span> Tuntas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-red-100 text-red-800 rounded-full text-xs font-bold">
                                            <span class="iconify" data-icon="mdi:close"></span> Remedial
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-400 italic">
                                    Belum ada data nilai di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
@endsection
