@extends('kepsek.layouts.app')

@section('title', 'Laporan Akademik & Rapor Nilai')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-purple-600 text-2xl" data-icon="mdi:certificate"></span>
                <span>Laporan Akademik & Capaian Nilai Rapor</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Rata-rata Nilai Akademik Keseluruhan: <strong class="text-purple-700 font-mono">{{ $avgNilai }}</strong>
            </p>
        </div>
    </div>

    <!-- Tabel Rekap Nilai -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Santri</th>
                        <th class="py-3 px-4">Kelas</th>
                        <th class="py-3 px-4">Mata Pelajaran</th>
                        <th class="py-3 px-4 text-center">Tugas</th>
                        <th class="py-3 px-4 text-center">UTS</th>
                        <th class="py-3 px-4 text-center">UAS</th>
                        <th class="py-3 px-4 text-center">Nilai Akhir</th>
                        <th class="py-3 px-4 text-center">Predikat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($nilais as $index => $n)
                    <tr class="hover:bg-gray-50/80">
                        <td class="py-3 px-4 font-mono text-gray-400">{{ $nilais->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $n->santri?->nama_lengkap }}</td>
                        <td class="py-3 px-4 text-blue-700 font-semibold">{{ $n->kelas?->nama_kelas }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $n->mapel?->nama_mapel }}</td>
                        <td class="py-3 px-4 text-center font-mono">{{ $n->nilai_tugas }}</td>
                        <td class="py-3 px-4 text-center font-mono">{{ $n->nilai_uts }}</td>
                        <td class="py-3 px-4 text-center font-mono">{{ $n->nilai_uas }}</td>
                        <td class="py-3 px-4 text-center font-mono font-bold text-purple-700">{{ $n->nilai_akhir }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded font-bold text-[10px]">
                                {{ $n->predikat }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-400 italic">Belum ada data nilai tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $nilais->links() }}
        </div>
    </div>
</div>
@endsection

