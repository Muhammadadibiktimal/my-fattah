@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 via-blue-50 to-purple-100 p-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Assalamu'alaikum, {{ Auth::user()->name }} 👋</h1>
            <p class="text-gray-600">Selamat datang di Dashboard Santri Pesantren Al Fattah</p>
        </div>
        <div>
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-14 w-14 rounded-full shadow">
        </div>
    </div>

    <!-- Grid Menu Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Lengkapi Data -->
        <a href=""
           class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl hover:scale-[1.02] transition duration-300 flex flex-col items-center text-center">
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full mb-4">
                📑
            </div>
            <h2 class="font-semibold text-lg">Lengkapi Data</h2>
            <p class="text-sm text-gray-500 mt-1">Isi data pendaftaran dengan lengkap.</p>
        </a>

        <!-- Status Pendaftaran -->
        <a href=""
           class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl hover:scale-[1.02] transition duration-300 flex flex-col items-center text-center">
            <div class="bg-green-100 text-green-600 p-4 rounded-full mb-4">
                ✅
            </div>
            <h2 class="font-semibold text-lg">Status Pendaftaran</h2>
            <p class="text-sm text-gray-500 mt-1">Cek status pendaftaran santri.</p>
        </a>

        <!-- Cetak Bukti -->
        <a href=""
           class="bg-white rounded-xl shadow-md p-6 hover:shadow-xl hover:scale-[1.02] transition duration-300 flex flex-col items-center text-center">
            <div class="bg-purple-100 text-purple-600 p-4 rounded-full mb-4">
                🖨️
            </div>
            <h2 class="font-semibold text-lg">Cetak Bukti</h2>
            <p class="text-sm text-gray-500 mt-1">Download atau cetak bukti pendaftaran.</p>
        </a>
    </div>

    <!-- Informasi Pesantren -->
    <div class="mt-10 bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">📢 Informasi Penting</h2>
        <ul class="space-y-2 text-gray-700">
            <li>➡️ Waktu pendaftaran dibuka hingga <span class="font-semibold">30 Juni 2025</span>.</li>
            <li>➡️ Tes masuk dilaksanakan pada <span class="font-semibold">10 Juli 2025</span>.</li>
            <li>➡️ Hubungi admin melalui WhatsApp jika ada kendala.</li>
        </ul>
    </div>
</div>
@endsection
