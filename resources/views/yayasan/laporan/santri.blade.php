@extends('yayasan.layouts.app')

@section('title', 'Laporan Data Santri & Kenaikan Kelas')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-blue-600 text-2xl" data-icon="mdi:account-school"></span>
                <span>Laporan Data Induk Santri & Status Kenaikan Kelas</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Monitoring seluruh santri aktif, rombongan belajar, dan keputusan rapat kenaikan/kelulusan kelas.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak</span>
            </button>
            <a href="{{ route('yayasan.laporan.cetak', 'santri') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- 4 Metrik Status Kenaikan -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Total Santri Aktif</span>
            <div class="text-2xl font-black text-gray-900 mt-1 font-mono">{{ $totalSantri }}</div>
            <p class="text-[10px] text-gray-400 mt-0.5">Tersebar di 18 Rombel</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Naik Kelas</span>
            <div class="text-2xl font-black text-emerald-600 mt-1 font-mono">{{ $totalNaik }}</div>
            <p class="text-[10px] text-emerald-700 font-bold mt-0.5">Memenuhi KKM & Disiplin</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Tinggal Kelas</span>
            <div class="text-2xl font-black text-amber-600 mt-1 font-mono">{{ $totalTinggal }}</div>
            <p class="text-[10px] text-amber-700 font-bold mt-0.5">Perlu bimbingan khusus</p>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">Lulus / Alumni</span>
            <div class="text-2xl font-black text-blue-600 mt-1 font-mono">{{ $totalLulus }}</div>
            <p class="text-[10px] text-blue-700 font-bold mt-0.5">Selesai masa studi</p>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('yayasan.laporan.santri') }}" class="flex flex-wrap items-center gap-3">
            <select name="kelas_id" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Kelas --</option>
                @foreach($kelasList as $k)
                    <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>
                        Kelas {{ $k->nama_kelas }} (Tingkat {{ $k->tingkat }})
                    </option>
                @endforeach
            </select>

            <select name="status_kenaikan" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Status Kenaikan --</option>
                <option value="Naik Kelas" {{ $statusKenaikan == 'Naik Kelas' ? 'selected' : '' }}>Naik Kelas</option>
                <option value="Tinggal Kelas" {{ $statusKenaikan == 'Tinggal Kelas' ? 'selected' : '' }}>Tinggal Kelas</option>
                <option value="Lulus" {{ $statusKenaikan == 'Lulus' ? 'selected' : '' }}>Lulus / Alumni</option>
            </select>

            <select name="jenjang" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Jenjang Sekolah --</option>
                <option value="SMP" {{ $jenjang == 'SMP' ? 'selected' : '' }}>SMP Al-Fattah</option>
                <option value="SMA" {{ $jenjang == 'SMA' ? 'selected' : '' }}>SMA Al-Fattah</option>
                <option value="SMK" {{ $jenjang == 'SMK' ? 'selected' : '' }}>SMK Al-Fattah</option>
            </select>

            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari Nama Santri / NISN..."
                       class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition">
                Filter
            </button>

            @if($kelasId || $statusKenaikan || $jenjang || $search)
                <a href="{{ route('yayasan.laporan.santri') }}" class="text-xs text-gray-400 hover:underline">
                    Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Data Santri -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">NISN</th>
                        <th class="py-3.5 px-4">Nama Lengkap Santri</th>
                        <th class="py-3.5 px-4">Jenjang & Jurusan</th>
                        <th class="py-3.5 px-4">Kelas / Rombel</th>
                        <th class="py-3.5 px-4">Wali Kelas</th>
                        <th class="py-3.5 px-4 text-center">Status Kenaikan</th>
                        <th class="py-3.5 px-4">Catatan Pleno Guru</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($santris as $s)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 font-mono font-bold text-gray-700">{{ $s->nisn ?? '-' }}</td>
                        <td class="py-3 px-4 font-semibold text-gray-900">
                            <span class="text-sm font-bold text-gray-900 block">{{ $s->nama_lengkap }}</span>
                            <span class="text-[11px] text-gray-400">{{ $s->jenis_kelamin }} • {{ $s->no_hp ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-emerald-800 block">{{ $s->jenjang ?? 'Pesantren' }}</span>
                            <span class="text-[11px] text-gray-600">{{ $s->jurusan ?? 'Reguler' }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2.5 py-1 bg-green-50 text-green-800 border border-green-200 font-bold rounded-lg text-xs">
                                {{ $s->kelas ? 'Kelas ' . $s->kelas->nama_kelas : 'Belum Ditentukan' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-600">
                            {{ $s->kelas->wali_kelas ?? '-' }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($s->status_kenaikan == 'Naik Kelas')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">
                                    ✓ Naik Kelas
                                </span>
                            @elseif($s->status_kenaikan == 'Tinggal Kelas')
                                <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full font-bold text-[10px]">
                                    Tinggal Kelas
                                </span>
                            @elseif($s->status_kenaikan == 'Lulus' || $s->status == 'Alumni')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-bold text-[10px]">
                                    Lulus / Alumni
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full font-bold text-[10px]">
                                    {{ $s->status_kenaikan ?: 'Aktif' }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-500 max-w-xs text-[11px]">
                            {{ $s->catatan_kenaikan ?: 'Memenuhi standar KKM semester genap.' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-400 italic">
                            Tidak ada data santri yang sesuai filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($santris->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $santris->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
