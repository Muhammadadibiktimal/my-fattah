@extends('yayasan.layouts.app')

@section('title', 'Laporan Akademik & Nilai Rapor')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-purple-600 text-2xl" data-icon="mdi:certificate"></span>
                <span>Laporan Rekapitulasi Nilai & Rapor Santri</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Monitoring perolehan nilai Tugas, UTS, UAS, dan predikat kelulusan KKM santri.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak</span>
            </button>
            <a href="{{ route('yayasan.laporan.cetak', 'nilai') }}" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- 3 Metrik Prestasi Akademik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Rata-Rata Nilai</span>
            <div class="text-2xl font-black text-purple-700 mt-1 font-mono">{{ $rataRata }} <span class="text-xs font-normal text-gray-400">/ 100</span></div>
            <p class="text-[10px] text-purple-600 font-bold mt-0.5">Predikat Sangat Baik (A)</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Ketuntasan KKM (≥ 75)</span>
            <div class="text-2xl font-black text-emerald-600 mt-1 font-mono">{{ $persenTuntas }}%</div>
            <p class="text-[10px] text-emerald-700 font-bold mt-0.5">{{ $totalTuntas }} dari {{ $totalRekap }} Rekap Tuntas</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Standar KKM Pesantren</span>
            <div class="text-2xl font-black text-gray-800 mt-1 font-mono">75.0</div>
            <p class="text-[10px] text-gray-400 mt-0.5">Batas Minimal Kelulusan Mapel</p>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('yayasan.laporan.nilai') }}" class="flex flex-wrap items-center gap-3">
            <select name="kelas_id" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">-- Semua Kelas --</option>
                @foreach($kelasList as $k)
                    <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>
                        Kelas {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>

            <select name="mapel_id" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">-- Semua Mata Pelajaran --</option>
                @foreach($mapelList as $m)
                    <option value="{{ $m->id }}" {{ $mapelId == $m->id ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition">
                Tampilkan
            </button>

            @if($kelasId || $mapelId)
                <a href="{{ route('yayasan.laporan.nilai') }}" class="text-xs text-gray-400 hover:underline">
                    Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Data Nilai Santri -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Nama Santri</th>
                        <th class="py-3.5 px-4">Kelas</th>
                        <th class="py-3.5 px-4">Mata Pelajaran</th>
                        <th class="py-3.5 px-4 text-center">Tugas</th>
                        <th class="py-3.5 px-4 text-center">UTS</th>
                        <th class="py-3.5 px-4 text-center">UAS</th>
                        <th class="py-3.5 px-4 text-center">Nilai Akhir</th>
                        <th class="py-3.5 px-4 text-center">Predikat</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($nilaiList as $n)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 font-bold text-gray-900">
                            {{ $n->santri->nama_lengkap ?? '-' }}
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            {{ $n->santri?->kelas ? 'Kelas ' . $n->santri->kelas->nama_kelas : '-' }}
                        </td>
                        <td class="py-3 px-4 font-semibold text-emerald-800">
                            {{ $n->mapel->nama_mapel ?? '-' }}
                        </td>
                        <td class="py-3 px-4 text-center font-mono">{{ $n->nilai_tugas }}</td>
                        <td class="py-3 px-4 text-center font-mono">{{ $n->nilai_uts }}</td>
                        <td class="py-3 px-4 text-center font-mono">{{ $n->nilai_uas }}</td>
                        <td class="py-3 px-4 text-center font-mono font-bold text-purple-700 text-sm">
                            {{ $n->nilai_akhir }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded font-bold text-xs">
                                {{ $n->predikat }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($n->nilai_akhir >= 75)
                                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">
                                    ✓ Tuntas
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 bg-red-100 text-red-800 rounded-full font-bold text-[10px]">
                                    Remedial
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-8 text-center text-gray-400 italic">
                            Belum ada rekap nilai yang sesuai dengan filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($nilaiList->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $nilaiList->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
