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
                Santri: <strong>{{ $santri->nama_lengkap ?? Auth::user()->name }}</strong> • Status Registrasi & Pembayaran Online
            </p>
        </div>
        @if($pendaftar && $pendaftar->status_bayar == 'settlement')
            <button onclick="window.print()" class="px-4 py-2 bg-white text-emerald-800 rounded-xl text-xs font-bold transition hover:bg-emerald-50 shadow-sm flex items-center gap-1.5">
                <span class="iconify text-base" data-icon="mdi:printer"></span> Cetak Kwitansi Pembayaran
            </button>
        @endif
    </div>

    @php
        $statusVerifikasi = $pendaftar->status ?? 'Pending';
        $statusBayar = $pendaftar->status_bayar ?? 'pending';
        $isApproved = ($statusVerifikasi == 'Terverifikasi' || $statusVerifikasi == 'lulus');
        $isLunas = ($statusBayar == 'settlement');
    @endphp

    {{-- KONDISI 1: BERKAS PENDING (BELUM APPROVED ADMIN) --}}
    @if(!$isApproved && !$isLunas)
        <div class="p-6 bg-yellow-50 border-2 border-yellow-400 rounded-2xl shadow-sm flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-yellow-500 text-white flex items-center justify-center flex-shrink-0 shadow-md">
                <span class="iconify text-2xl" data-icon="mdi:clock-outline"></span>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <h3 class="font-extrabold text-yellow-900 text-base">⏳ Berkas Sedang Diverifikasi oleh Admin</h3>
                    <span class="px-3 py-1 bg-yellow-200 text-yellow-800 font-mono font-bold text-xs rounded-full border border-yellow-300">
                        MENUNGGU APPRUVAL ADMIN
                    </span>
                </div>
                <p class="text-xs text-yellow-800 mt-2 leading-relaxed">
                    Formulir pendaftaran dan kelengkapan berkas dokumen Anda (Kartu Keluarga, Akta Kelahiran, Ijazah, dan Pasfoto) sudah tersimpan di sistem. 
                    <strong>Sesuai alur PSB Al-Fattah, tombol pembayaran Midtrans akan aktif secara otomatis setelah berkas Anda disetujui (Approved) oleh Admin.</strong>
                </p>
                
                <div class="mt-4 p-4 bg-white rounded-xl border border-yellow-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="flex items-center gap-2 text-xs text-gray-600">
                        <span class="iconify text-lg text-yellow-600" data-icon="mdi:information-outline"></span>
                        <span>Nomor Order Registrasi: <strong class="font-mono text-gray-900">{{ $pendaftar->order_id ?? 'PSB-'.time() }}</strong></span>
                    </div>
                    <button disabled class="px-4 py-2 bg-gray-200 text-gray-500 font-bold rounded-xl text-xs flex items-center gap-2 cursor-not-allowed opacity-80">
                        <span class="iconify text-base" data-icon="mdi:lock"></span>
                        <span>Bayar Sekarang (Terkunci)</span>
                    </button>
                </div>
            </div>
        </div>

    {{-- KONDISI 2: BERKAS APPROVED ADMIN DAN SIAP DIBAYAR --}}
    @elseif($isApproved && !$isLunas)
        <div class="p-6 bg-emerald-50 border-2 border-emerald-500 rounded-2xl shadow-md flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 shadow-md">
                <span class="iconify text-2xl" data-icon="mdi:check-decagram"></span>
            </div>
            <div class="flex-1 space-y-3">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <h3 class="font-extrabold text-emerald-900 text-lg">🎉 Berkas Anda Telah Disetujui (Approved)!</h3>
                    <span class="px-3 py-1 bg-emerald-600 text-white font-mono font-bold text-xs rounded-full">
                        SIAP DIBAYAR
                    </span>
                </div>
                <p class="text-xs text-emerald-800 leading-relaxed">
                    Selamat! Tim Validator Admin telah menyetujui berkas pendaftaran Anda. Silakan lanjutkan ke tahap pembayaran pendaftaran sebesar <strong>Rp 200.000</strong> melalui Midtrans (Mendukung QRIS, Transfer Bank, GoPay, dan Indomaret/Alfamart).
                </p>

                <div class="bg-white p-4 rounded-xl border border-emerald-200 grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                    <div>
                        <span class="text-gray-400 block text-[10px]">Nomor Order:</span>
                        <strong class="font-mono text-gray-900">{{ $pendaftar->order_id }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Calon Santri:</span>
                        <strong class="text-gray-900">{{ $pendaftar->nama }}</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Biaya Registrasi:</span>
                        <strong class="text-emerald-700 text-base font-black">Rp 200.000</strong>
                    </div>
                </div>

                <!-- Tombol Bayar Midtrans Snap -->
                <div class="pt-2">
                    <button id="pay-button"
                        class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 text-sm">
                        <span class="iconify text-xl" data-icon="mdi:credit-card-fast"></span>
                        <span>Bayar Sekarang via Midtrans Snap (Rp 200.000)</span>
                    </button>
                </div>
            </div>
        </div>

    {{-- KONDISI 3: SUDAH LUNAS (SETTLEMENT) --}}
    @else
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
                        <strong class="text-emerald-700">Midtrans Gateway</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Nominal:</span>
                        <strong class="text-green-700">Rp 200.000</strong>
                    </div>
                    <div>
                        <span class="text-gray-400 block text-[10px]">Status:</span>
                        <strong class="text-emerald-600">LUNAS / VERIFIED</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                            @if($isLunas)
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    Lunas (Midtrans)
                                </span>
                            @elseif($isApproved)
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                    Siap Dibayar
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-300">
                                    Menunggu Verifikasi Berkas
                                </span>
                            @endif
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

@if($snapToken && $isApproved && !$isLunas)
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    if (payButton) {
        payButton.addEventListener('click', function () {
            @if(str_starts_with($snapToken, 'mock-snap'))
                alert("Mode Pengujian / Sandbox: Snap token demo aktif.");
                window.location.reload();
            @else
                window.snap.pay("{{ $snapToken }}", {
                    onSuccess: function(result){
                        alert("Pembayaran berhasil diproses!");
                        window.location.reload();
                    },
                    onPending: function(result){
                        alert("Menunggu pembayaran...");
                    },
                    onError: function(result){
                        alert("Pembayaran belum berhasil diselesaikan.");
                    }
                });
            @endif
        });
    }
</script>
@endif
@endsection
