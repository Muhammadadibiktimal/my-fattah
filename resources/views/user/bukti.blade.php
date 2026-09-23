@extends('layouts.user')

@section('title', 'Kartu Tanda Santri & Bukti Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl shadow-sm border border-gray-200">
        <div>
            <h2 class="text-xl font-extrabold text-gray-900 flex items-center gap-2">
                <span class="iconify text-2xl text-emerald-600" data-icon="mdi:card-account-details-star"></span>
                <span>Kartu Tanda Santri (KTS) & Bukti Pendaftaran</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Data terverifikasi resmi dari database santri & pendaftaran Pondok Pesantren Al-Fattah.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs flex items-center gap-1.5 transition">
                <span class="iconify text-base" data-icon="mdi:printer"></span>
                <span>Cetak Kartu</span>
            </button>
            <a href="{{ route('user.bukti.cetak') }}" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs flex items-center gap-1.5 shadow-md shadow-emerald-600/20 transition">
                <span class="iconify text-base" data-icon="mdi:file-pdf-box"></span>
                <span>Download PDF</span>
            </a>
        </div>
    </div>

    <!-- MAIN KARTU TANDA SANTRI (KTS) -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-200 overflow-hidden relative">
        <!-- Header Banner Kartu -->
        <div class="bg-gradient-to-r from-emerald-800 via-green-800 to-teal-900 text-white p-6 sm:p-8 relative overflow-hidden">
            <!-- Background Ornaments -->
            <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute right-20 -bottom-10 w-36 h-36 bg-yellow-400/10 rounded-full blur-xl"></div>

            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="w-20 h-20 bg-white rounded-2xl p-2 shadow-lg flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Al-Fattah" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="px-3 py-1 bg-yellow-400 text-gray-950 rounded-full text-[11px] font-black uppercase tracking-wider inline-block mb-1.5 shadow-sm">
                            KARTU TANDA SANTRI RESMI
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Pondok Pesantren Al-Fattah</h1>
                        <p class="text-xs sm:text-sm text-emerald-100 font-medium mt-0.5">
                            SMP • SMA • SMK AL-FATTAH TIGARAKSA
                        </p>
                        <p class="text-[11px] text-emerald-200/80">
                            Jl. Raya Tigaraksa No. 1, Kab. Tangerang, Banten • Telp: (021) 599-0000
                        </p>
                    </div>
                </div>

                <div class="sm:text-right flex-shrink-0 bg-white/10 backdrop-blur-md px-4 py-3 rounded-2xl border border-white/20">
                    <span class="text-[10px] uppercase font-bold text-yellow-300 block tracking-wider">Nomor Registrasi / KTS</span>
                    <span class="font-mono text-base font-extrabold tracking-wider">{{ $dataPendaftar->order_id }}</span>
                    <span class="block text-[10px] text-emerald-200 mt-0.5">TA 2026/2027</span>
                </div>
            </div>
        </div>

        <!-- Body Kartu: Data Identitas Santri -->
        <div class="p-6 sm:p-8 space-y-6">

            <!-- Bar Status Akademik -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="bg-emerald-50 border border-emerald-200 p-3.5 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0">
                        <span class="iconify text-xl" data-icon="mdi:school-outline"></span>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider">Jenjang Sekolah</p>
                        <p class="text-sm font-extrabold text-emerald-950">{{ $dataPendaftar->jenjang }}</p>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 p-3.5 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center flex-shrink-0">
                        <span class="iconify text-xl" data-icon="mdi:compass-outline"></span>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-blue-700 uppercase tracking-wider">Peminatan / Jurusan</p>
                        <p class="text-sm font-extrabold text-blue-950">{{ $dataPendaftar->jurusan }}</p>
                    </div>
                </div>

                <div class="bg-purple-50 border border-purple-200 p-3.5 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center flex-shrink-0">
                        <span class="iconify text-xl" data-icon="mdi:google-classroom"></span>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-purple-700 uppercase tracking-wider">Kelas Santri</p>
                        <p class="text-sm font-extrabold text-purple-950">Kelas {{ $dataPendaftar->kelas }}</p>
                    </div>
                </div>
            </div>

            <!-- Profile & Detail Grid -->
            <div class="flex flex-col md:flex-row gap-6 items-start">
                <!-- Foto Santri & QR -->
                <div class="w-full md:w-52 flex flex-col items-center p-4 bg-gray-50 rounded-2xl border border-gray-200 flex-shrink-0 text-center">
                    <div class="w-36 h-48 bg-gray-200 rounded-xl overflow-hidden border-2 border-emerald-600/50 shadow-inner flex items-center justify-center mb-3">
                        @if($dataPendaftar->file_foto)
                            <img src="{{ asset('storage/' . $dataPendaftar->file_foto) }}" alt="Foto Santri" class="w-full h-full object-cover">
                        @else
                            <div class="text-center p-3">
                                <span class="iconify text-5xl text-gray-400 mx-auto" data-icon="mdi:account-tie"></span>
                                <span class="text-[10px] text-gray-500 font-bold mt-1 block">Pas Foto Santri (3x4)</span>
                            </div>
                        @endif
                    </div>

                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold mb-2">
                        <span class="iconify text-sm" data-icon="mdi:check-decagram"></span>
                        <span>{{ $dataPendaftar->status }}</span>
                    </span>

                    <p class="text-[10px] text-gray-400 font-mono tracking-wider">
                        STATUS: {{ strtoupper($dataPendaftar->status_bayar ?? 'SETTLEMENT') }}
                    </p>
                </div>

                <!-- Detail Identitas Pribadi -->
                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                    <div class="p-4 bg-gray-50/80 rounded-2xl border border-gray-100 sm:col-span-2">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Nama Lengkap Santri</span>
                        <p class="text-lg font-black text-gray-900 mt-0.5">{{ $dataPendaftar->nama_lengkap }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">NISN (Nomor Induk Siswa)</span>
                        <p class="text-sm font-extrabold font-mono text-gray-800 mt-0.5">{{ $dataPendaftar->nisn }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">NIK (Nomor Induk Kependudukan)</span>
                        <p class="text-sm font-extrabold font-mono text-gray-800 mt-0.5">{{ $dataPendaftar->nik }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Tempat, Tanggal Lahir</span>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">
                            {{ $dataPendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($dataPendaftar->tanggal_lahir)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Jenis Kelamin</span>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $dataPendaftar->jenis_kelamin }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100 sm:col-span-2">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Asal Sekolah Sebelumnya</span>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $dataPendaftar->asal_sekolah }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100 sm:col-span-2">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Alamat Lengkap Domisili</span>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $dataPendaftar->alamat }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Nama Ayah</span>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $dataPendaftar->nama_ayah }}</p>
                    </div>

                    <div class="p-3.5 bg-gray-50/80 rounded-2xl border border-gray-100">
                        <span class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">Nama Ibu</span>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $dataPendaftar->nama_ibu }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer Tanda Pengesahan -->
            <div class="mt-6 pt-6 border-t border-dashed border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-gray-500">
                <div class="flex items-center gap-2">
                    <span class="iconify text-2xl text-emerald-600" data-icon="mdi:shield-check"></span>
                    <span>Kartu Tanda Santri ini sah dan diakui sebagai dokumen kesiswaan resmi Pondok Pesantren Al-Fattah.</span>
                </div>
                <div class="font-mono text-[11px] text-gray-400">
                    Dicetak: {{ now()->translatedFormat('d F Y H:i') }} WIB
                </div>
            </div>

        </div>

    </div>

    <!-- Quick Navigation Links -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <a href="{{ route('user.dashboard') }}" class="p-3.5 bg-white rounded-2xl border border-gray-200 hover:border-emerald-500 hover:shadow-md transition text-center group">
            <span class="iconify text-2xl text-emerald-600 mx-auto group-hover:scale-110 transition" data-icon="mdi:view-dashboard"></span>
            <span class="block text-xs font-bold text-gray-800 mt-1">Beranda Santri</span>
        </a>
        <a href="{{ route('user.jadwal') }}" class="p-3.5 bg-white rounded-2xl border border-gray-200 hover:border-emerald-500 hover:shadow-md transition text-center group">
            <span class="iconify text-2xl text-blue-600 mx-auto group-hover:scale-110 transition" data-icon="mdi:calendar-clock"></span>
            <span class="block text-xs font-bold text-gray-800 mt-1">Jadwal & Kelas</span>
        </a>
        <a href="{{ route('user.nilai') }}" class="p-3.5 bg-white rounded-2xl border border-gray-200 hover:border-emerald-500 hover:shadow-md transition text-center group">
            <span class="iconify text-2xl text-amber-500 mx-auto group-hover:scale-110 transition" data-icon="mdi:certificate"></span>
            <span class="block text-xs font-bold text-gray-800 mt-1">Nilai & Rapor</span>
        </a>
        <a href="{{ route('user.biodata') }}" class="p-3.5 bg-white rounded-2xl border border-gray-200 hover:border-emerald-500 hover:shadow-md transition text-center group">
            <span class="iconify text-2xl text-indigo-600 mx-auto group-hover:scale-110 transition" data-icon="mdi:card-account-details-outline"></span>
            <span class="block text-xs font-bold text-gray-800 mt-1">Biodata & Berkas</span>
        </a>
    </div>

</div>
@endsection
