@extends('kepsek.layouts.app')

@section('title', 'Laporan Penerimaan Santri Baru (PPDB)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-emerald-600 text-2xl" data-icon="mdi:account-school-outline"></span>
                <span>Laporan PPDB Online</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Monitoring pendaftaran calon santri baru Pondok Pesantren Al-Fattah.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('kepsek.laporan.exportExcel') }}" class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                <span class="iconify" data-icon="mdi:file-excel"></span> Export Excel
            </a>
            <a href="{{ route('kepsek.laporan.exportPdf') }}" target="_blank" class="px-3.5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                <span class="iconify" data-icon="mdi:file-pdf-box"></span> Export PDF
            </a>
        </div>
    </div>

    <!-- 3 Mini Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200">
            <span class="text-[10px] font-bold text-gray-400 uppercase">Total Pendaftar Masuk</span>
            <div class="text-2xl font-black text-gray-800 mt-1">{{ $totalSemua }}</div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-gray-200">
            <span class="text-[10px] font-bold text-green-600 uppercase">Lolos Verifikasi Dokumen</span>
            <div class="text-2xl font-black text-green-700 mt-1">{{ $totalLulus }}</div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-gray-200">
            <span class="text-[10px] font-bold text-emerald-600 uppercase">Lunas Biaya Pendaftaran</span>
            <div class="text-2xl font-black text-emerald-700 mt-1">{{ $totalLunas }}</div>
        </div>
    </div>

    <!-- Tabel Data Pendaftar -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-500 font-bold uppercase">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">Jenjang</th>
                        <th class="py-3 px-4">Kontak / Email</th>
                        <th class="py-3 px-4 text-center">Status Berkas</th>
                        <th class="py-3 px-4 text-center">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pendaftars as $index => $p)
                    <tr class="hover:bg-gray-50/80">
                        <td class="py-3 px-4 font-mono text-gray-400">{{ $pendaftars->firstItem() + $index }}</td>
                        <td class="py-3 px-4 font-bold text-gray-800">{{ $p->nama }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $p->jenjang ?? 'Pesantren' }}</td>
                        <td class="py-3 px-4 text-gray-500">
                            <div>{{ $p->no_hp ?: '-' }}</div>
                            <div class="text-[10px] text-gray-400">{{ $p->email }}</div>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if(in_array($p->status, ['Terverifikasi', 'lulus']))
                                <span class="px-2.5 py-0.5 bg-green-100 text-green-700 rounded-full font-bold text-[10px]">Terverifikasi</span>
                            @elseif(in_array($p->status, ['Ditolak', 'gagal']))
                                <span class="px-2.5 py-0.5 bg-red-100 text-red-700 rounded-full font-bold text-[10px]">Ditolak</span>
                            @else
                                <span class="px-2.5 py-0.5 bg-yellow-100 text-yellow-700 rounded-full font-bold text-[10px]">Dalam Proses</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($p->status_bayar == 'settlement')
                                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">Lunas</span>
                            @else
                                <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-full font-bold text-[10px]">Belum Bayar</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-400 italic">Belum ada data pendaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $pendaftars->links() }}
        </div>
    </div>
</div>
@endsection
