@extends('layouts.user')

@section('title', 'Jadwal Pelajaran & KBM 2026/2027')

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white p-6 sm:p-8 rounded-3xl shadow-lg relative overflow-hidden">
        <div class="absolute -right-12 -bottom-12 w-56 h-56 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-5">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                        Tahun Pelajaran 2026/2027
                    </span>
                    <span class="px-3 py-1 bg-white/15 text-emerald-100 rounded-full text-xs font-semibold">
                        SK Jadwal: 07 September 2026
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold flex items-center gap-2">
                    <span class="iconify text-yellow-300" data-icon="mdi:calendar-clock"></span>
                    Jadwal KBM: {{ $kelas ? $kelas->nama_kelas : 'Kelas I' }}
                </h1>
                <p class="text-emerald-100 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
                    Pondok Pesantren Al-Fattah Tigaraksa • Wali Kelas: <strong class="text-white">{{ $kelas->wali_kelas ?? 'Ust Mohamad Paisal' }}</strong> • Guru Piket: <strong class="text-white">Ustdzh Rizka Amanda</strong>
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('user.dashboard') }}" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 backdrop-blur-sm">
                    <span class="iconify text-base" data-icon="mdi:arrow-left"></span>
                    Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Pilihan Rombongan Belajar (Kelas I s/d Kelas VI) -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm space-y-3">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
            <div>
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-1.5">
                    <span class="iconify text-emerald-600 text-lg" data-icon="mdi:google-classroom"></span>
                    Pilih Rombongan Belajar (Rombel / Kelas)
                </h3>
                <p class="text-xs text-gray-500">Silakan klik kelas untuk melihat jadwal pelajaran resmi sesuai dokumen kurikulum pesantren:</p>
            </div>
            @if($santri && $santri->kelas)
            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-semibold">
                Kelas Anda: <strong>{{ $santri->kelas->nama_kelas }}</strong>
            </span>
            @endif
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2 pt-1">
            @foreach($kelasList as $k)
            @php $isActive = ($kelas && $kelas->id == $k->id); @endphp
            <a href="{{ route('user.jadwal', ['kelas_id' => $k->id]) }}"
               class="p-3 rounded-xl border text-center transition duration-200 flex flex-col justify-between items-center {{ $isActive ? 'bg-emerald-600 text-white border-emerald-600 shadow-md ring-2 ring-emerald-400/40' : 'bg-gray-50 hover:bg-emerald-50 border-gray-200 text-gray-700' }}">
                <span class="text-xs font-bold uppercase tracking-wider block {{ $isActive ? 'text-emerald-100' : 'text-gray-400' }}">
                    Tingkat {{ $k->tingkat }}
                </span>
                <span class="text-base font-black my-1 block">
                    {{ $k->nama_kelas }}
                </span>
                <span class="text-[10px] leading-tight block truncate w-full {{ $isActive ? 'text-emerald-100' : 'text-gray-500' }}" title="{{ $k->wali_kelas }}">
                    {{ Str::limit($k->wali_kelas, 16) }}
                </span>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Informasi Kelas & Wali Kelas Banner -->
    <div class="bg-emerald-50/70 border border-emerald-200 rounded-2xl p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white font-black text-lg flex items-center justify-center shadow-sm">
                {{ $kelas ? $kelas->nama_kelas : 'Kelas I' }}
            </div>
            <div>
                <h4 class="font-extrabold text-gray-900 text-sm">
                    Jadwal Resmi: {{ $kelas ? $kelas->nama_kelas : 'Kelas I' }}
                </h4>
                <p class="text-xs text-gray-600">
                    Jenjang: <strong>{{ $kelas->jenjang ?? 'SMP/MTs' }}</strong> • Wali Kelas: <strong class="text-emerald-800">{{ $kelas->wali_kelas ?? 'Ust Mohamad Paisal' }}</strong>
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 text-xs">
            <div class="px-3 py-1.5 bg-white border border-emerald-200 rounded-xl shadow-xs">
                <span class="text-gray-400 block text-[10px]">Guru Piket Harian</span>
                <strong class="text-gray-800 font-semibold">Ustdzh Rizka Amanda</strong>
            </div>
            <div class="px-3 py-1.5 bg-white border border-emerald-200 rounded-xl shadow-xs">
                <span class="text-gray-400 block text-[10px]">Tahun Ajaran</span>
                <strong class="text-emerald-700 font-semibold">2026/2027</strong>
            </div>
        </div>
    </div>

    <!-- Jadwal Mingguan Grid (Senin s/d Sabtu) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

        @php
            $hariOrder = [
                'Senin' => [
                    'color' => 'from-emerald-700 to-green-800',
                    'header_time' => '07.00 - 12.15',
                    'piket' => '07.00 - 07.15: PIKET KELAS',
                    'opening' => '07.15 - 08.00: UPACARA / SENAM / KOSA KATA',
                    'dhuha' => '09.45 - 10.00: SHALAT DHUHA DI KELAS',
                    'break' => '10.00 - 10.30: ISTIRAHAT',
                ],
                'Selasa' => [
                    'color' => 'from-green-700 to-emerald-800',
                    'header_time' => '07.00 - 12.20',
                    'piket' => '07.00 - 07.15: PIKET KELAS',
                    'opening' => '07.15 - 07.30: GERAKAN LITERASI AL FATTAH (GELFA)',
                    'dhuha' => '09.50 - 10.05: SHALAT DHUHA DI KELAS',
                    'break' => '10.05 - 10.35: ISTIRAHAT',
                ],
                'Rabu' => [
                    'color' => 'from-teal-700 to-emerald-800',
                    'header_time' => '07.00 - 15.00',
                    'piket' => '07.00 - 07.15: PIKET KELAS',
                    'opening' => '07.15 - 07.30: GERAKAN LITERASI AL FATTAH (GELFA)',
                    'dhuha' => '09.50 - 10.05: SHALAT DHUHA DI KELAS',
                    'break' => '10.05 - 10.35: ISTIRAHAT',
                    'afternoon' => '13.00 - 15.00: INTRAKURIKULER PRAMUKA',
                ],
                'Kamis' => [
                    'color' => 'from-emerald-800 to-teal-800',
                    'header_time' => '07.00 - 12.20',
                    'piket' => '07.00 - 07.15: PIKET KELAS',
                    'opening' => '07.15 - 07.30: GERAKAN LITERASI AL FATTAH (GELFA)',
                    'dhuha' => '09.50 - 10.05: SHALAT DHUHA DI KELAS',
                    'break' => '10.05 - 10.35: ISTIRAHAT',
                ],
                'Jumat' => [
                    'color' => 'from-green-800 to-emerald-900',
                    'header_time' => '07.00 - 14.00',
                    'piket' => '07.00 - 07.30: PIKET & DHUHA',
                    'opening' => '07.15 - 07.30: GERAKAN LITERASI AL FATTAH (GELFA)',
                    'afternoon' => '10.00 - 11.30: TAHRIM & SHALAT JUMAT / KEPUTRIAN | 13.00 - 14.00: KEPUTRAAN',
                ],
                'Sabtu' => [
                    'color' => 'from-teal-800 to-green-800',
                    'header_time' => '07.00 - 12.20',
                    'piket' => '07.00 - 07.15: PIKET KELAS',
                    'opening' => '07.15 - 07.30: GERAKAN LITERASI SEKOLAH (GLS)',
                    'dhuha' => '09.50 - 10.05: SHALAT DHUHA DI KELAS',
                    'break' => '10.05 - 10.35: ISTIRAHAT',
                ],
            ];
        @endphp

        @foreach($hariOrder as $hari => $meta)
        @php
            $items = $jadwalGrouped->get($hari, collect());
        @endphp
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between">
            <!-- Header Hari -->
            <div>
                <div class="bg-gradient-to-r {{ $meta['color'] }} text-white px-4 py-3 flex items-center justify-between">
                    <span class="font-bold text-sm tracking-wide">{{ $hari }}</span>
                    <span class="text-[10px] bg-white/20 font-mono px-2 py-0.5 rounded font-bold">
                        {{ $meta['header_time'] }}
                    </span>
                </div>

                <!-- Agenda Pagi Khusus -->
                <div class="px-4 py-2 bg-emerald-50/50 border-b border-emerald-100 text-[10px] space-y-1">
                    <div class="flex items-center gap-1.5 text-emerald-800 font-semibold">
                        <span class="iconify" data-icon="mdi:broom"></span>
                        <span>{{ $meta['piket'] }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-emerald-700">
                        <span class="iconify" data-icon="mdi:book-open-variant"></span>
                        <span>{{ $meta['opening'] }}</span>
                    </div>
                </div>

                <!-- List Jam Pelajaran -->
                <div class="p-3.5 space-y-2.5">
                    @forelse($items as $jdw)
                    <div class="p-3 bg-gray-50/80 hover:bg-emerald-50/50 rounded-xl border border-gray-100 transition duration-150">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-[10px] text-emerald-700 font-bold font-mono bg-emerald-100/60 px-1.5 py-0.5 rounded">
                                Jam {{ $jdw->jam_ke }} • {{ $jdw->waktu }}
                            </span>
                            <span class="text-[10px] font-mono font-black text-gray-500 bg-white border border-gray-200 px-1.5 py-0.5 rounded shadow-2xs" title="Kode Gabungan [Guru & Mapel]">
                                {{ $jdw->kode_gabungan }}
                            </span>
                        </div>
                        <div class="font-extrabold text-xs text-gray-800">
                            {{ $jdw->mapel->nama_mapel ?? 'Mata Pelajaran #' . $jdw->kode_mapel }}
                        </div>
                        <div class="text-[11px] text-gray-500 flex items-center gap-1 mt-0.5">
                            <span class="iconify text-gray-400" data-icon="mdi:account-tie"></span>
                            <span>{{ $jdw->guru->name ?? 'Dewan Guru' }}</span>
                        </div>
                    </div>

                    {{-- Sisipan Istirahat & Dhuha --}}
                    @if($hari == 'Senin' && $jdw->jam_ke == 3)
                    <div class="p-2 bg-amber-50/70 border border-amber-200/60 rounded-xl text-center text-[10px] text-amber-800 font-bold flex items-center justify-center gap-1.5">
                        <span class="iconify text-amber-600" data-icon="mdi:mosque"></span>
                        <span>{{ $meta['dhuha'] }} &bull; {{ $meta['break'] }}</span>
                    </div>
                    @elseif($hari != 'Senin' && $hari != 'Jumat' && $jdw->jam_ke == 4)
                    <div class="p-2 bg-amber-50/70 border border-amber-200/60 rounded-xl text-center text-[10px] text-amber-800 font-bold flex items-center justify-center gap-1.5">
                        <span class="iconify text-amber-600" data-icon="mdi:coffee-outline"></span>
                        <span>{{ $meta['dhuha'] }} &bull; {{ $meta['break'] }}</span>
                    </div>
                    @endif

                    @empty
                    <div class="py-6 text-center text-gray-400 text-xs italic">
                        Tidak ada jadwal KBM pada hari ini.
                    </div>
                    @endforelse

                    {{-- Agenda Siang Khusus --}}
                    @if(isset($meta['afternoon']))
                    <div class="p-2.5 bg-blue-50 border border-blue-200/60 rounded-xl text-center text-[10px] text-blue-900 font-bold flex items-center justify-center gap-1.5">
                        <span class="iconify text-blue-600 text-sm" data-icon="mdi:shield-account"></span>
                        <span>{{ $meta['afternoon'] }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Footer Hari -->
            <div class="px-4 py-2 bg-gray-50 border-t border-gray-100 text-[10px] text-gray-400 flex justify-between items-center">
                <span>{{ $items->count() }} Sesi Pelajaran</span>
                <span class="font-mono text-emerald-600 font-bold">{{ $kelas ? $kelas->nama_kelas : 'Kelas I' }}</span>
            </div>
        </div>
        @endforeach

    </div>

    <!-- 🔹 SEKSI DAFTAR GURU & WALI KELAS RESMI DOKUMEN -->
    <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
            <div>
                <h3 class="font-extrabold text-gray-900 text-base flex items-center gap-2">
                    <span class="iconify text-emerald-600 text-xl" data-icon="mdi:account-group-outline"></span>
                    <span>Daftar Wali Kelas & Guru Piket Resmi (SK 2026/2027)</span>
                </h3>
                <p class="text-xs text-gray-500">Struktur penanggung jawab kelas dan piket harian Pondok Pesantren Al-Fattah Tigaraksa:</p>
            </div>
            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg">
                Guru Piket: Ustdzh Rizka Amanda
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
            @php
                $waliList = [
                    ['kelas' => 'Kelas I',   'wali' => 'Ust Mohamad Paisal', 'tingkat' => 'Tingkat 7 (SMP)'],
                    ['kelas' => 'Kelas II',  'wali' => 'Ust Rizqi Ardimansyah', 'tingkat' => 'Tingkat 8 (SMP)'],
                    ['kelas' => 'Kelas III', 'wali' => 'Ust Syaukani, L.c', 'tingkat' => 'Tingkat 9 (SMP)'],
                    ['kelas' => 'Kelas IV',  'wali' => 'Ustdz Ummi Nur Syarifah, L.c', 'tingkat' => 'Tingkat 10 (SMA)'],
                    ['kelas' => 'Kelas V',   'wali' => 'Ust Rizqi Ardimansyah', 'tingkat' => 'Tingkat 11 (SMA)'],
                    ['kelas' => 'Kelas VI',  'wali' => 'Ummah Hj. Neneng Amalia, M.Pd', 'tingkat' => 'Tingkat 12 (SMA)'],
                ];
            @endphp
            @foreach($waliList as $w)
            <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100 hover:border-emerald-300 transition">
                <span class="text-[10px] text-emerald-700 font-bold block">{{ $w['tingkat'] }}</span>
                <strong class="text-xs text-gray-900 block mt-0.5">{{ $w['kelas'] }}</strong>
                <p class="text-[11px] text-gray-600 mt-1 font-medium">{{ $w['wali'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 🔹 SEKSI KEHADIRAN DI BAWAH JADWAL -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-4 border-b border-gray-100">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-teal-500 animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-teal-700">Akademik & Disiplin</span>
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mt-1 flex items-center gap-2">
                    <span class="iconify text-teal-600 text-2xl" data-icon="mdi:calendar-check-outline"></span>
                    <span>Ringkasan Kehadiran & Presensi Santri</span>
                </h3>
                <p class="text-xs text-gray-500 mt-0.5">
                    Data rekapitulasi absensi kehadiran santri selama mengikuti jadwal pelajaran di atas.
                </p>
            </div>

            <a href="{{ route('user.kehadiran') }}" class="px-4 py-2.5 bg-teal-50 hover:bg-teal-100 text-teal-800 border border-teal-200 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:arrow-right-circle"></span>
                <span>Buka Detail Kehadiran Lengkap</span>
            </a>
        </div>

        <!-- 4 Kotak Ringkasan Presensi -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-teal-50/70 border border-teal-200 p-4 rounded-2xl">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold text-teal-800 uppercase">Tingkat Kehadiran</span>
                    <span class="iconify text-lg text-teal-600" data-icon="mdi:percent-outline"></span>
                </div>
                <div class="text-2xl font-black text-teal-900 mt-1 font-mono">{{ $persentase }}%</div>
                <p class="text-[10px] text-teal-700 mt-0.5 font-bold">✓ Memenuhi Standar</p>
            </div>

            <div class="bg-emerald-50/70 border border-emerald-200 p-4 rounded-2xl">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold text-emerald-800 uppercase">Total Hadir</span>
                    <span class="iconify text-lg text-emerald-600" data-icon="mdi:check-circle"></span>
                </div>
                <div class="text-2xl font-black text-emerald-900 mt-1 font-mono">{{ $totalHadir }} <span class="text-xs font-normal">Hari</span></div>
                <p class="text-[10px] text-emerald-700 mt-0.5">Hadir di kelas</p>
            </div>

            <div class="bg-amber-50/70 border border-amber-200 p-4 rounded-2xl">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold text-amber-800 uppercase">Izin & Sakit</span>
                    <span class="iconify text-lg text-amber-600" data-icon="mdi:email-outline"></span>
                </div>
                <div class="text-2xl font-black text-amber-900 mt-1 font-mono">{{ $totalIzin + $totalSakit }} <span class="text-xs font-normal">Hari</span></div>
                <p class="text-[10px] text-amber-700 mt-0.5">{{ $totalIzin }} Izin, {{ $totalSakit }} Sakit</p>
            </div>

            <div class="bg-gray-50 border border-gray-200 p-4 rounded-2xl">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold text-gray-500 uppercase">Alpa / Tanpa Keterangan</span>
                    <span class="iconify text-lg text-gray-400" data-icon="mdi:close-circle-outline"></span>
                </div>
                <div class="text-2xl font-black text-gray-800 mt-1 font-mono">{{ $totalAlpa }} <span class="text-xs font-normal">Hari</span></div>
                <p class="text-[10px] text-emerald-600 font-bold mt-0.5">Disiplin terjaga</p>
            </div>
        </div>

        <!-- Mini Tabel Riwayat Presensi Terbaru -->
        <div class="overflow-x-auto border border-gray-100 rounded-2xl">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 text-gray-600 uppercase font-bold text-[11px]">
                    <tr>
                        <th class="py-2.5 px-4">Hari & Tanggal</th>
                        <th class="py-2.5 px-4 text-center">Status</th>
                        <th class="py-2.5 px-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($absensiList->take(5) as $ab)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-2.5 px-4 font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($ab->tanggal)->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="py-2.5 px-4 text-center">
                            @if($ab->status == 'Hadir')
                                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[11px]">
                                    ✓ Hadir
                                </span>
                            @elseif($ab->status == 'Izin')
                                <span class="px-2.5 py-0.5 bg-amber-100 text-amber-800 rounded-full font-bold text-[11px]">
                                    Izin
                                </span>
                            @elseif($ab->status == 'Sakit')
                                <span class="px-2.5 py-0.5 bg-blue-100 text-blue-800 rounded-full font-bold text-[11px]">
                                    Sakit
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 bg-red-100 text-red-800 rounded-full font-bold text-[11px]">
                                    Alpa
                                </span>
                            @endif
                        </td>
                        <td class="py-2.5 px-4 text-gray-500 text-[11px]">
                            {{ $ab->keterangan ?: 'Tepat waktu' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-400 italic">Belum ada data presensi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
