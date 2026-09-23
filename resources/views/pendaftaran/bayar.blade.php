@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-12">
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 via-emerald-600 to-green-700 p-6 text-white text-center relative">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl mb-3 shadow-inner">
                <span class="iconify text-3xl text-white" data-icon="mdi:credit-card-check-outline"></span>
            </div>
            <h2 class="text-2xl font-black">Pembayaran Pendaftaran Santri</h2>
            <p class="text-green-100 text-sm mt-1">Payment Gateway Resmi Midtrans</p>
        </div>

        <!-- Detail Tagihan -->
        <div class="p-6 md:p-8 space-y-6">
            <div class="bg-green-50 dark:bg-gray-900/50 rounded-2xl p-5 border border-green-100 dark:border-gray-700">
                <div class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-700 text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Nomor Registrasi / Order</span>
                    <span class="font-bold text-gray-800 dark:text-gray-200 font-mono">{{ $pendaftar->order_id }}</span>
                </div>
                <div class="flex justify-between items-center py-2.5 border-b border-gray-200 dark:border-gray-700 text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Nama Calon Santri</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $pendaftar->nama }}</span>
                </div>
                <div class="flex justify-between items-center py-2.5 border-b border-gray-200 dark:border-gray-700 text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Email</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $pendaftar->email }}</span>
                </div>
                <div class="flex justify-between items-center py-2.5 border-b border-gray-200 dark:border-gray-700 text-sm">
                    <span class="text-gray-500 dark:text-gray-400">No. WhatsApp / HP</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $pendaftar->no_hp }}</span>
                </div>
                <div class="flex justify-between items-center pt-3 text-base">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Total Biaya Pendaftaran</span>
                    <span class="text-2xl font-black text-green-600 dark:text-green-400">Rp 200.000</span>
                </div>
            </div>

            <!-- Keamanan Midtrans Banner -->
            <div class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-950/30 rounded-xl text-blue-700 dark:text-blue-300 text-xs border border-blue-200 dark:border-blue-900/50">
                <span class="iconify text-xl flex-shrink-0" data-icon="mdi:shield-check"></span>
                <span>Didukung oleh Midtrans Payment Gateway. Mendukung QRIS, GoPay, OVO, Transfer Bank (BCA, Mandiri, BRI, BNI), dan Indomaret/Alfamart.</span>
            </div>

            <!-- Tombol Bayar -->
            <div class="space-y-3 pt-2">
                <button id="pay-button"
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 rounded-xl shadow-xl shadow-green-600/30 transition transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 text-base">
                    <span class="iconify text-2xl" data-icon="mdi:lock-check"></span>
                    <span>Bayar Sekarang (Buka Midtrans Snap)</span>
                </button>

                <!-- Sandbox Helper for Dev & Testing -->
                <form action="{{ route('pendaftaran.finish') }}" method="GET" class="text-center">
                    <button type="submit"
                            class="text-xs text-gray-400 hover:text-green-600 underline transition">
                        Lewati ke Selesai (Simulasi Berhasil Sandbox)
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        @if(str_starts_with($snapToken, 'mock-snap'))
            alert("Mode Pengujian / Sandbox: Snap token demo aktif. Anda akan dialihkan ke halaman selesai.");
            window.location.href = "{{ route('pendaftaran.finish') }}";
        @else
            window.snap.pay("{{ $snapToken }}", {
                onSuccess: function(result){
                    alert("Pembayaran berhasil diproses!");
                    window.location.href = "{{ route('pendaftaran.finish') }}";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran...");
                },
                onError: function(result){
                    alert("Pembayaran belum berhasil diselesaikan.");
                },
                onClose: function(){
                    // User closed popup
                }
            });
        @endif
    });
</script>
@endsection
