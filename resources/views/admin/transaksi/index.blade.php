@extends('admin.layouts.app')

@section('title', 'Transaksi Pembayaran Midtrans')

@section('content')
<div class="space-y-6">

    <!-- Header & Ringkasan -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600 text-3xl" data-icon="mdi:credit-card-fast-outline"></span>
                <span>Data Pembayaran Midtrans (PSB Online)</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">Kelola dan pantau seluruh transaksi pembayaran pendaftaran santri baru melalui Midtrans Snap.</p>
        </div>

        <!-- Filter Status -->
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.transaksi.index') }}"
               class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ !$status || $status == 'all' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
               Semua ({{ $totalTransaksi }})
            </a>
            <a href="{{ route('admin.transaksi.index', ['status' => 'settlement']) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $status == 'settlement' ? 'bg-green-600 text-white' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
               Lunas ({{ $totalLunas }})
            </a>
            <a href="{{ route('admin.transaksi.index', ['status' => 'pending']) }}"
               class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $status == 'pending' ? 'bg-yellow-600 text-white' : 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100' }}">
               Pending ({{ $totalPending }})
            </a>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-5 text-white shadow-lg shadow-green-500/10">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-green-100">Total Pemasukan PSB</p>
                    <h3 class="text-2xl font-extrabold mt-1">Rp {{ number_format($nominalLunas, 0, ',', '.') }}</h3>
                </div>
                <div class="p-3 bg-white/20 rounded-xl">
                    <span class="iconify text-2xl text-white" data-icon="mdi:cash-multiple"></span>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Pembayaran Sukses</p>
                    <h3 class="text-2xl font-extrabold text-green-600 mt-1">{{ $totalLunas }} Santri</h3>
                </div>
                <div class="p-3 bg-green-50 rounded-xl">
                    <span class="iconify text-2xl text-green-600" data-icon="mdi:check-decagram"></span>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Menunggu Pembayaran</p>
                    <h3 class="text-2xl font-extrabold text-yellow-600 mt-1">{{ $totalPending }} Transaksi</h3>
                </div>
                <div class="p-3 bg-yellow-50 rounded-xl">
                    <span class="iconify text-2xl text-yellow-600" data-icon="mdi:clock-outline"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Sukses Akun Dibuat -->
    @if(session('akun_created'))
        <div class="bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-6 shadow-md">
            <div class="flex items-start gap-4">
                <div class="p-2 bg-emerald-500 text-white rounded-xl">
                    <span class="iconify text-3xl" data-icon="mdi:account-check"></span>
                </div>
                <div class="flex-1">
                    <h4 class="text-lg font-bold text-emerald-900">🎉 Akun Santri Berhasil Dibuatkan!</h4>
                    <p class="text-sm text-emerald-700 mt-1">Kredensial login berikut dapat langsung diberikan kepada calon santri:</p>
                    <div class="mt-3 bg-white p-4 rounded-xl border border-emerald-200 space-y-2 font-mono text-sm max-w-md">
                        <div><strong>Nama :</strong> {{ session('akun_created')['nama'] }}</div>
                        <div><strong>Email:</strong> <span class="text-blue-600 select-all">{{ session('akun_created')['email'] }}</span></div>
                        <div><strong>Password:</strong> <span class="text-red-600 font-bold select-all">{{ session('akun_created')['password'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded-xl border border-green-200 font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Transaksi -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                    <tr>
                        <th class="py-3.5 px-4 text-left">Order ID</th>
                        <th class="py-3.5 px-4 text-left">Nama Pendaftar</th>
                        <th class="py-3.5 px-4 text-left">Kontak (Email / No HP)</th>
                        <th class="py-3.5 px-4 text-left">Nominal</th>
                        <th class="py-3.5 px-4 text-center">Status Pembayaran</th>
                        <th class="py-3.5 px-4 text-center">Aksi / Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($transaksi as $item)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-3.5 px-4 font-mono font-semibold text-gray-800">
                                {{ $item->order_id }}
                                <div class="text-[11px] text-gray-400 font-normal">
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-gray-800">
                                {{ $item->nama }}
                            </td>
                            <td class="py-3.5 px-4 text-gray-600">
                                <div>{{ $item->email }}</div>
                                <div class="text-xs text-gray-400">{{ $item->no_hp }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-gray-800">
                                Rp 200.000
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($item->status_bayar === 'settlement')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                        <span class="iconify" data-icon="mdi:check-circle"></span> Lunas (Settlement)
                                    </span>
                                @elseif($item->status_bayar === 'pending')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">
                                        <span class="iconify" data-icon="mdi:clock-alert"></span> Menunggu (Pending)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">
                                        {{ ucfirst($item->status_bayar) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Jika masih pending, bisa manual lunas & buat akun -->
                                    @if($item->status_bayar !== 'settlement')
                                        <form action="{{ route('admin.transaksi.manualLunas', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Konfirmasi pembayaran order ini lunas dan otomatis buatkan akun santri?')">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                                                <span class="iconify" data-icon="mdi:check-all"></span> Set Lunas & Buat Akun
                                            </button>
                                        </form>
                                    @else
                                        <!-- Tombol Buatkan / Reset Akun Santri -->
                                        <form action="{{ route('admin.pendaftar.buatAkun', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Buatkan / Reset Akun login santri ini?')">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                                                <span class="iconify" data-icon="mdi:account-key"></span> Generate Akun Santri
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-400 italic">
                                Belum ada transaksi pembayaran Midtrans yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transaksi->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $transaksi->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
