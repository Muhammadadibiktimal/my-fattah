@extends('layouts.user')

@section('title', 'Rekap Kehadiran Santri')

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-teal-800 via-emerald-700 to-green-900 text-white p-6 sm:p-8 rounded-3xl shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-3 py-1 bg-yellow-400 text-gray-950 rounded-full text-xs font-black uppercase tracking-wider shadow-sm">
                    Presensi & Kehadiran Santri
                </span>
                <span class="px-3 py-1 bg-white/20 text-emerald-100 rounded-full text-xs font-semibold">
                    Semester Ganjil TA 2026/2027
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold mt-3 flex items-center gap-2">
                <span class="iconify text-3xl text-emerald-300" data-icon="mdi:calendar-check-outline"></span>
                <span>Rekapitulasi Kehadiran: {{ $santri->nama_lengkap ?? Auth::user()->name }}</span>
            </h1>
            <p class="text-emerald-100 text-xs sm:text-sm mt-1 max-w-xl leading-relaxed">
                Catatan absensi santri di kelas <strong>{{ $kelas ? 'Kelas ' . $kelas->nama_kelas : '10 SMK-MM' }}</strong>. Wali Kelas: <strong>{{ $kelas->wali_kelas ?? 'Ustadz Ridwan Efendi, S.Kom.' }}</strong>
            </p>
        </div>

        <div class="relative z-10 flex items-center gap-2 flex-shrink-0">
            <button onclick="window.print()" class="px-4 py-2.5 bg-white text-emerald-900 font-bold rounded-xl text-xs flex items-center gap-1.5 shadow-md hover:bg-emerald-50 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak Presensi</span>
            </button>
            <a href="{{ route('user.jadwal') }}" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                <span class="iconify text-base" data-icon="mdi:calendar-clock"></span>
                <span>Lihat Jadwal</span>
            </a>
        </div>
    </div>

    <!-- 5 Kartu Statistik Kehadiran -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- 1. Persentase Kehadiran -->
        <div class="col-span-2 sm:col-span-1 bg-white rounded-2xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Persentase</span>
                <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center">
                    <span class="iconify text-lg" data-icon="mdi:percent-outline"></span>
                </div>
            </div>
            <div class="text-2xl font-black text-teal-700 font-mono">
                {{ $persentase }}%
            </div>
            <div class="mt-2 w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="bg-teal-600 h-2 rounded-full transition-all duration-500" style="width: {{ min(100, $persentase) }}%"></div>
            </div>
            <span class="text-[10px] text-teal-700 font-bold mt-1.5 block">
                ✓ Memenuhi Syarat (Min. 80%)
            </span>
        </div>

        <!-- 2. Hadir -->
        <div class="bg-white rounded-2xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Hadir</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <span class="iconify text-lg" data-icon="mdi:check-circle"></span>
                </div>
            </div>
            <div class="text-2xl font-black text-emerald-700 font-mono">
                {{ $totalHadir }} <span class="text-xs font-normal text-gray-500">Hari</span>
            </div>
            <p class="text-[10px] text-gray-400 mt-1">Presensi tepat waktu</p>
        </div>

        <!-- 3. Izin -->
        <div class="bg-white rounded-2xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Izin</span>
                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                    <span class="iconify text-lg" data-icon="mdi:email-outline"></span>
                </div>
            </div>
            <div class="text-2xl font-black text-amber-700 font-mono">
                {{ $totalIzin }} <span class="text-xs font-normal text-gray-500">Hari</span>
            </div>
            <p class="text-[10px] text-gray-400 mt-1">Dengan surat keterangan</p>
        </div>

        <!-- 4. Sakit -->
        <div class="bg-white rounded-2xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Sakit</span>
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
                    <span class="iconify text-lg" data-icon="mdi:hospital-box-outline"></span>
                </div>
            </div>
            <div class="text-2xl font-black text-blue-700 font-mono">
                {{ $totalSakit }} <span class="text-xs font-normal text-gray-500">Hari</span>
            </div>
            <p class="text-[10px] text-gray-400 mt-1">Surat dokter / poskestren</p>
        </div>

        <!-- 5. Alpa -->
        <div class="bg-white rounded-2xl p-4 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Alpa</span>
                <div class="w-8 h-8 rounded-lg bg-red-100 text-red-700 flex items-center justify-center">
                    <span class="iconify text-lg" data-icon="mdi:close-circle-outline"></span>
                </div>
            </div>
            <div class="text-2xl font-black text-red-600 font-mono">
                {{ $totalAlpa }} <span class="text-xs font-normal text-gray-500">Hari</span>
            </div>
            <p class="text-[10px] text-gray-400 mt-1">Tanpa keterangan</p>
        </div>
    </div>

    <!-- Banner Ketentuan Presensi -->
    <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 text-emerald-900 text-xs">
        <span class="iconify text-2xl text-emerald-600 flex-shrink-0" data-icon="mdi:shield-check"></span>
        <div>
            <span class="font-bold">Standar Kedisiplinan Pesantren Al-Fattah:</span>
            <span>Syarat minimal kehadiran santri untuk mengikuti Penilaian Akhir Semester (PAS) adalah <strong>80%</strong> dari total hari efektif belajar mengajar.</span>
        </div>
    </div>

    <!-- Tabel Riwayat Presensi Santri -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <span class="iconify text-emerald-600 text-lg" data-icon="mdi:format-list-checks"></span>
                    <span>Riwayat Kehadiran Harian Santri</span>
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Catatan presensi harian dari sistem absensi ustadz / guru pengampu.</p>
            </div>
            <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                Total: {{ $totalPertemuan }} Pertemuan Tercatat
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4 w-12 text-center">No</th>
                        <th class="py-3 px-4">Hari & Tanggal</th>
                        <th class="py-3 px-4">Kelas / Rombel</th>
                        <th class="py-3 px-4 text-center">Status Kehadiran</th>
                        <th class="py-3 px-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($absensiList as $index => $ab)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-center text-gray-400 font-mono">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-800 block text-sm">
                                {{ \Carbon\Carbon::parse($ab->tanggal)->translatedFormat('l, d F Y') }}
                            </span>
                            <span class="text-[10px] text-gray-400 font-mono">07.30 - 14.30 WIB</span>
                        </td>
                        <td class="py-3 px-4 font-semibold text-gray-700">
                            {{ $ab->kelas ? 'Kelas ' . $ab->kelas->nama_kelas : ($kelas ? 'Kelas ' . $kelas->nama_kelas : '10 SMK-MM') }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($ab->status == 'Hadir')
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold">
                                    <span class="iconify" data-icon="mdi:check-circle"></span> Hadir
                                </span>
                            @elseif($ab->status == 'Izin')
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-bold">
                                    <span class="iconify" data-icon="mdi:email-outline"></span> Izin
                                </span>
                            @elseif($ab->status == 'Sakit')
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">
                                    <span class="iconify" data-icon="mdi:hospital-box-outline"></span> Sakit
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">
                                    <span class="iconify" data-icon="mdi:close-circle-outline"></span> Alpa
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ $ab->keterangan ?: ($ab->status == 'Hadir' ? 'Tepat waktu mengikuti kegiatan KBM' : '-') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400 italic">
                            Belum ada catatan absensi untuk semester ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
