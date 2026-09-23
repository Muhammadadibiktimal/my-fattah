@extends('yayasan.layouts.app')

@section('title', 'Laporan Presensi & Kehadiran Santri')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-teal-600 text-2xl" data-icon="mdi:calendar-check-outline"></span>
                <span>Laporan Rekapitulasi Presensi & Kedisiplinan Santri</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Monitoring tingkat kehadiran belajar mengajar seluruh santri Pondok Pesantren Al-Fattah.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak</span>
            </button>
            <a href="{{ route('yayasan.laporan.cetak', 'absensi') }}" class="px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- 5 Metrik Presensi -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Tingkat Kehadiran</span>
            <div class="text-2xl font-black text-teal-700 mt-1 font-mono">{{ $persenHadir }}%</div>
            <p class="text-[10px] text-teal-600 font-bold mt-0.5">✓ Disiplin Sangat Baik</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Total Hadir</span>
            <div class="text-2xl font-black text-emerald-700 mt-1 font-mono">{{ $hadir }}</div>
            <p class="text-[10px] text-gray-400 mt-0.5">Pertemuan Terdata</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Izin</span>
            <div class="text-2xl font-black text-amber-600 mt-1 font-mono">{{ $izin }}</div>
            <p class="text-[10px] text-gray-400 mt-0.5">Surat Keterangan</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Sakit</span>
            <div class="text-2xl font-black text-blue-600 mt-1 font-mono">{{ $sakit }}</div>
            <p class="text-[10px] text-gray-400 mt-0.5">Poskestren</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Alpa</span>
            <div class="text-2xl font-black text-red-600 mt-1 font-mono">{{ $alpa }}</div>
            <p class="text-[10px] text-gray-400 mt-0.5">Tanpa Keterangan</p>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('yayasan.laporan.absensi') }}" class="flex flex-wrap items-center gap-3">
            <select name="kelas_id" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">-- Semua Kelas --</option>
                @foreach($kelasList as $k)
                    <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>
                        Kelas {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">-- Semua Status --</option>
                <option value="Hadir" {{ $status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="Izin" {{ $status == 'Izin' ? 'selected' : '' }}>Izin</option>
                <option value="Sakit" {{ $status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="Alpa" {{ $status == 'Alpa' ? 'selected' : '' }}>Alpa</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition">
                Filter
            </button>

            @if($kelasId || $status)
                <a href="{{ route('yayasan.laporan.absensi') }}" class="text-xs text-gray-400 hover:underline">
                    Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Data Absensi -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Tanggal & Hari</th>
                        <th class="py-3.5 px-4">Nama Santri</th>
                        <th class="py-3.5 px-4">Kelas</th>
                        <th class="py-3.5 px-4 text-center">Status Kehadiran</th>
                        <th class="py-3.5 px-4">Keterangan Presensi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($absensiList as $a)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}
                            <span class="block text-[10px] text-gray-400 font-normal">{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('l') }}</span>
                        </td>
                        <td class="py-3 px-4 font-semibold text-gray-900">
                            {{ $a->santri->nama_lengkap ?? '-' }}
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            {{ $a->kelas ? 'Kelas ' . $a->kelas->nama_kelas : ($a->santri?->kelas ? 'Kelas ' . $a->santri->kelas->nama_kelas : '-') }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($a->status == 'Hadir')
                                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">
                                    ✓ Hadir
                                </span>
                            @elseif($a->status == 'Izin')
                                <span class="px-2.5 py-0.5 bg-amber-100 text-amber-800 rounded-full font-bold text-[10px]">
                                    Izin
                                </span>
                            @elseif($a->status == 'Sakit')
                                <span class="px-2.5 py-0.5 bg-blue-100 text-blue-800 rounded-full font-bold text-[10px]">
                                    Sakit
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 bg-red-100 text-red-800 rounded-full font-bold text-[10px]">
                                    Alpa
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-600 text-[11px]">
                            {{ $a->keterangan ?: 'Tepat waktu mengikuti kegiatan KBM' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400 italic">
                            Belum ada rekaman presensi santri.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($absensiList->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $absensiList->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
