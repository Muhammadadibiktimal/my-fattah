@extends('admin.layouts.app')

@section('title', 'Verifikasi Dokumen Pendaftar')

@section('content')
<div x-data="{ 
    showModal: false, 
    selectedData: {},
    isImage(url) {
        if (!url) return false;
        return url.match(/\.(jpeg|jpg|gif|png|webp)($|\?)/i) != null;
    }
}" class="space-y-6">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-800 via-green-700 to-emerald-900 text-white p-6 rounded-2xl shadow-md relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="px-3 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider">
                    Pusat Verifikasi Dokumen
                </span>
                <h1 class="text-2xl font-extrabold mt-2 flex items-center gap-2">
                    <span class="iconify" data-icon="mdi:file-certificate-outline"></span>
                    Verifikasi Dokumen Calon Siswa/Santri Baru
                </h1>
                <p class="text-emerald-100 text-xs mt-1">
                    Validasi keabsahan dokumen persyaratan (Kartu Keluarga, Akta Kelahiran, Ijazah/SKL, dan Pas Foto) sebelum menerbitkan akun santri.
                </p>
            </div>
            <a href="{{ route('admin.pendaftar.index') }}" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-2">
                <span class="iconify text-base" data-icon="mdi:account-group"></span>
                Semua Pendaftar
            </a>
        </div>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl shadow-sm flex items-center gap-3">
            <span class="iconify text-2xl text-green-600" data-icon="mdi:check-circle-outline"></span>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Card Table Verifikasi -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h3 class="font-extrabold text-gray-800 text-base">Daftar Antrean Berkas Calon Santri</h3>
                <p class="text-xs text-gray-500 mt-0.5">Total pendaftar terdaftar: {{ $pendaftar->count() }} orang</p>
            </div>
        </div>

        @if($pendaftar->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="py-3.5 px-4">Calon Siswa / Santri</th>
                            <th class="py-3.5 px-4">NIK / NISN</th>
                            <th class="py-3.5 px-4">Jenjang & Sekolah Asal</th>
                            <th class="py-3.5 px-4 text-center">Kelengkapan Berkas</th>
                            <th class="py-3.5 px-4 text-center">Status Verifikasi</th>
                            <th class="py-3.5 px-4 text-center">Aksi Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700">
                        @foreach($pendaftar as $item)
                        @php
                            $nama = $item->nama ?? $item->nama_lengkap ?? 'Tanpa Nama';
                            $kk = $item->file_kk ?? $item->kk ?? null;
                            $akta = $item->file_akta ?? $item->akta ?? null;
                            $ijazah = $item->file_ijazah ?? $item->ijazah ?? null;
                            $foto = $item->file_foto ?? null;
                            $st = $item->status ?? 'Pending';
                        @endphp
                        <tr class="hover:bg-green-50/50 transition">
                            <!-- Nama Santri -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($nama, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $nama }}</div>
                                        <div class="text-xs text-gray-400">{{ $item->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- NIK / NISN -->
                            <td class="py-3.5 px-4 font-mono text-xs">
                                <div><span class="text-gray-400">NIK:</span> {{ $item->nik ?? '-' }}</div>
                                <div><span class="text-gray-400">NISN:</span> {{ $item->nisn ?? '-' }}</div>
                            </td>

                            <!-- Jenjang & Asal Sekolah -->
                            <td class="py-3.5 px-4 text-xs">
                                <div class="font-semibold text-emerald-800">{{ $item->jenjang ?? 'SMP' }}</div>
                                <div class="text-gray-500">{{ $item->asal_sekolah ?? '-' }}</div>
                            </td>

                            <!-- Kelengkapan Berkas Mini Badges -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-1.5 flex-wrap justify-center">
                                    <span title="Kartu Keluarga" class="px-2 py-0.5 rounded text-[10px] font-bold {{ $kk ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-gray-100 text-gray-400' }}">
                                        KK {{ $kk ? '✓' : '✗' }}
                                    </span>
                                    <span title="Akta Kelahiran" class="px-2 py-0.5 rounded text-[10px] font-bold {{ $akta ? 'bg-blue-100 text-blue-800 border border-blue-300' : 'bg-gray-100 text-gray-400' }}">
                                        Akta {{ $akta ? '✓' : '✗' }}
                                    </span>
                                    <span title="Ijazah / SKL" class="px-2 py-0.5 rounded text-[10px] font-bold {{ $ijazah ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-gray-100 text-gray-400' }}">
                                        Ijazah {{ $ijazah ? '✓' : '✗' }}
                                    </span>
                                    <span title="Pas Foto" class="px-2 py-0.5 rounded text-[10px] font-bold {{ $foto ? 'bg-purple-100 text-purple-800 border border-purple-300' : 'bg-gray-100 text-gray-400' }}">
                                        Foto {{ $foto ? '✓' : '✗' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="py-3.5 px-4 text-center">
                                @if($st === 'Terverifikasi' || $st === 'settlement')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 border border-green-300">
                                        <span class="iconify" data-icon="mdi:check-circle"></span> Terverifikasi
                                    </span>
                                @elseif($st === 'Ditolak')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800 border border-red-300">
                                        <span class="iconify" data-icon="mdi:close-circle"></span> Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                        <span class="iconify" data-icon="mdi:clock-outline"></span> Pending
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi Pemeriksaan -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center justify-center gap-1.5 flex-wrap">
                                    {{-- Tombol Buka Modal Berkas --}}
                                    <button type="button"
                                        @click="
                                            selectedData = {
                                                id: '{{ $item->id }}',
                                                nama: '{{ addslashes($nama) }}',
                                                email: '{{ addslashes($item->email ?? '-') }}',
                                                telepon: '{{ $item->no_hp ?? '-' }}',
                                                nik: '{{ $item->nik ?? '-' }}',
                                                nisn: '{{ $item->nisn ?? '-' }}',
                                                jenjang: '{{ $item->jenjang ?? '-' }}',
                                                asalSekolah: '{{ addslashes($item->asal_sekolah ?? '-') }}',
                                                kk: '{{ $kk ? asset('storage/' . $kk) : '' }}',
                                                akta: '{{ $akta ? asset('storage/' . $akta) : '' }}',
                                                ijazah: '{{ $ijazah ? asset('storage/' . $ijazah) : '' }}',
                                                foto: '{{ $foto ? asset('storage/' . $foto) : '' }}',
                                                status: '{{ $st }}',
                                                updateUrl: '{{ route('admin.pendaftar.updateStatus', $item->id) }}'
                                            };
                                            showModal = true;
                                        "
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-xs font-bold shadow transition transform hover:-translate-y-0.5">
                                        <span class="iconify text-sm" data-icon="mdi:file-search-outline"></span>
                                        Lihat Berkas
                                    </button>

                                    <!-- Quick Verifikasi -->
                                    <form action="{{ route('admin.pendaftar.updateStatus', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="Terverifikasi">
                                        <button type="submit" title="Verifikasi dokumen"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-bold shadow transition">
                                            <span class="iconify" data-icon="mdi:check"></span> Sah
                                        </button>
                                    </form>

                                    <!-- Quick Tolak -->
                                    <form action="{{ route('admin.pendaftar.updateStatus', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak kelengkapan berkas untuk pendaftar ini?')">
                                        @csrf
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button type="submit" title="Tolak dokumen"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-bold shadow transition">
                                            <span class="iconify" data-icon="mdi:close"></span>
                                        </button>
                                    </form>

                                    <!-- Detail Link -->
                                    <a href="{{ route('admin.pendaftar.show', $item->id) }}" title="Lihat detail lengkap formulir"
                                        class="inline-flex items-center px-2 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-medium transition">
                                        <span class="iconify text-base" data-icon="mdi:chevron-right"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <span class="iconify text-5xl text-gray-300 mx-auto mb-3" data-icon="mdi:file-document-check-outline"></span>
                <p class="text-base font-bold text-gray-700">Tidak ada pendaftar yang perlu diverifikasi</p>
                <p class="text-xs text-gray-400 mt-1">Data pendaftaran baru dari calon siswa akan otomatis tampil di sini.</p>
            </div>
        @endif
    </div>

    {{-- ======================================================== --}}
    {{-- MODAL PRATINJAU BERKAS LENGKAP DENGAN GAMBAR / PDF      --}}
    {{-- ======================================================== --}}
    <div x-show="showModal" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-sm z-50 p-4" style="display: none;">
        <div @click.away="showModal = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] flex flex-col overflow-hidden animate-pop-up">
            
            <!-- Modal Header -->
            <div class="p-5 border-b border-gray-200 bg-gray-50 flex items-center justify-between flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center">
                        <span class="iconify text-2xl" data-icon="mdi:folder-open"></span>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-gray-800 flex items-center gap-2">
                            <span>Pratinjau Berkas Pendaftar:</span>
                            <span class="text-indigo-600" x-text="selectedData.nama"></span>
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            NIK: <span class="font-mono font-semibold" x-text="selectedData.nik"></span> | 
                            Jenjang: <span class="font-semibold text-emerald-700" x-text="selectedData.jenjang"></span> | 
                            Asal Sekolah: <span class="font-semibold" x-text="selectedData.asalSekolah"></span>
                        </p>
                    </div>
                </div>
                <button @click="showModal = false" class="p-2 text-gray-400 hover:text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    <span class="iconify text-2xl" data-icon="mdi:close"></span>
                </button>
            </div>

            <!-- Modal Body (Scrollable Grid Berkas) -->
            <div class="p-6 overflow-y-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- 1. KARTU KELUARGA (KK) -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 flex flex-col justify-between shadow-sm hover:border-emerald-300 transition">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs uppercase tracking-wider text-emerald-800 flex items-center gap-1">
                                    <span class="iconify text-sm" data-icon="mdi:file-document-outline"></span> Kartu Keluarga
                                </span>
                                <template x-if="selectedData.kk">
                                    <span class="px-2 py-0.5 bg-green-100 text-green-800 text-[10px] font-bold rounded-full">Ada</span>
                                </template>
                            </div>

                            <template x-if="selectedData.kk">
                                <div class="mt-2">
                                    <!-- Jika Gambar -->
                                    <template x-if="isImage(selectedData.kk)">
                                        <div class="bg-white rounded-xl border border-gray-200 p-2 shadow-inner overflow-hidden">
                                            <img :src="selectedData.kk" alt="Kartu Keluarga" class="w-full h-56 object-contain rounded-lg hover:scale-105 transition cursor-pointer" @click="window.open(selectedData.kk, '_blank')" />
                                        </div>
                                    </template>
                                    <!-- Jika PDF -->
                                    <template x-if="!isImage(selectedData.kk)">
                                        <div class="bg-white rounded-xl border border-gray-200 p-2 shadow-inner">
                                            <iframe :src="selectedData.kk" class="w-full h-56 rounded-lg border"></iframe>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="!selectedData.kk">
                                <div class="h-56 flex flex-col items-center justify-center bg-gray-100 rounded-xl border border-dashed border-gray-300 text-gray-400 p-4 text-center">
                                    <span class="iconify text-4xl mb-2" data-icon="mdi:file-cancel-outline"></span>
                                    <span class="text-xs font-semibold">KK Belum Diunggah</span>
                                </div>
                            </template>
                        </div>

                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <template x-if="selectedData.kk">
                                <a :href="selectedData.kk" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shadow-sm">
                                    <span class="iconify text-sm" data-icon="mdi:open-in-new"></span>
                                    Buka File Asli
                                </a>
                            </template>
                            <template x-if="!selectedData.kk">
                                <span class="block text-center text-[11px] text-gray-400 italic">Tidak tersedia</span>
                            </template>
                        </div>
                    </div>

                    <!-- 2. AKTA KELAHIRAN -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 flex flex-col justify-between shadow-sm hover:border-blue-300 transition">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs uppercase tracking-wider text-blue-800 flex items-center gap-1">
                                    <span class="iconify text-sm" data-icon="mdi:certificate-outline"></span> Akta Kelahiran
                                </span>
                                <template x-if="selectedData.akta">
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-800 text-[10px] font-bold rounded-full">Ada</span>
                                </template>
                            </div>

                            <template x-if="selectedData.akta">
                                <div class="mt-2">
                                    <!-- Jika Gambar -->
                                    <template x-if="isImage(selectedData.akta)">
                                        <div class="bg-white rounded-xl border border-gray-200 p-2 shadow-inner overflow-hidden">
                                            <img :src="selectedData.akta" alt="Akta Kelahiran" class="w-full h-56 object-contain rounded-lg hover:scale-105 transition cursor-pointer" @click="window.open(selectedData.akta, '_blank')" />
                                        </div>
                                    </template>
                                    <!-- Jika PDF -->
                                    <template x-if="!isImage(selectedData.akta)">
                                        <div class="bg-white rounded-xl border border-gray-200 p-2 shadow-inner">
                                            <iframe :src="selectedData.akta" class="w-full h-56 rounded-lg border"></iframe>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="!selectedData.akta">
                                <div class="h-56 flex flex-col items-center justify-center bg-gray-100 rounded-xl border border-dashed border-gray-300 text-gray-400 p-4 text-center">
                                    <span class="iconify text-4xl mb-2" data-icon="mdi:file-cancel-outline"></span>
                                    <span class="text-xs font-semibold">Akta Belum Diunggah</span>
                                </div>
                            </template>
                        </div>

                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <template x-if="selectedData.akta">
                                <a :href="selectedData.akta" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition shadow-sm">
                                    <span class="iconify text-sm" data-icon="mdi:open-in-new"></span>
                                    Buka File Asli
                                </a>
                            </template>
                            <template x-if="!selectedData.akta">
                                <span class="block text-center text-[11px] text-gray-400 italic">Tidak tersedia</span>
                            </template>
                        </div>
                    </div>

                    <!-- 3. IJAZAH / SKL -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 flex flex-col justify-between shadow-sm hover:border-amber-300 transition">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs uppercase tracking-wider text-amber-800 flex items-center gap-1">
                                    <span class="iconify text-sm" data-icon="mdi:school-outline"></span> Ijazah / SKL
                                </span>
                                <template x-if="selectedData.ijazah">
                                    <span class="px-2 py-0.5 bg-amber-100 text-amber-800 text-[10px] font-bold rounded-full">Ada</span>
                                </template>
                            </div>

                            <template x-if="selectedData.ijazah">
                                <div class="mt-2">
                                    <!-- Jika Gambar -->
                                    <template x-if="isImage(selectedData.ijazah)">
                                        <div class="bg-white rounded-xl border border-gray-200 p-2 shadow-inner overflow-hidden">
                                            <img :src="selectedData.ijazah" alt="Ijazah" class="w-full h-56 object-contain rounded-lg hover:scale-105 transition cursor-pointer" @click="window.open(selectedData.ijazah, '_blank')" />
                                        </div>
                                    </template>
                                    <!-- Jika PDF -->
                                    <template x-if="!isImage(selectedData.ijazah)">
                                        <div class="bg-white rounded-xl border border-gray-200 p-2 shadow-inner">
                                            <iframe :src="selectedData.ijazah" class="w-full h-56 rounded-lg border"></iframe>
                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="!selectedData.ijazah">
                                <div class="h-56 flex flex-col items-center justify-center bg-gray-100 rounded-xl border border-dashed border-gray-300 text-gray-400 p-4 text-center">
                                    <span class="iconify text-4xl mb-2" data-icon="mdi:file-cancel-outline"></span>
                                    <span class="text-xs font-semibold">Ijazah Belum Diunggah</span>
                                </div>
                            </template>
                        </div>

                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <template x-if="selectedData.ijazah">
                                <a :href="selectedData.ijazah" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-xs font-bold transition shadow-sm">
                                    <span class="iconify text-sm" data-icon="mdi:open-in-new"></span>
                                    Buka File Asli
                                </a>
                            </template>
                            <template x-if="!selectedData.ijazah">
                                <span class="block text-center text-[11px] text-gray-400 italic">Tidak tersedia</span>
                            </template>
                        </div>
                    </div>

                    <!-- 4. PAS FOTO FORMAL -->
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 flex flex-col justify-between shadow-sm hover:border-purple-300 transition">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs uppercase tracking-wider text-purple-800 flex items-center gap-1">
                                    <span class="iconify text-sm" data-icon="mdi:camera-account"></span> Pas Foto Formal
                                </span>
                                <template x-if="selectedData.foto">
                                    <span class="px-2 py-0.5 bg-purple-100 text-purple-800 text-[10px] font-bold rounded-full">Ada</span>
                                </template>
                            </div>

                            <template x-if="selectedData.foto">
                                <div class="mt-2 bg-white rounded-xl border border-gray-200 p-2 shadow-inner overflow-hidden flex items-center justify-center">
                                    <img :src="selectedData.foto" alt="Pas Foto" class="h-56 w-auto max-w-full object-contain rounded-lg hover:scale-105 transition cursor-pointer" @click="window.open(selectedData.foto, '_blank')" />
                                </div>
                            </template>

                            <template x-if="!selectedData.foto">
                                <div class="h-56 flex flex-col items-center justify-center bg-gray-100 rounded-xl border border-dashed border-gray-300 text-gray-400 p-4 text-center">
                                    <span class="iconify text-4xl mb-2" data-icon="mdi:camera-off-outline"></span>
                                    <span class="text-xs font-semibold">Foto Belum Diunggah</span>
                                </div>
                            </template>
                        </div>

                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <template x-if="selectedData.foto">
                                <a :href="selectedData.foto" target="_blank" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-xs font-bold transition shadow-sm">
                                    <span class="iconify text-sm" data-icon="mdi:open-in-new"></span>
                                    Buka Foto Asli
                                </a>
                            </template>
                            <template x-if="!selectedData.foto">
                                <span class="block text-center text-[11px] text-gray-400 italic">Tidak tersedia</span>
                            </template>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal Footer (Tombol Aksi Cepat) -->
            <div class="p-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-3 flex-shrink-0">
                <div class="text-xs text-gray-500">
                    Status saat ini: <strong class="uppercase text-gray-700" x-text="selectedData.status"></strong>
                </div>

                <div class="flex items-center gap-2">
                    <!-- Form Verifikasi dari dalam modal -->
                    <form :action="selectedData.updateUrl" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="Terverifikasi">
                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs shadow transition flex items-center gap-1.5">
                            <span class="iconify text-base" data-icon="mdi:check-decagram"></span>
                            Nyatakan Sah & Verifikasi
                        </button>
                    </form>

                    <!-- Form Tolak dari dalam modal -->
                    <form :action="selectedData.updateUrl" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menolak kelengkapan berkas santri ini?')">
                        @csrf
                        <input type="hidden" name="status" value="Ditolak">
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-xs shadow transition flex items-center gap-1.5">
                            <span class="iconify text-base" data-icon="mdi:close-circle"></span>
                            Tolak Dokumen
                        </button>
                    </form>

                    <!-- Tutup -->
                    <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl text-xs transition">
                        Tutup
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes pop-up {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-pop-up { animation: pop-up 0.25s ease-out; }
</style>
@endsection
