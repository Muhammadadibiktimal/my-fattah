@extends('yayasan.layouts.app')

@section('title', 'Laporan Dewan Guru & Rombel')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-pink-600 text-2xl" data-icon="mdi:teach"></span>
                <span>Laporan Data Dewan Guru & Rombongan Belajar</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Rekapitulasi tenaga pendidik, ustadz/ustadzah pengampu mapel, serta rombel kelas pesantren.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak</span>
            </button>
            <a href="{{ route('yayasan.laporan.cetak', 'guru') }}" class="px-4 py-2.5 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- Ringkasan Guru & Rombel -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-700 flex items-center justify-center font-bold text-lg">
                <span class="iconify text-2xl" data-icon="mdi:account-tie"></span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase">Total Dewan Guru</p>
                <p class="text-2xl font-black text-gray-900 font-mono">{{ $gurus->count() }} <span class="text-xs font-normal">Ustadz/Guru</span></p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg">
                <span class="iconify text-2xl" data-icon="mdi:google-classroom"></span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase">Rombongan Belajar</p>
                <p class="text-2xl font-black text-emerald-700 font-mono">{{ $kelasList->count() }} <span class="text-xs font-normal">Kelas</span></p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
                <span class="iconify text-2xl" data-icon="mdi:book-open-page-variant"></span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase">Mata Pelajaran</p>
                <p class="text-2xl font-black text-blue-700 font-mono">{{ $mapelList->count() }} <span class="text-xs font-normal">Mapel</span></p>
            </div>
        </div>
    </div>

    <!-- Tabel Dewan Guru -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                <span class="iconify text-pink-600 text-lg" data-icon="mdi:teach"></span>
                <span>Daftar Dewan Guru & Tenaga Pendidik</span>
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4 w-12 text-center">No</th>
                        <th class="py-3 px-4">Nama Dewan Guru / Ustadz</th>
                        <th class="py-3 px-4">Email Akun</th>
                        <th class="py-3 px-4">No. Handphone / WA</th>
                        <th class="py-3 px-4 text-center">Peran Sistem</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($gurus as $index => $g)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-center font-mono text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">
                            {{ $g->name }}
                        </td>
                        <td class="py-3 px-4 font-mono text-gray-600">
                            {{ $g->email }}
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            {{ $g->phone ?? '-' }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2.5 py-0.5 bg-pink-100 text-pink-800 rounded-full font-bold text-[10px]">
                                Guru & Penguji Nilai
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">
                                Aktif
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400 italic">Belum ada data guru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Rombel Kelas & Wali Kelas -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                <span class="iconify text-emerald-600 text-lg" data-icon="mdi:google-classroom"></span>
                <span>Daftar Rombongan Belajar (Rombel) & Wali Kelas</span>
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Nama Kelas</th>
                        <th class="py-3 px-4">Tingkat Pendidikan</th>
                        <th class="py-3 px-4">Wali Kelas Pengampu</th>
                        <th class="py-3 px-4 text-center">Kapasitas / Jumlah Santri</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($kelasList as $k)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 font-bold text-gray-900">
                            Kelas {{ $k->nama_kelas }}
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            Tingkat {{ $k->tingkat }}
                            @if($k->tingkat >= 7 && $k->tingkat <= 9)
                                <span class="text-blue-700 font-bold text-[10px] ml-1">(SMP)</span>
                            @elseif(str_contains($k->nama_kelas, 'SMA'))
                                <span class="text-emerald-700 font-bold text-[10px] ml-1">(SMA)</span>
                            @elseif(str_contains($k->nama_kelas, 'SMK'))
                                <span class="text-purple-700 font-bold text-[10px] ml-1">(SMK)</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-800">
                            {{ $k->wali_kelas ?? 'Belum Ditugaskan' }}
                        </td>
                        <td class="py-3 px-4 text-center font-mono font-bold text-emerald-700">
                            {{ $k->santris_count }} Santri
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
