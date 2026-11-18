@extends('layouts.frontend')

@section('title', 'Pendaftaran Berhasil Dikirim - Pondok Pesantren Al-Fattah')

@section('content')
<section class="min-h-screen bg-gray-50/70 dark:bg-gray-900/60 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">

        <!-- Main Card Success -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-emerald-100 dark:border-gray-700 overflow-hidden text-center p-8 sm:p-12 relative">
            
            <!-- Top Green Accent Line -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-600 via-green-500 to-yellow-500"></div>

            <!-- Icon Success Animated -->
            <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner ring-8 ring-emerald-50 dark:ring-emerald-950/30">
                <span class="iconify text-5xl" data-icon="mdi:check-decagram"></span>
            </div>

            <!-- Header Info -->
            <span class="inline-block px-3.5 py-1 bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold rounded-full uppercase tracking-wider mb-2">
                Formulir Berhasil Diterima Panitia PSB
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white mt-2">
                Alhamdulillah, Pendaftaran Terkirim!
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 max-w-xl mx-auto mt-3 leading-relaxed">
                Terima kasih telah mendaftar di <strong>Pondok Pesantren Al-Fattah</strong>. Berkas dan formulir calon santri telah kami terima dan masuk ke dalam antrean verifikasi panitia.
            </p>

            <!-- Registration Summary Box -->
            <div class="mt-8 bg-gray-50 dark:bg-gray-750/70 rounded-2xl p-6 border border-gray-200/80 dark:border-gray-700 text-left">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-4 mb-4 border-b border-gray-200 dark:border-gray-700 gap-2">
                    <div>
                        <span class="text-[11px] uppercase font-bold text-gray-400">Nomor Registrasi / Order ID</span>
                        <div class="text-lg font-mono font-black text-emerald-700 dark:text-emerald-400">
                            {{ $pendaftar->order_id ?? 'PSB-' . time() }}
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 text-xs font-bold rounded-full border border-amber-200 flex items-center gap-1">
                        <span class="iconify" data-icon="mdi:clock-outline"></span>
                        Menunggu Verifikasi Berkas
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-gray-400 block">Nama Calon Santri:</span>
                        <span class="font-bold text-gray-800 dark:text-gray-100 text-sm">{{ $pendaftar->nama }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Pilihan Sekolah / Jurusan:</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-100">{{ $pendaftar->jenjang }} @if($pendaftar->jurusan) - {{ $pendaftar->jurusan }} @endif</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Alamat Email:</span>
                        <span class="font-mono text-gray-800 dark:text-gray-100">{{ $pendaftar->email }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block">Nomor WhatsApp / HP:</span>
                        <span class="font-mono text-gray-800 dark:text-gray-100">{{ $pendaftar->no_hp }}</span>
                    </div>
                </div>
            </div>

            <!-- Steps Info Next -->
            <div class="mt-8 text-left bg-emerald-50/60 dark:bg-gray-800 rounded-2xl p-6 border border-emerald-200/70 dark:border-emerald-800/40">
                <h3 class="text-sm font-bold text-emerald-900 dark:text-emerald-300 mb-3 flex items-center gap-2">
                    <span class="iconify text-lg text-emerald-600" data-icon="mdi:information-outline"></span>
                    <span>Alur & Tahapan Selanjutnya:</span>
                </h3>
                <ol class="space-y-3 text-xs text-gray-700 dark:text-gray-300 list-decimal list-inside leading-relaxed">
                    <li>
                        <strong>Verifikasi Dokumen Fisik/Online:</strong> Panitia PSB Al-Fattah akan meninjau kelengkapan berkas (KK, Akta Lahir, Ijazah/SKL, & Pasfoto) dalam kurun waktu <strong>1x24 jam</strong>.
                    </li>
                    <li>
                        <strong>Penerbitan Akun Portal Santri:</strong> Setelah berkas dinyatakan valid, Tim Admin akan menerbitkan akun resmi santri (Email & Password) dan mengirimkannya melalui <strong>WhatsApp ke {{ $pendaftar->no_hp }}</strong>.
                    </li>
                    <li>
                        <strong>Login & Pembayaran Administrasi:</strong> Santri/wali santri dapat masuk ke sistem menggunakan akun resmi untuk mencetak Bukti Penerimaan dan menyelesaikan pembayaran biaya pendaftaran / daftar ulang via Midtrans di dalam portal.
                    </li>
                </ol>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <!-- WhatsApp CS Panitia -->
                <a href="https://wa.me/6281234567890?text={{ urlencode('Assalamu\'alaikum Panitia PSB Al-Fattah, saya telah mengisi formulir online atas nama ' . $pendaftar->nama . ' (No: ' . $pendaftar->order_id . '). Mohon informasi verifikasi berkas selanjutnya. Terima kasih.') }}" 
                   target="_blank"
                   class="w-full sm:w-auto px-6 py-3.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs transition duration-200 flex items-center justify-center gap-2 shadow-lg shadow-green-600/20">
                    <span class="iconify text-lg" data-icon="mdi:whatsapp"></span>
                    <span>Konfirmasi ke WhatsApp Panitia</span>
                </a>

                <!-- Back to Home -->
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto px-6 py-3.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold rounded-xl text-xs transition duration-200 flex items-center justify-center gap-2">
                    <span class="iconify text-lg" data-icon="mdi:home-outline"></span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            <div class="mt-8 text-center text-[11px] text-gray-400">
                Pondok Pesantren Al-Fattah Tigaraksa, Kab. Tangerang, Banten.
            </div>

        </div>

    </div>
</section>
@endsection
