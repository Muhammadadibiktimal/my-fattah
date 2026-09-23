@extends('layouts.user')

@section('title', 'Jadwal Pelajaran & Kelas')

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white p-6 rounded-3xl shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                Jadwal Belajar Mengajar
            </span>
            <h1 class="text-2xl font-extrabold mt-2 flex items-center gap-2">
                <span class="iconify" data-icon="mdi:calendar-clock"></span>
                Jadwal Pelajaran: {{ $kelas ? 'Kelas ' . $kelas->nama_kelas : 'Kelas 7A' }}
            </h1>
            <p class="text-emerald-100 text-xs mt-1">
                Tahun Ajaran 2026/2027 • Wali Kelas: <strong>{{ $kelas->wali_kelas ?? 'Ustadz Ahmad Fauzi, S.Pd.I' }}</strong>
            </p>
        </div>
        <a href="{{ route('user.dashboard') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5">
            ← Kembali ke Dashboard
        </a>
    </div>

    <!-- Informasi Kelas & Rombel Card -->
    <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 font-extrabold flex items-center justify-center text-lg">
                {{ $kelas ? $kelas->nama_kelas : '7A' }}
            </div>
            <div>
                <h3 class="font-bold text-gray-800 text-base">Rombongan Belajar {{ $kelas ? $kelas->nama_kelas : 'Kelas 7A' }}</h3>
                <p class="text-xs text-gray-500">Tingkat Pendidikan: Kelas {{ $kelas->tingkat ?? '7' }} • Kurikulum Terpadu Pesantren</p>
            </div>
        </div>

        <div class="flex items-center gap-3 text-xs">
            <div class="px-3 py-1.5 bg-gray-50 border rounded-xl">
                <span class="text-gray-400 block">Wali Kelas</span>
                <strong class="text-gray-800">{{ $kelas->wali_kelas ?? 'Ustadz Ahmad Fauzi, S.Pd.I' }}</strong>
            </div>
            <div class="px-3 py-1.5 bg-gray-50 border rounded-xl">
                <span class="text-gray-400 block">Status Santri</span>
                <strong class="text-emerald-600">Aktif Belajar</strong>
            </div>
        </div>
    </div>

    <!-- Jadwal Mingguan Grid (Senin s/d Sabtu) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        
        <!-- SENIN -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-emerald-700 text-white px-4 py-3 flex items-center justify-between font-bold text-xs uppercase tracking-wider">
                <span>Senin</span>
                <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded">07.30 - 14.30</span>
            </div>
            <div class="p-4 space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">07.30 - 09.00</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Al-Qur'an & Tahfidz</div>
                    <div class="text-[11px] text-gray-500">Ustadz Ahmad Fauzi, S.Pd.I</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">09.30 - 11.30</span>
                        <span class="text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Bahasa Arab (Nahwu Shorof)</div>
                    <div class="text-[11px] text-gray-500">Ustadzah Siti Aminah, S.Pd.</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">13.00 - 14.30</span>
                        <span class="text-[10px] bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded font-bold">Lab Komputer</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Matematika & Logika</div>
                    <div class="text-[11px] text-gray-500">Ustadz Hasan Basri, Lc.</div>
                </div>
            </div>
        </div>

        <!-- SELASA -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-green-700 text-white px-4 py-3 flex items-center justify-between font-bold text-xs uppercase tracking-wider">
                <span>Selasa</span>
                <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded">07.30 - 14.30</span>
            </div>
            <div class="p-4 space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">07.30 - 09.00</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Fiqih Ibadah & Muamalah</div>
                    <div class="text-[11px] text-gray-500">Ustadz Hasan Basri, Lc.</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">09.30 - 11.30</span>
                        <span class="text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Akidah Akhlak</div>
                    <div class="text-[11px] text-gray-500">Ustadz Ahmad Fauzi, S.Pd.I</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">13.00 - 14.30</span>
                        <span class="text-[10px] bg-purple-100 text-purple-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Bahasa Indonesia</div>
                    <div class="text-[11px] text-gray-500">Ustadzah Siti Aminah, S.Pd.</div>
                </div>
            </div>
        </div>

        <!-- RABU -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-emerald-700 text-white px-4 py-3 flex items-center justify-between font-bold text-xs uppercase tracking-wider">
                <span>Rabu</span>
                <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded">07.30 - 14.30</span>
            </div>
            <div class="p-4 space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">07.30 - 09.00</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Sejarah Kebudayaan Islam (SKI)</div>
                    <div class="text-[11px] text-gray-500">Ustadzah Siti Aminah, S.Pd.</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">09.30 - 11.30</span>
                        <span class="text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded font-bold">Lab Sains</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Ilmu Pengetahuan Alam (IPA)</div>
                    <div class="text-[11px] text-gray-500">Ustadz Hasan Basri, Lc.</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">13.00 - 14.30</span>
                        <span class="text-[10px] bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded font-bold">Masjid</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Halaqah Tahfidz Sore</div>
                    <div class="text-[11px] text-gray-500">Dewan Pengasuh Asrama</div>
                </div>
            </div>
        </div>

        <!-- KAMIS -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-green-700 text-white px-4 py-3 flex items-center justify-between font-bold text-xs uppercase tracking-wider">
                <span>Kamis</span>
                <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded">07.30 - 14.30</span>
            </div>
            <div class="p-4 space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">07.30 - 09.00</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Bahasa Inggris (English Islamic Club)</div>
                    <div class="text-[11px] text-gray-500">Ustadzah Siti Aminah, S.Pd.</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">09.30 - 11.30</span>
                        <span class="text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded font-bold">Ruang 1</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Hadits Arbain Nawawi</div>
                    <div class="text-[11px] text-gray-500">Ustadz Ahmad Fauzi, S.Pd.I</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">13.00 - 14.30</span>
                        <span class="text-[10px] bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded font-bold">Aula Utama</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Muhadharah / Latihan Pidato</div>
                    <div class="text-[11px] text-gray-500">Pengurus Santri</div>
                </div>
            </div>
        </div>

        <!-- JUMAT -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-emerald-700 text-white px-4 py-3 flex items-center justify-between font-bold text-xs uppercase tracking-wider">
                <span>Jum'at Berkah</span>
                <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded">07.30 - 11.00</span>
            </div>
            <div class="p-4 space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">07.30 - 08.30</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">Lapangan</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Senam Pagi & Kebersihan Asrama</div>
                    <div class="text-[11px] text-gray-500">Seluruh Santri & Pembina</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">08.30 - 10.30</span>
                        <span class="text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded font-bold">Masjid</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Kajian Kitab Kuning (Ta'lim Muta'allim)</div>
                    <div class="text-[11px] text-gray-500">K.H. Pimpinan Pesantren</div>
                </div>
            </div>
        </div>

        <!-- SABTU -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="bg-green-700 text-white px-4 py-3 flex items-center justify-between font-bold text-xs uppercase tracking-wider">
                <span>Sabtu</span>
                <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded">07.30 - 14.30</span>
            </div>
            <div class="p-4 space-y-3">
                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">07.30 - 09.30</span>
                        <span class="text-[10px] bg-purple-100 text-purple-800 px-1.5 py-0.5 rounded font-bold">Lab Multimedia</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Teknologi & Multimedia Kreatif</div>
                    <div class="text-[11px] text-gray-500">Ustadz Hasan Basri, Lc.</div>
                </div>

                <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-[10px] text-emerald-700 font-bold font-mono">10.00 - 12.00</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">Lapangan</span>
                    </div>
                    <div class="font-bold text-xs text-gray-800">Ekstrakurikuler (Pramuka / Silat)</div>
                    <div class="text-[11px] text-gray-500">Instruktur Ekstrakurikuler</div>
                </div>
            </div>
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
