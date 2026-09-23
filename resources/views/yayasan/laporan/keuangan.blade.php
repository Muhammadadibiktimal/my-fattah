@extends('yayasan.layouts.app')

@section('title', 'Laporan Keuangan & Pembayaran Midtrans')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-gray-900 flex items-center gap-2">
                <span class="iconify text-amber-500 text-2xl" data-icon="mdi:cash-multiple"></span>
                <span>Laporan Keuangan & Transaksi Payment Gateway Midtrans</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Rekapitulasi penerimaan biaya formulir pendaftaran santri baru melalui Midtrans.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak</span>
            </button>
            <a href="{{ route('yayasan.laporan.cetak', 'keuangan') }}" class="px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- Ringkasan Keuangan Card -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-emerald-700 to-green-800 text-white p-5 rounded-2xl shadow-md">
            <span class="text-xs uppercase font-bold text-emerald-200 block">Total Dana Masuk (Settlement)</span>
            <div class="text-3xl font-black mt-1 font-mono">Rp {{ number_format($totalDanaMasuk, 0, ',', '.') }}</div>
            <p class="text-[11px] text-emerald-100 mt-1">{{ $totalLunas }} Transaksi Berhasil Masuk Rekening Yayasan</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-xs uppercase font-bold text-gray-400 block">Potensi Pembayaran Tertunda</span>
            <div class="text-2xl font-black text-amber-600 mt-1 font-mono">Rp {{ number_format($totalPotensiPending, 0, ',', '.') }}</div>
            <p class="text-[11px] text-gray-500 mt-1">{{ $totalPending }} Tagihan Menunggu Pembayaran</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <span class="text-xs uppercase font-bold text-gray-400 block">Tarif Biaya Formulir PSB</span>
            <div class="text-2xl font-black text-gray-800 mt-1 font-mono">Rp 200.000 <span class="text-xs font-normal">/ santri</span></div>
            <p class="text-[11px] text-gray-500 mt-1">Midtrans Snap Gateway (BCA/Mandiri/BRI/QRIS)</p>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
        <form method="GET" action="{{ route('yayasan.laporan.keuangan') }}" class="flex flex-wrap items-center gap-3">
            <select name="status_bayar" onchange="this.form.submit()" class="border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-amber-500">
                <option value="">-- Semua Status Transaksi --</option>
                <option value="settlement" {{ $statusBayar == 'settlement' ? 'selected' : '' }}>Lunas (Settlement)</option>
                <option value="pending" {{ $statusBayar == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>

            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari Order ID / Nama Santri..."
                       class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition">
                Cari Transaksi
            </button>

            @if($statusBayar || $search)
                <a href="{{ route('yayasan.laporan.keuangan') }}" class="text-xs text-gray-400 hover:underline">
                    Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Rincian Transaksi Keuangan -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Order ID Transaksi</th>
                        <th class="py-3.5 px-4">Waktu Transaksi</th>
                        <th class="py-3.5 px-4">Nama Calon Santri</th>
                        <th class="py-3.5 px-4">Jenjang Pendidikan</th>
                        <th class="py-3.5 px-4 text-right">Nominal (IDR)</th>
                        <th class="py-3.5 px-4 text-center">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($transaksiList as $t)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 font-mono font-bold text-gray-900">
                            {{ $t->order_id }}
                        </td>
                        <td class="py-3 px-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($t->created_at)->translatedFormat('d F Y, H:i') }} WIB
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-900 block text-sm">{{ $t->nama }}</span>
                            <span class="text-[11px] text-gray-500 font-mono">{{ $t->email }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-emerald-800">{{ $t->jenjang }}</span>
                            <span class="text-gray-400 block text-[10px]">{{ $t->jurusan ?? 'Reguler' }}</span>
                        </td>
                        <td class="py-3 px-4 text-right font-mono font-bold text-gray-900 text-sm">
                            Rp 200.000
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($t->status_bayar == 'settlement')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full font-bold text-[10px]">
                                    ✓ SETTLEMENT (LUNAS)
                                </span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full font-bold text-[10px]">
                                    PENDING
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400 italic">
                            Belum ada riwayat transaksi keuangan yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transaksiList->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $transaksiList->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
