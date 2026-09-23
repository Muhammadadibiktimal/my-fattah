@extends('layouts.user')

@section('title', 'Biodata & Dokumen Santri')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white p-6 rounded-3xl shadow-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                Arsip Data & Dokumen Santri
            </span>
            <h1 class="text-2xl font-extrabold mt-2 flex items-center gap-2">
                <span class="iconify" data-icon="mdi:card-account-details-outline"></span>
                Biodata & Dokumen Terverifikasi
            </h1>
            <p class="text-emerald-100 text-xs mt-1">
                Seluruh data dan lampiran dokumen pendaftaran Anda telah tercatat dan dinyatakan sah oleh Administrator Pesantren.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-emerald-500/30 border border-emerald-400 text-emerald-200 rounded-xl text-xs font-bold flex items-center gap-1">
                <span class="iconify text-base" data-icon="mdi:shield-check"></span> Berkas Sah
            </span>
        </div>
    </div>

    <!-- 3 Kolom Biodata Lengkap -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- 1. Data Diri Santri -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-gray-100 text-emerald-700 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:account-outline"></span>
                <span>Data Pribadi Santri</span>
            </div>

            <div class="text-xs space-y-2.5 text-gray-600">
                <div>
                    <span class="text-gray-400 block">Nama Lengkap:</span>
                    <strong class="text-gray-900 text-sm">{{ $santri->nama_lengkap ?? $pendaftar->nama ?? Auth::user()->name }}</strong>
                </div>
                <div>
                    <span class="text-gray-400 block">Nomor Induk Kependudukan (NIK):</span>
                    <span class="font-mono font-semibold text-gray-800">{{ $pendaftar->nik ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">NISN:</span>
                    <span class="font-mono font-semibold text-gray-800">{{ $santri->nisn ?? $pendaftar->nisn ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Tempat, Tanggal Lahir:</span>
                    <span class="text-gray-800">{{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar && $pendaftar->tanggal_lahir ? date('d-m-Y', strtotime($pendaftar->tanggal_lahir)) : '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Jenis Kelamin:</span>
                    <span class="text-gray-800">{{ $santri->jenis_kelamin ?? $pendaftar->jenis_kelamin ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Jenjang Pilihan:</span>
                    <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded font-bold text-xs inline-block">
                        {{ $pendaftar->jenjang ?? 'SMP Al-Fattah' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- 2. Asal Sekolah & Kontak -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-gray-100 text-blue-700 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:school-outline"></span>
                <span>Asal Sekolah & Kontak</span>
            </div>

            <div class="text-xs space-y-2.5 text-gray-600">
                <div>
                    <span class="text-gray-400 block">Asal Sekolah / Madrasah:</span>
                    <strong class="text-gray-900">{{ $pendaftar->asal_sekolah ?? '-' }}</strong>
                </div>
                <div>
                    <span class="text-gray-400 block">Alamat / Wilayah Asal Sekolah:</span>
                    <span class="text-gray-800">{{ $pendaftar->alamat_sekolah ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Alamat Email Santri:</span>
                    <span class="font-mono text-blue-600 font-semibold">{{ $pendaftar->email ?? Auth::user()->email }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Nomor HP / WhatsApp Santri:</span>
                    <span class="font-mono text-gray-800">{{ $santri->no_hp ?? $pendaftar->no_hp ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Alamat Domisili Tempat Tinggal:</span>
                    <span class="text-gray-800">{{ $santri->alamat ?? $pendaftar->alamat ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- 3. Data Orang Tua / Wali -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-gray-100 text-purple-700 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:account-child-outline"></span>
                <span>Data Orang Tua / Wali</span>
            </div>

            <div class="text-xs space-y-2.5 text-gray-600">
                <div>
                    <span class="text-gray-400 block">Nama Ayah Kandung:</span>
                    <strong class="text-gray-900">{{ $pendaftar->nama_ayah ?? '-' }}</strong>
                </div>
                <div>
                    <span class="text-gray-400 block">Pekerjaan Ayah:</span>
                    <span class="text-gray-800">{{ $pendaftar->pekerjaan_ayah ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Nama Ibu Kandung:</span>
                    <strong class="text-gray-900">{{ $pendaftar->nama_ibu ?? '-' }}</strong>
                </div>
                <div>
                    <span class="text-gray-400 block">Pekerjaan Ibu:</span>
                    <span class="text-gray-800">{{ $pendaftar->pekerjaan_ibu ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400 block">Nomor WhatsApp Orang Tua:</span>
                    <span class="font-mono text-emerald-700 font-bold">{{ $pendaftar->no_hp_ortu ?? '-' }}</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Dokumen Lampiran yang Diunggah -->
    @php
        $kk = $pendaftar->file_kk ?? null;
        $akta = $pendaftar->file_akta ?? null;
        $ijazah = $pendaftar->file_ijazah ?? null;
        $foto = $pendaftar->file_foto ?? null;
    @endphp

    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
            <div class="flex items-center gap-2 text-emerald-800 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:folder-file-outline"></span>
                <span>Lampiran Berkas Persyaratan Terverifikasi</span>
            </div>
            <span class="text-xs text-gray-400">Status: Sah di Database</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            
            <!-- KK -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between bg-gray-50/50">
                <div>
                    <span class="iconify text-4xl text-emerald-600 mx-auto mb-2" data-icon="mdi:file-document-outline"></span>
                    <h4 class="font-bold text-xs text-gray-800">Kartu Keluarga (KK)</h4>
                    <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold mt-1 inline-block">Terverifikasi</span>
                </div>
                <div class="mt-3">
                    @if($kk)
                        <a href="{{ asset('storage/' . $kk) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition shadow-sm">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka Berkas
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

            <!-- Akta -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between bg-gray-50/50">
                <div>
                    <span class="iconify text-4xl text-blue-600 mx-auto mb-2" data-icon="mdi:certificate-outline"></span>
                    <h4 class="font-bold text-xs text-gray-800">Akta Kelahiran</h4>
                    <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold mt-1 inline-block">Terverifikasi</span>
                </div>
                <div class="mt-3">
                    @if($akta)
                        <a href="{{ asset('storage/' . $akta) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka Berkas
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

            <!-- Ijazah -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between bg-gray-50/50">
                <div>
                    <span class="iconify text-4xl text-amber-600 mx-auto mb-2" data-icon="mdi:school-outline"></span>
                    <h4 class="font-bold text-xs text-gray-800">Ijazah / SKL</h4>
                    <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold mt-1 inline-block">Terverifikasi</span>
                </div>
                <div class="mt-3">
                    @if($ijazah)
                        <a href="{{ asset('storage/' . $ijazah) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-amber-600 text-white rounded-lg text-xs font-bold hover:bg-amber-700 transition shadow-sm">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka Berkas
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

            <!-- Pas Foto -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between bg-gray-50/50">
                <div>
                    <span class="iconify text-4xl text-purple-600 mx-auto mb-2" data-icon="mdi:camera-account"></span>
                    <h4 class="font-bold text-xs text-gray-800">Pas Foto Santri</h4>
                    <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold mt-1 inline-block">Terverifikasi</span>
                </div>
                <div class="mt-3">
                    @if($foto)
                        <a href="{{ asset('storage/' . $foto) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 bg-purple-600 text-white rounded-lg text-xs font-bold hover:bg-purple-700 transition shadow-sm">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka Foto
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
