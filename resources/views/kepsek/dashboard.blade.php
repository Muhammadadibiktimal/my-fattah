@extends('kepsek.layouts.app')

@section('title', 'Laporan Ringkasan Eksekutif PSB')

@section('content')
<div class="space-y-8">
    <!-- Header Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-green-900 text-white rounded-3xl p-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-yellow-400/10 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <span class="px-3.5 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                    Laporan Eksekutif Real-time
                </span>
                <h1 class="text-3xl font-extrabold mt-3">
                    Selamat Datang, {{ Auth::user()->name }}
                </h1>
                <p class="text-slate-300 text-sm mt-1">
                    Berikut statistik & perkembangan pendaftaran calon santri baru Pondok Pesantren Al-Fattah.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('kepsek.laporan.exportExcel') }}" class="px-5 py-3 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold rounded-xl shadow-lg transition flex items-center gap-2 text-sm">
                    <span class="iconify text-lg" data-icon="mdi:file-excel"></span>
                    Download Laporan Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Cards Stats Ringkasan Laporan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pendaftar -->
        <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <span class="iconify text-2xl" data-icon="mdi:account-group"></span>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Masuk</span>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalPendaftar }}</h3>
            <p class="text-xs text-gray-500 mt-1">Santri mendaftar</p>
        </div>

        <!-- Diterima / Lulus -->
        <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center">
                    <span class="iconify text-2xl" data-icon="mdi:check-circle-outline"></span>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Lulus / Diterima</span>
            </div>
            <h3 class="text-3xl font-extrabold text-green-600">{{ $pendaftarLulus }}</h3>
            <p class="text-xs text-gray-500 mt-1">Santri lolos seleksi</p>
        </div>

        <!-- Dalam Proses -->
        <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-yellow-100 text-yellow-600 flex items-center justify-center">
                    <span class="iconify text-2xl" data-icon="mdi:clock-outline"></span>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Proses Verifikasi</span>
            </div>
            <h3 class="text-3xl font-extrabold text-yellow-600">{{ $pendaftarProses }}</h3>
            <p class="text-xs text-gray-500 mt-1">Verifikasi dokumen</p>
        </div>

        <!-- Tidak Lulus -->
        <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center">
                    <span class="iconify text-2xl" data-icon="mdi:close-circle-outline"></span>
                </div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Belum Lolos</span>
            </div>
            <h3 class="text-3xl font-extrabold text-red-600">{{ $pendaftarGagal }}</h3>
            <p class="text-xs text-gray-500 mt-1">Batal / Gugur</p>
        </div>
    </div>

    <!-- Tabel Preview Laporan Pendaftar Terbaru -->
    <div class="bg-white rounded-3xl p-8 shadow-md border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Preview Pendaftar Terbaru</h3>
                <p class="text-sm text-gray-500">Data 5 pendaftar terkini yang mendaftar ke sistem.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Santri</th>
                        <th class="py-3 px-4">Jenjang</th>
                        <th class="py-3 px-4">No. HP Wali</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($pendaftarTerbaru as $p)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3.5 px-4 font-semibold text-gray-800">{{ $p->nama_lengkap ?? $p->nama }}</td>
                            <td class="py-3.5 px-4"><span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold">{{ strtoupper($p->jenjang ?? 'SMP') }}</span></td>
                            <td class="py-3.5 px-4 text-gray-600">{{ $p->no_hp ?? '-' }}</td>
                            <td class="py-3.5 px-4">
                                @if($p->status == 'lulus')
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">LULUS</span>
                                @elseif($p->status == 'gagal')
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">TIDAK LULUS</span>
                                @else
                                    <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">DALAM PROSES</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-gray-500 text-xs">{{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500 italic">Belum ada data pendaftar masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
