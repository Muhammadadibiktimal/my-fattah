@extends('kepsek.layouts.app')

@section('title', 'Laporan Dewan Guru & Rombel')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-pink-600 text-2xl" data-icon="mdi:teach"></span>
                <span>Laporan Dewan Guru & Pembagian Rombel</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Daftar tenaga pengajar, ustadz/ustadzah, dan wali kelas resmi Pondok Pesantren Al-Fattah.
            </p>
        </div>
    </div>

    <!-- Tabel Guru -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Nama Dewan Guru</th>
                        <th class="py-3 px-4">Email Akun</th>
                        <th class="py-3 px-4">Amanah Wali Kelas</th>
                        <th class="py-3 px-4 text-center">Status Akun</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($gurus as $index => $g)
                    @php
                        $waliRombel = $kelasList->filter(fn($k) => str_contains(strtolower($k->wali_kelas), strtolower($g->name)));
                    @endphp
                    <tr class="hover:bg-gray-50/80">
                        <td class="py-3 px-4 font-mono text-gray-400">{{ $gurus->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $g->name }}</td>
                        <td class="py-3 px-4 text-gray-500 font-mono text-[11px]">{{ $g->email }}</td>
                        <td class="py-3 px-4">
                            @if($waliRombel->isNotEmpty())
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 font-bold rounded-lg text-[10px]">
                                    Wali {{ $waliRombel->pluck('nama_kelas')->join(', ') }}
                                </span>
                            @else
                                <span class="text-gray-400 text-[11px]">Guru Pengampu Mapel</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2.5 py-0.5 bg-green-100 text-green-700 rounded-full font-bold text-[10px]">
                                Aktif
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400 italic">Belum ada data guru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $gurus->links() }}
        </div>
    </div>
</div>
@endsection

