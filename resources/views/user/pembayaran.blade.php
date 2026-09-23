@extends('layouts.user')

@section('title', 'Status & Riwayat Pembayaran Santri')

@section('content')
<div class="space-y-6">

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white p-6 rounded-3xl shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                Administrasi & Keuangan Santri
            </span>
            <h1 class="text-2xl font-extrabold mt-2 flex items-center gap-2">
                <span class="iconify" data-icon="mdi:credit-card-check-outline"></span>
                Status Pembayaran Santri
            </h1>
            <p class="text-emerald-100 text-xs mt-1">
                Santri: <strong>{{ $santri->nama_lengkap ?? Auth::user()->name }}</strong> • Semua kewajiban administrasi awal telah tercatat lunas.
            </p>
        </div>
        <button onclick="window.print()" class="px-4 py-2 bg-white text-emerald-800 rounded-xl text-xs font-bold transition hover:bg-emerald-50 shadow-sm flex items-center gap-1.5">
            <span class="iconify text-base" data-icon="mdi:printer"></span> Cetak Kwitansi Pembayaran
        </button>
    </div>

    <!-- Alert Status Lunas Midtrans -->
    <div class="p-5 bg-emerald-50 border-2 border-emerald-500 rounded-2xl shadow-sm flex items-start gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0">
            <span class="iconify text-2xl" data-icon="mdi:check-decagram"></span>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <h3 class="font-extrabold text-emerald-900 text-base">Pembayaran Pendaftaran Online (Midtrans) Telah Lunas</h3>
                <span class="px-3 py-1 bg-emerald-600 text-white font-mono font-bold text-xs rounded-full">
                    SETTLEMENT (LUNAS)
                </span>
            </div>
            <p class="text-xs text-emerald-700 mt-1">
                Transaksi biaya pendaftaran santri baru sebesar <strong>Rp 200.000</strong> telah berhasil diverifikasi oleh sistem payment gateway Midtrans dan Bendahara Pondok Pesantren Al-Fattah.
            </p>
            <div class="mt-3 grid grid-cols-2 sm:grid-cols-4 gap-3 bg-white p-3 rounded-xl border border-emerald-200 text-xs font-mono">
                <div>
                    <span class="text-gray-400 block text-[10px]">Order ID:</span>
                    <strong>{{ $pendaftar->order_id ?? 'PSB-'.time() }}</strong>
                </div>
                <div>
                    <span class="text-gray-400 block text-[10px]">Metode:</span>
                    <strong class="text-emerald-700">QRIS / VA Bank</strong>
                </div>
                <div>
                    <span class="text-gray-400 block text-[10px]">Nominal:</span>
                    <strong class="text-green-700">Rp 200.000</strong>
                </div>
                <div>
                    <span class="text-gray-400 block text-[10px]">Waktu Bayar:</span>
                    <strong>{{ $pendaftar && $pendaftar->created_at ? $pendaftar->created_at->format('d/m/Y H:i') : now()->format('d/m/Y') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Biaya Santri Baru -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-base">Rincian Paket Administrasi Santri Baru</h3>
            <span class="text-xs text-gray-400">Tahun Ajaran 2026/2027</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 font-bold uppercase text-xs">
                    <tr>
                        <th class="py-3.5 px-4">No</th>
                        <th class="py-3.5 px-4">Komponen Pembayaran</th>
                        <th class="py-3.5 px-4 text-center">Periode</th>
                        <th class="py-3.5 px-4 text-right">Nominal</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    <tr class="hover:bg-gray-50">
                        <td class="py-3.5 px-4 font-mono text-gray-400">1</td>
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-gray-900">Biaya Formulir & Seleksi PSB Online</div>
                            <div class="text-[11px] text-gray-500">Payment Gateway Midtrans Gateway</div>
                        </td>
                        <td class="py-3.5 px-4 text-center text-xs text-gray-500">Pendaftaran Awal</td>
                        <td class="py-3.5 px-4 text-right font-mono font-bold text-gray-800">Rp 200.000</td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                Lunas (Midtrans)
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3.5 px-4 font-mono text-gray-400">2</td>
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-gray-900">Seragam Santri & Atribut Pesantren (4 Stel)</div>
                            <div class="text-[11px] text-gray-500">Putih Abu/Biru, Pramuka, Koko/Gamis, Olahraga</div>
                        </td>
                        <td class="py-3.5 px-4 text-center text-xs text-gray-500">Sekali Bayar</td>
                        <td class="py-3.5 px-4 text-right font-mono font-bold text-gray-800">Rp 650.000</td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                Lunas Terverifikasi
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3.5 px-4 font-mono text-gray-400">3</td>
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-gray-900">Kitab Pesantren & Modul Pembelajaran Semester Ganjil</div>
                            <div class="text-[11px] text-gray-500">Paket Kitab Kuning & Buku Pegangan Santri</div>
                        </td>
                        <td class="py-3.5 px-4 text-center text-xs text-gray-500">Semester 1</td>
                        <td class="py-3.5 px-4 text-right font-mono font-bold text-gray-800">Rp 350.000</td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                Lunas Terverifikasi
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3.5 px-4 font-mono text-gray-400">4</td>
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-gray-900">SPP & Makan Asrama Bulan Pertama (Juli 2026)</div>
                            <div class="text-[11px] text-gray-500">Biaya pendidikan bulanan + makan asrama 3x sehari</div>
                        </td>
                        <td class="py-3.5 px-4 text-center text-xs text-gray-500">Juli 2026</td>
                        <td class="py-3.5 px-4 text-right font-mono font-bold text-gray-800">Rp 500.000</td>
                        <td class="py-3.5 px-4 text-center">
                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                Lunas (Bebas Biaya)
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
