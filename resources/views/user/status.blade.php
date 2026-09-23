@extends('layouts.user')

@section('title', 'Status Seleksi Santri')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    @if(!$dataPendaftar)
        <!-- Alert Belum Mengisi Data -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-2xl shadow-sm text-center">
            <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="iconify text-2xl" data-icon="mdi:alert-circle-outline"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-800">Formulir Pendaftaran Belum Lengkap</h3>
            <p class="text-sm text-gray-600 mt-1 mb-4">
                Kamu belum mengisi formulir pendaftaran calon santri baru. Silakan isi biodata terlebih dahulu.
            </p>
            <a href="{{ route('user.data') }}" class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs inline-flex items-center gap-2 shadow transition">
                <span class="iconify text-base" data-icon="mdi:pencil-square"></span>
                Isi Formulir Sekarang
            </a>
        </div>
    @else
        @php
            $status = $dataPendaftar->status ?? 'Pending';
        @endphp

        <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-800">Status Seleksi Santri Baru</h2>
                    <p class="text-sm text-gray-500 mt-1">Nama Santri: <span class="font-semibold text-gray-800">{{ $dataPendaftar->nama_lengkap }}</span></p>
                </div>

                <div>
                    @if($status == 'Terverifikasi' || $status == 'lulus')
                        <span class="px-4 py-2 bg-green-100 text-green-700 font-bold rounded-full text-xs flex items-center gap-1.5 border border-green-200">
                            <span class="iconify text-lg" data-icon="mdi:check-circle"></span> TERVERIFIKASI / LULUS
                        </span>
                    @elseif($status == 'Ditolak' || $status == 'gagal')
                        <span class="px-4 py-2 bg-red-100 text-red-700 font-bold rounded-full text-xs flex items-center gap-1.5 border border-red-200">
                            <span class="iconify text-lg" data-icon="mdi:close-circle"></span> DITOLAK / BELUM LOLOS
                        </span>
                    @else
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-700 font-bold rounded-full text-xs flex items-center gap-1.5 border border-yellow-200">
                            <span class="iconify text-lg" data-icon="mdi:clock-outline"></span> DALAM PROSES VERIFIKASI
                        </span>
                    @endif
                </div>
            </div>

            <!-- Pesan Penjelasan Status -->
            <div class="p-6 rounded-2xl border 
                {{ ($status == 'Terverifikasi' || $status == 'lulus') ? 'bg-green-50 border-green-200 text-green-900' : (($status == 'Ditolak' || $status == 'gagal') ? 'bg-red-50 border-red-200 text-red-900' : 'bg-yellow-50 border-yellow-200 text-yellow-900') }}">
                @if($status == 'Terverifikasi' || $status == 'lulus')
                    <h4 class="font-bold text-base mb-1">🎉 Selamat! Berkas Pendaftaran Terverifikasi</h4>
                    <p class="text-xs leading-relaxed">
                        Dokumen pendaftaran dan identitas kamu dinyatakan **VALID**. Silakan cetak kartu pendaftaran dan bersiap untuk jadwal pengarahan santri baru.
                    </p>
                @elseif($status == 'Ditolak' || $status == 'gagal')
                    <h4 class="font-bold text-base mb-1">⚠️ Mohon Maaf, Berkas Belum Terverifikasi</h4>
                    <p class="text-xs leading-relaxed">
                        Dokumen yang kamu upload (KK, Akta, atau Ijazah) mungkin tidak terbaca/salah. Silakan hubungi Panitia PSB Al-Fattah untuk bantuan lebih lanjut.
                    </p>
                @else
                    <h4 class="font-bold text-base mb-1">⏳ Berkas Sedang Diperiksa Panitia Admin</h4>
                    <p class="text-xs leading-relaxed">
                        Formulir dan berkas dokumen kamu sudah tersimpan di sistem dan sedang dalam antrean pemeriksaan oleh Tim Validator Admin Al-Fattah.
                    </p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
