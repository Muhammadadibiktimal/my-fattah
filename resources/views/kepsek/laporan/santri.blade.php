@extends('kepsek.layouts.app')

@section('title', 'Laporan Data Santri Aktif & Rombel')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-blue-600 text-2xl" data-icon="mdi:account-school-outline"></span>
                <span>Laporan Data Santri Aktif & Rombongan Belajar</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Total {{ $totalSantri }} santri aktif terdaftar di seluruh kelas pesantren.
            </p>
        </div>
    </div>

    <!-- Filter Kelas -->
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('kepsek.laporan.santri') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !$kelasId ? 'bg-blue-600 text-white shadow-sm' : 'bg-white border text-gray-700 hover:bg-gray-50' }}">
            Semua Kelas
        </a>
        @foreach($kelasList as $k)
        <a href="{{ route('kepsek.laporan.santri', ['kelas_id' => $k->id]) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $kelasId == $k->id ? 'bg-blue-600 text-white shadow-sm' : 'bg-white border text-gray-700 hover:bg-gray-50' }}">
            {{ $k->nama_kelas }}
        </a>
        @endforeach
    </div>

    <!-- Tabel Santri -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">NISN</th>
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">Kelas</th>
                        <th class="py-3 px-4">Jenis Kelamin</th>
                        <th class="py-3 px-4">Wali Kelas</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($santris as $index => $s)
                    <tr class="hover:bg-gray-50/80">
                        <td class="py-3 px-4 font-mono text-gray-400">{{ $santris->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-mono font-bold text-gray-700">{{ $s->nisn ?: '-' }}</td>
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $s->nama_lengkap }}</td>
                        <td class="py-3 px-4 font-semibold text-blue-700">{{ $s->kelas?->nama_kelas ?? 'Belum Ditentukan' }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $s->jenis_kelamin }}</td>
                        <td class="py-3 px-4 text-gray-500 text-[11px]">{{ $s->kelas?->wali_kelas ?: '-' }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2.5 py-0.5 bg-green-100 text-green-700 rounded-full font-bold text-[10px]">
                                {{ $s->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-400 italic">Belum ada santri terdaftar di kelas ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $santris->links() }}
        </div>
    </div>
</div>
@endsection

