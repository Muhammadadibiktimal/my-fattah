@extends('kepsek.layouts.app')

@section('title', 'Laporan Presensi Kehadiran Santri')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-teal-600 text-2xl" data-icon="mdi:calendar-check-outline"></span>
                <span>Laporan Presensi & Kehadiran Santri</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Monitoring tingkat kepatuhan dan kehadiran santri selama KBM berlangsung.
            </p>
        </div>
    </div>

    <!-- 4 Mini Presensi Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-2xl">
            <span class="text-[10px] font-bold text-emerald-700 uppercase">Hadir</span>
            <div class="text-2xl font-black text-emerald-800 mt-1 font-mono">{{ $totalHadir }}</div>
        </div>
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-2xl">
            <span class="text-[10px] font-bold text-blue-700 uppercase">Izin</span>
            <div class="text-2xl font-black text-blue-800 mt-1 font-mono">{{ $totalIzin }}</div>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-2xl">
            <span class="text-[10px] font-bold text-yellow-700 uppercase">Sakit</span>
            <div class="text-2xl font-black text-yellow-800 mt-1 font-mono">{{ $totalSakit }}</div>
        </div>
        <div class="bg-red-50 border border-red-200 p-4 rounded-2xl">
            <span class="text-[10px] font-bold text-red-700 uppercase">Alpa</span>
            <div class="text-2xl font-black text-red-800 mt-1 font-mono">{{ $totalAlpa }}</div>
        </div>
    </div>

    <!-- Tabel Presensi -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Santri</th>
                        <th class="py-3 px-4">Kelas</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($absensis as $index => $a)
                    <tr class="hover:bg-gray-50/80">
                        <td class="py-3 px-4 font-mono text-gray-400">{{ $absensis->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-semibold text-gray-700">{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d M Y') }}</td>
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $a->santri?->nama_lengkap }}</td>
                        <td class="py-3 px-4 text-blue-700 font-semibold">{{ $a->kelas?->nama_kelas }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($a->status == 'Hadir')
                                <span class="px-2.5 py-0.5 bg-green-100 text-green-700 rounded-full font-bold text-[10px]">Hadir</span>
                            @elseif($a->status == 'Izin')
                                <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 rounded-full font-bold text-[10px]">Izin</span>
                            @elseif($a->status == 'Sakit')
                                <span class="px-2.5 py-0.5 bg-yellow-100 text-yellow-700 rounded-full font-bold text-[10px]">Sakit</span>
                            @else
                                <span class="px-2.5 py-0.5 bg-red-100 text-red-700 rounded-full font-bold text-[10px]">Alpa</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $a->keterangan ?: '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-400 italic">Belum ada riwayat absensi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $absensis->links() }}
        </div>
    </div>
</div>
@endsection

