@extends('yayasan.layouts.app')

@section('title', 'Laporan Penerimaan Santri Baru (PPDB)')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-emerald-600 text-2xl" data-icon="mdi:account-school-outline"></span>
                <span>Laporan Penerimaan Santri Baru (PPDB Online)</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Data calon santri baru yang mendaftar melalui portal pendaftaran Pondok Pesantren Al-Fattah.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak</span>
            </button>
            <a href="{{ route('yayasan.laporan.cetak', 'pendaftar') }}" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
                <span class="iconify text-2xl" data-icon="mdi:account-group"></span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase">Total Pendaftar</p>
                <p class="text-2xl font-black text-gray-900 font-mono">{{ $totalSemua }} <span class="text-xs font-normal">Santri</span></p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg">
                <span class="iconify text-2xl" data-icon="mdi:cash-check"></span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase">Lunas Midtrans</p>
                <p class="text-2xl font-black text-emerald-700 font-mono">{{ $totalLunas }} <span class="text-xs font-normal">Santri</span></p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg">
                <span class="iconify text-2xl" data-icon="mdi:check-decagram"></span>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase">Berkas Terverifikasi</p>
                <p class="text-2xl font-black text-purple-700 font-mono">{{ $totalVerif }} <span class="text-xs font-normal">Santri</span></p>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('yayasan.laporan.pendaftar') }}" class="flex flex-wrap items-center gap-3">
            <select name="jenjang" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">-- Semua Jenjang --</option>
                <option value="SMP" {{ $jenjang == 'SMP' ? 'selected' : '' }}>SMP Al-Fattah</option>
                <option value="SMA" {{ $jenjang == 'SMA' ? 'selected' : '' }}>SMA Al-Fattah</option>
                <option value="SMK" {{ $jenjang == 'SMK' ? 'selected' : '' }}>SMK Al-Fattah</option>
            </select>

            <select name="status_bayar" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">-- Status Pembayaran --</option>
                <option value="settlement" {{ $statusBayar == 'settlement' ? 'selected' : '' }}>Lunas (Settlement)</option>
                <option value="pending" {{ $statusBayar == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>

            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-emerald-500">
                <option value="">-- Status Berkas --</option>
                <option value="Terverifikasi" {{ $status == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Ditolak" {{ $status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>

            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari Nama / Email / Order ID..."
                       class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition">
                Filter
            </button>

            @if($jenjang || $statusBayar || $status || $search)
                <a href="{{ route('yayasan.laporan.pendaftar') }}" class="text-xs text-gray-400 hover:underline">
                    Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Data Laporan PPDB -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Order ID / Tanggal</th>
                        <th class="py-3.5 px-4">Nama Calon Santri</th>
                        <th class="py-3.5 px-4">Jenjang & Jurusan</th>
                        <th class="py-3.5 px-4">Asal Sekolah</th>
                        <th class="py-3.5 px-4">Kontak / Wali</th>
                        <th class="py-3.5 px-4 text-center">Status Bayar</th>
                        <th class="py-3.5 px-4 text-center">Status Berkas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($pendaftars as $p)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4">
                            <span class="font-mono font-bold text-gray-900 block">{{ $p->order_id }}</span>
                            <span class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d/m/Y H:i') }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-900 text-sm block">{{ $p->nama }}</span>
                            <span class="text-[11px] text-gray-500 font-mono">NISN: {{ $p->nisn ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-emerald-800 block">{{ $p->jenjang }}</span>
                            <span class="text-[11px] text-gray-600">{{ $p->jurusan ?? 'Reguler' }}</span>
                        </td>
                        <td class="py-3 px-4 text-gray-700">
                            {{ $p->asal_sekolah ?? '-' }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-semibold text-gray-800 block">{{ $p->no_hp }}</span>
                            <span class="text-[10px] text-gray-400">Ortu: {{ $p->nama_ayah ?? $p->nama_ibu ?? '-' }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($p->status_bayar == 'settlement')
                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">
                                    LUNAS (Rp 200rb)
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-amber-100 text-amber-800 rounded-full font-bold text-[10px]">
                                    PENDING
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($p->status == 'Terverifikasi')
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full font-bold text-[10px]">
                                    Terverifikasi
                                </span>
                            @elseif($p->status == 'Ditolak')
                                <span class="px-2.5 py-1 bg-red-100 text-red-800 rounded-full font-bold text-[10px]">
                                    Ditolak
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full font-bold text-[10px]">
                                    Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-400 italic">
                            Tidak ada data pendaftar yang cocok dengan filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pendaftars->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $pendaftars->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
