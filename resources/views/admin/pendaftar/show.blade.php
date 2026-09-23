@extends('admin.layouts.app')

@section('title', 'Detail Calon Santri')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between pb-4 border-b border-gray-100">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600 text-3xl" data-icon="mdi:account-details-outline"></span>
                <span>Detail Calon Santri: {{ $pendaftar->nama ?? $pendaftar->nama_lengkap }}</span>
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Biodata lengkap, asal sekolah, data orang tua, dan dokumen persyaratan.</p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('admin.pendaftar.index') }}"
               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-bold transition">
               ← Kembali
            </a>

            @if(!empty($userSantri))
                <a href="{{ route('admin.santri.index', ['search' => $pendaftar->nama ?? $pendaftar->nama_lengkap]) }}"
                   class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                    <span class="iconify text-base" data-icon="mdi:account-school"></span>
                    <span>Lihat di Data Santri Aktif →</span>
                </a>

                <form action="{{ route('admin.pendaftar.buatAkun', $pendaftar->id) }}" method="POST"
                      onsubmit="return confirm('Reset password akun login santri ini?')">
                    @csrf
                    <button type="submit"
                            class="px-3.5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                        <span class="iconify text-base" data-icon="mdi:key-change"></span>
                        <span>Reset Password</span>
                    </button>
                </form>
            @else
                <!-- Tombol Buatkan Akun Santri -->
                <form action="{{ route('admin.pendaftar.buatAkun', $pendaftar->id) }}" method="POST"
                      onsubmit="return confirm('Buatkan akun login santri baru untuk calon santri ini?')">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                        <span class="iconify text-base" data-icon="mdi:account-plus"></span>
                        <span>Buatkan Akun Santri</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Alert Kredensial Akun -->
    @if(session('akun_created'))
        <div class="bg-emerald-50 border-2 border-emerald-500 rounded-2xl p-5 shadow-md">
            <div class="flex items-start gap-4">
                <div class="p-2 bg-emerald-500 text-white rounded-xl">
                    <span class="iconify text-2xl" data-icon="mdi:key-variant"></span>
                </div>
                <div>
                    <h4 class="text-base font-bold text-emerald-900">🎉 Akun Login Santri Berhasil Dibuat!</h4>
                    <p class="text-xs text-emerald-700 mt-0.5">Kredensial login berikut dapat langsung diberikan kepada santri/wali santri:</p>
                    <div class="mt-2 bg-white p-3 rounded-lg border border-emerald-200 font-mono text-xs space-y-1">
                        <div><strong>Nama :</strong> {{ session('akun_created')['nama'] }}</div>
                        <div><strong>Email:</strong> <span class="text-blue-600 font-bold select-all">{{ session('akun_created')['email'] }}</span></div>
                        <div><strong>Password:</strong> <span class="text-red-600 font-bold select-all">{{ session('akun_created')['password'] }}</span></div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.santri.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-800 underline hover:text-emerald-900">
                            Buka Data Santri Aktif →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded-xl border border-green-200 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- 3 Kolom Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- 1. Data Diri -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-3">
            <div class="flex items-center gap-2 pb-3 border-b border-gray-100 text-emerald-700 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:account-outline"></span>
                <span>Data Pribadi</span>
            </div>

            <div class="text-xs space-y-2 text-gray-600">
                <div><span class="text-gray-400 block">Nama Lengkap:</span> <strong class="text-gray-900 text-sm">{{ $pendaftar->nama ?? $pendaftar->nama_lengkap }}</strong></div>
                <div><span class="text-gray-400 block">NIK:</span> <span class="font-mono font-semibold">{{ $pendaftar->nik ?? '-' }}</span></div>
                <div><span class="text-gray-400 block">NISN:</span> <span class="font-mono font-semibold">{{ $pendaftar->nisn ?? '-' }}</span></div>
                <div><span class="text-gray-400 block">Tempat, Tanggal Lahir:</span> {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tanggal_lahir ? date('d-m-Y', strtotime($pendaftar->tanggal_lahir)) : '-' }}</div>
                <div><span class="text-gray-400 block">Jenis Kelamin:</span> {{ $pendaftar->jenis_kelamin ?? '-' }}</div>
                <div><span class="text-gray-400 block">Pilihan Jenjang:</span> <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded font-bold">{{ $pendaftar->jenjang ?? 'SMP Al-Fattah' }}</span></div>
                <div><span class="text-gray-400 block">Status Pembayaran:</span>
                    <span class="px-2 py-0.5 rounded font-bold {{ ($pendaftar->status_bayar ?? $pendaftar->status) == 'settlement' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($pendaftar->status_bayar ?? $pendaftar->status ?? 'Pending') }}
                    </span>
                </div>

                @if(!empty($userSantri))
                    <div class="pt-2 mt-2 border-t border-gray-100 bg-emerald-50/70 p-2.5 rounded-xl border border-emerald-200">
                        <div class="text-[11px] font-bold text-emerald-800 flex items-center gap-1">
                            <span class="iconify text-base" data-icon="mdi:check-decagram"></span>
                            <span>Akun Santri Aktif</span>
                        </div>
                        <div class="text-xs text-emerald-700 mt-1">
                            Email: <strong class="font-mono select-all">{{ $userSantri->email }}</strong>
                        </div>
                    </div>
                @else
                    <div class="pt-2 mt-2 border-t border-gray-100 bg-gray-50 p-2.5 rounded-xl border border-gray-200">
                        <div class="text-[11px] font-semibold text-gray-500 flex items-center gap-1">
                            <span class="iconify text-base" data-icon="mdi:account-clock"></span>
                            <span>Belum dibuatkan akun portal santri</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- 2. Asal Sekolah & Kontak -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-3">
            <div class="flex items-center gap-2 pb-3 border-b border-gray-100 text-yellow-700 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:school-outline"></span>
                <span>Asal Sekolah & Kontak</span>
            </div>

            <div class="text-xs space-y-2 text-gray-600">
                <div><span class="text-gray-400 block">Nama Asal Sekolah:</span> <strong class="text-gray-900">{{ $pendaftar->asal_sekolah ?? '-' }}</strong></div>
                <div><span class="text-gray-400 block">Alamat Asal Sekolah:</span> {{ $pendaftar->alamat_sekolah ?? '-' }}</div>
                <div><span class="text-gray-400 block">Email Santri:</span> <span class="font-mono text-blue-600">{{ $pendaftar->email ?? '-' }}</span></div>
                <div><span class="text-gray-400 block">Nomor WhatsApp / HP:</span> <span class="font-mono">{{ $pendaftar->no_hp ?? '-' }}</span></div>
                <div><span class="text-gray-400 block">Alamat Domisili:</span> {{ $pendaftar->alamat ?? '-' }}</div>
            </div>
        </div>

        <!-- 3. Orang Tua / Wali -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-3">
            <div class="flex items-center gap-2 pb-3 border-b border-gray-100 text-blue-700 font-bold text-sm">
                <span class="iconify text-xl" data-icon="mdi:account-group-outline"></span>
                <span>Orang Tua / Wali</span>
            </div>

            <div class="text-xs space-y-2 text-gray-600">
                <div><span class="text-gray-400 block">Nama Ayah:</span> <strong class="text-gray-900">{{ $pendaftar->nama_ayah ?? '-' }}</strong></div>
                <div><span class="text-gray-400 block">Pekerjaan Ayah:</span> {{ $pendaftar->pekerjaan_ayah ?? '-' }}</div>
                <div><span class="text-gray-400 block">Nama Ibu:</span> <strong class="text-gray-900">{{ $pendaftar->nama_ibu ?? '-' }}</strong></div>
                <div><span class="text-gray-400 block">Pekerjaan Ibu:</span> {{ $pendaftar->pekerjaan_ibu ?? '-' }}</div>
                <div><span class="text-gray-400 block">No. HP Orang Tua:</span> <span class="font-mono">{{ $pendaftar->no_hp_ortu ?? '-' }}</span></div>
            </div>
        </div>

    </div>

    <!-- Lampiran Dokumen -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-4">
        <h3 class="text-base font-bold text-gray-800 flex items-center gap-2 pb-3 border-b border-gray-100">
            <span class="iconify text-xl text-emerald-600" data-icon="mdi:folder-open-outline"></span>
            <span>Dokumen Persyaratan yang Dilampirkan</span>
        </h3>

        @php
            $kk = $pendaftar->file_kk ?? $pendaftar->kk ?? null;
            $akta = $pendaftar->file_akta ?? $pendaftar->akta ?? null;
            $ijazah = $pendaftar->file_ijazah ?? $pendaftar->ijazah ?? null;
            $foto = $pendaftar->file_foto ?? null;
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <!-- KK -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between">
                <div>
                    <span class="iconify text-4xl text-emerald-600 mx-auto mb-2" data-icon="mdi:file-document-outline"></span>
                    <h4 class="font-bold text-xs text-gray-800">Kartu Keluarga (KK)</h4>
                </div>
                <div class="mt-3">
                    @if($kk)
                        <a href="{{ asset('storage/' . $kk) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-lg text-xs font-bold transition">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka File
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

            <!-- Akta -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between">
                <div>
                    <span class="iconify text-4xl text-blue-600 mx-auto mb-2" data-icon="mdi:certificate-outline"></span>
                    <h4 class="font-bold text-xs text-gray-800">Akta Kelahiran</h4>
                </div>
                <div class="mt-3">
                    @if($akta)
                        <a href="{{ asset('storage/' . $akta) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-bold transition">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka File
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

            <!-- Ijazah -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between">
                <div>
                    <span class="iconify text-4xl text-yellow-600 mx-auto mb-2" data-icon="mdi:school-outline"></span>
                    <h4 class="font-bold text-xs text-gray-800">Ijazah / SKL</h4>
                </div>
                <div class="mt-3">
                    @if($ijazah)
                        <a href="{{ asset('storage/' . $ijazah) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-50 text-yellow-700 hover:bg-yellow-100 rounded-lg text-xs font-bold transition">
                            <span class="iconify" data-icon="mdi:eye"></span> Buka File
                        </a>
                    @else
                        <span class="text-[11px] text-gray-400 italic">Belum diunggah</span>
                    @endif
                </div>
            </div>

            <!-- Pas Foto -->
            <div class="p-4 rounded-xl border border-gray-200 text-center flex flex-col justify-between">
                <div>
                    <span class="iconify text-4xl text-purple-600 mx-auto mb-2" data-icon="mdi:camera-account"></span>
                    <h4 class="font-bold text-xs text-gray-800">Pas Foto Santri</h4>
                </div>
                <div class="mt-3">
                    @if($foto)
                        <a href="{{ asset('storage/' . $foto) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1.5 bg-purple-50 text-purple-700 hover:bg-purple-100 rounded-lg text-xs font-bold transition">
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
