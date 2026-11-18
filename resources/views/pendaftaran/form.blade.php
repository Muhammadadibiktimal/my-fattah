@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gray-50/70 dark:bg-gray-900/60 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/80 dark:border-gray-700 p-6 sm:p-8 mb-8 text-center relative overflow-hidden">
            <div class="inline-flex items-center justify-center p-3 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 mb-3 border border-emerald-200/60 dark:border-emerald-800/40">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Pondok Pesantren Al-Fattah" class="h-14 w-14 object-contain">
            </div>

            <div>
                <span class="inline-block px-3.5 py-1 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 text-xs font-bold rounded-md uppercase tracking-wider mb-2">
                    Penerimaan Santri Baru (PSB) TA 2026/2027
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">
                Formulir Pendaftaran Calon Siswa / Santri Baru
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mt-2 leading-relaxed">
                Pondok Pesantren Al-Fattah Tigaraksa. Silakan lengkapi biodata calon santri, asal sekolah, kontak orang tua, serta lampirkan berkas dokumen persyaratan di bawah ini.
            </p>

            <!-- Stepper Alur Pendaftaran Resmi (4 Tahapan) -->
            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-left">
                    <!-- Step 1 (Aktif Saat Ini) -->
                    <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-300 dark:border-emerald-700">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center">1</span>
                            <span class="text-xs font-bold text-emerald-900 dark:text-emerald-300">Isi Formulir</span>
                        </div>
                        <p class="text-[11px] text-emerald-700 dark:text-emerald-400">Biodata & upload berkas</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 opacity-90">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold text-xs flex items-center justify-center">2</span>
                            <span class="text-xs font-bold text-gray-800 dark:text-gray-200">Verifikasi Dokumen</span>
                        </div>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400">Pemeriksaan oleh Panitia</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 opacity-90">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold text-xs flex items-center justify-center">3</span>
                            <span class="text-xs font-bold text-gray-800 dark:text-gray-200">Pembayaran Midtrans</span>
                        </div>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400">Infaq Rp 200rb (via QRIS/VA)</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 opacity-90">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold text-xs flex items-center justify-center">4</span>
                            <span class="text-xs font-bold text-gray-800 dark:text-gray-200">Terbit Akun Santri</span>
                        </div>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400">Notifikasi WA & Kredensial</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notifikasi Validasi Form --}}
        @if (isset($errors) && $errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-950/40 border-l-4 border-red-500 p-4 rounded-xl text-red-700 dark:text-red-300 shadow-sm" role="alert">
                <div class="flex items-center gap-2 font-bold mb-1 text-sm">
                    <span class="iconify text-lg" data-icon="mdi:alert-circle"></span>
                    <span>Mohon periksa dan lengkapi bagian formulir berikut:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Pendaftaran --}}
        <form action="{{ route('pendaftaran.bayar') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- SECTION 1: DATA DIRI CALON SANTRI -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/80 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center">
                        <span class="iconify text-2xl" data-icon="mdi:account-school-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">1. Data Diri Calon Santri</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Identitas resmi calon siswa/santri sesuai akta kelahiran atau ijazah.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nama Lengkap Calon Santri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                               placeholder="Nama lengkap sesuai ijazah / akta lahir"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>

                    <!-- NIK & NISN -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                NIK (Nomor Induk Kependudukan)
                            </label>
                            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16"
                                   placeholder="16 digit NIK santri di KK"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                NISN (Nomor Induk Siswa Nasional)
                            </label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" maxlength="10"
                                   placeholder="10 digit NISN santri"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-mono">
                        </div>
                    </div>

                    <!-- Tempat & Tanggal Lahir -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Tempat Lahir
                            </label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                   placeholder="Kota / Kabupaten Kelahiran"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                    </div>

                    <!-- Jenis Kelamin & Pilihan Jenjang -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Santri Putra)</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Santri Putri)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Jenjang Pendidikan yang Dituju <span class="text-red-500">*</span>
                            </label>
                            <select name="jenjang" id="jenjangSelect" required onchange="handleJenjangChange()"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-semibold">
                                <option value="">-- Pilih Jenjang Sekolah --</option>
                                <option value="SMP Al-Fattah" {{ old('jenjang') == 'SMP Al-Fattah' ? 'selected' : '' }}>SMP Al-Fattah (Boarding / Pesantren)</option>
                                <option value="SMA Al-Fattah" {{ old('jenjang') == 'SMA Al-Fattah' ? 'selected' : '' }}>SMA Al-Fattah (Sekolah Menengah Atas)</option>
                                <option value="SMK Al-Fattah" {{ old('jenjang', 'SMK Al-Fattah') == 'SMK Al-Fattah' ? 'selected' : '' }}>SMK Al-Fattah (Sekolah Menengah Kejuruan)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pilihan Jurusan / Peminatan Dinamis -->
                    <div id="jurusanWrapper" class="p-4 bg-emerald-50/60 dark:bg-gray-750 rounded-xl border border-emerald-200 dark:border-gray-600 transition-all">
                        <label class="block text-xs font-bold uppercase tracking-wider text-emerald-900 dark:text-emerald-300 mb-1.5 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <span class="iconify text-base text-emerald-600" data-icon="mdi:compass-outline"></span>
                                <span>Peminatan / Jurusan Keahlian <span class="text-red-500">*</span></span>
                            </span>
                            <span id="jenjangBadge" class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-200 text-emerald-900">
                                Sesuai Pilihan Sekolah
                            </span>
                        </label>
                        <select name="jurusan" id="jurusanSelect" required
                                class="w-full px-4 py-3 rounded-xl border border-emerald-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-medium">
                            <!-- Diisi secara dinamis oleh JavaScript -->
                        </select>
                        <p class="text-xs text-emerald-700 dark:text-emerald-400 mt-1.5 flex items-center gap-1">
                            <span class="iconify" data-icon="mdi:information-outline"></span>
                            <span>Pilih konsentrasi program yang sesuai dengan minat dan potensi calon santri.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: DATA ASAL SEKOLAH -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/80 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 rounded-xl flex items-center justify-center">
                        <span class="iconify text-2xl" data-icon="mdi:domain"></span>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">2. Data Riwayat Asal Sekolah</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Informasi sekolah atau madrasah pada jenjang sebelumnya.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nama Asal Sekolah / Madrasah
                        </label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                               placeholder="contoh: SDN 1 Tigaraksa / MIS Nurul Falah"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Alamat / Kota Asal Sekolah
                        </label>
                        <input type="text" name="alamat_sekolah" value="{{ old('alamat_sekolah') }}"
                               placeholder="contoh: Kec. Tigaraksa, Kab. Tangerang"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: DATA ORANG TUA / WALI & ALAMAT -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/80 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-400 rounded-xl flex items-center justify-center">
                        <span class="iconify text-2xl" data-icon="mdi:account-group-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">3. Data Orang Tua / Wali & Tempat Tinggal</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Informasi orang tua atau wali santri yang dapat dihubungi panitia.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Ayah -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Nama Ayah Kandung
                            </label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}"
                                   placeholder="Nama lengkap ayah"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Pekerjaan Ayah
                            </label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                                   placeholder="PNS, Wiraswasta, Karyawan, dsb"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                    </div>

                    <!-- Ibu -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Nama Ibu Kandung
                            </label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}"
                                   placeholder="Nama lengkap ibu"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Pekerjaan Ibu
                            </label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                                   placeholder="Ibu Rumah Tangga, PNS, Wiraswasta, dsb"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                    </div>

                    <!-- No HP Ortu -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nomor WhatsApp / Telepon Orang Tua
                        </label>
                        <input type="text" name="no_hp_ortu" value="{{ old('no_hp_ortu') }}"
                               placeholder="contoh: 081234567890"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-mono">
                    </div>

                    <!-- Alamat Lengkap -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Alamat Tempat Tinggal Lengkap
                        </label>
                        <textarea name="alamat" rows="3"
                                  placeholder="Jalan, No. Rumah, RT/RW, Dusun/Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: KONTAK UTAMA & AKUN LOGIN -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/80 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-950/60 text-purple-700 dark:text-purple-400 rounded-xl flex items-center justify-center">
                        <span class="iconify text-2xl" data-icon="mdi:card-account-mail-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">4. Kontak Calon Santri (Kredensial Akun)</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Email dan WhatsApp ini akan digunakan untuk pembuatan akun login portal santri.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Alamat Email Aktif <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="santri@email.com"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nomor WhatsApp / HP Calon Santri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}" required
                               placeholder="contoh: 081234567890"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 outline-none text-sm font-mono">
                    </div>
                </div>
            </div>

            <!-- SECTION 5: LAMPIRAN DOKUMEN -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200/80 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center">
                        <span class="iconify text-2xl" data-icon="mdi:file-upload-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">5. Unggah Berkas Dokumen Persyaratan</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Format yang diterima: PDF, JPG, atau PNG (Maksimal 5MB per file).</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Kartu Keluarga -->
                    <div id="card_file_kk" class="p-4 bg-gray-50 dark:bg-gray-750 rounded-xl border border-gray-200 dark:border-gray-600 transition-all duration-300">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <span class="iconify text-lg text-emerald-700 dark:text-emerald-400" data-icon="mdi:file-document-outline"></span>
                                <span>Kartu Keluarga (KK)</span>
                            </span>
                            <span id="badge_file_kk" class="hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/80 dark:text-emerald-200 items-center gap-1">
                                <span class="iconify" data-icon="mdi:check-circle"></span> Berhasil Dipilih
                            </span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Scan atau foto jelas KK asli (Maks. 5MB)</p>
                        <input type="file" name="file_kk" id="input_file_kk" accept=".pdf,.jpg,.jpeg,.png"
                               onchange="handleFileUploadNotice(this, 'file_kk')"
                               class="w-full text-xs text-gray-600 dark:text-gray-300 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 dark:file:bg-emerald-950 file:text-emerald-800 dark:file:text-emerald-300 hover:file:bg-emerald-200 cursor-pointer">
                        <div id="info_file_kk" class="hidden mt-2 p-2 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-lg text-xs text-emerald-900 dark:text-emerald-200 flex items-center justify-between gap-2">
                            <span class="truncate flex items-center gap-1.5">
                                <span class="iconify text-emerald-600 text-base shrink-0" data-icon="mdi:file-check"></span>
                                <span class="filename font-semibold truncate"></span>
                                <span class="filesize text-[10px] text-emerald-700 dark:text-emerald-400 shrink-0"></span>
                            </span>
                            <button type="button" onclick="clearUploadedFile('file_kk')" class="text-red-500 hover:text-red-700 text-xs shrink-0 font-bold ml-1">✕</button>
                        </div>
                    </div>

                    <!-- Akta Kelahiran -->
                    <div id="card_file_akta" class="p-4 bg-gray-50 dark:bg-gray-750 rounded-xl border border-gray-200 dark:border-gray-600 transition-all duration-300">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <span class="iconify text-lg text-emerald-700 dark:text-emerald-400" data-icon="mdi:certificate-outline"></span>
                                <span>Akta Kelahiran</span>
                            </span>
                            <span id="badge_file_akta" class="hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/80 dark:text-emerald-200 items-center gap-1">
                                <span class="iconify" data-icon="mdi:check-circle"></span> Berhasil Dipilih
                            </span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Scan atau foto jelas akta lahir (Maks. 5MB)</p>
                        <input type="file" name="file_akta" id="input_file_akta" accept=".pdf,.jpg,.jpeg,.png"
                               onchange="handleFileUploadNotice(this, 'file_akta')"
                               class="w-full text-xs text-gray-600 dark:text-gray-300 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 dark:file:bg-emerald-950 file:text-emerald-800 dark:file:text-emerald-300 hover:file:bg-emerald-200 cursor-pointer">
                        <div id="info_file_akta" class="hidden mt-2 p-2 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-lg text-xs text-emerald-900 dark:text-emerald-200 flex items-center justify-between gap-2">
                            <span class="truncate flex items-center gap-1.5">
                                <span class="iconify text-emerald-600 text-base shrink-0" data-icon="mdi:file-check"></span>
                                <span class="filename font-semibold truncate"></span>
                                <span class="filesize text-[10px] text-emerald-700 dark:text-emerald-400 shrink-0"></span>
                            </span>
                            <button type="button" onclick="clearUploadedFile('file_akta')" class="text-red-500 hover:text-red-700 text-xs shrink-0 font-bold ml-1">✕</button>
                        </div>
                    </div>

                    <!-- Ijazah / SKL -->
                    <div id="card_file_ijazah" class="p-4 bg-gray-50 dark:bg-gray-750 rounded-xl border border-gray-200 dark:border-gray-600 transition-all duration-300">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <span class="iconify text-lg text-emerald-700 dark:text-emerald-400" data-icon="mdi:school-outline"></span>
                                <span>Ijazah / SKL (Surat Keterangan Lulus)</span>
                            </span>
                            <span id="badge_file_ijazah" class="hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/80 dark:text-emerald-200 items-center gap-1">
                                <span class="iconify" data-icon="mdi:check-circle"></span> Berhasil Dipilih
                            </span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Scan ijazah atau surat kelulusan sementara (Maks. 5MB)</p>
                        <input type="file" name="file_ijazah" id="input_file_ijazah" accept=".pdf,.jpg,.jpeg,.png"
                               onchange="handleFileUploadNotice(this, 'file_ijazah')"
                               class="w-full text-xs text-gray-600 dark:text-gray-300 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 dark:file:bg-emerald-950 file:text-emerald-800 dark:file:text-emerald-300 hover:file:bg-emerald-200 cursor-pointer">
                        <div id="info_file_ijazah" class="hidden mt-2 p-2 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-lg text-xs text-emerald-900 dark:text-emerald-200 flex items-center justify-between gap-2">
                            <span class="truncate flex items-center gap-1.5">
                                <span class="iconify text-emerald-600 text-base shrink-0" data-icon="mdi:file-check"></span>
                                <span class="filename font-semibold truncate"></span>
                                <span class="filesize text-[10px] text-emerald-700 dark:text-emerald-400 shrink-0"></span>
                            </span>
                            <button type="button" onclick="clearUploadedFile('file_ijazah')" class="text-red-500 hover:text-red-700 text-xs shrink-0 font-bold ml-1">✕</button>
                        </div>
                    </div>

                    <!-- Pas Foto -->
                    <div id="card_file_foto" class="p-4 bg-gray-50 dark:bg-gray-750 rounded-xl border border-gray-200 dark:border-gray-600 transition-all duration-300">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <span class="iconify text-lg text-emerald-700 dark:text-emerald-400" data-icon="mdi:camera-account"></span>
                                <span>Pas Foto Formal Santri (3x4)</span>
                            </span>
                            <span id="badge_file_foto" class="hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/80 dark:text-emerald-200 items-center gap-1">
                                <span class="iconify" data-icon="mdi:check-circle"></span> Berhasil Dipilih
                            </span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Latar belakang merah/biru berbusana muslim rapi (Maks. 3MB)</p>
                        <input type="file" name="file_foto" id="input_file_foto" accept=".jpg,.jpeg,.png"
                               onchange="handleFileUploadNotice(this, 'file_foto')"
                               class="w-full text-xs text-gray-600 dark:text-gray-300 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 dark:file:bg-emerald-950 file:text-emerald-800 dark:file:text-emerald-300 hover:file:bg-emerald-200 cursor-pointer">
                        <div id="info_file_foto" class="hidden mt-2 p-2 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-lg text-xs text-emerald-900 dark:text-emerald-200 flex items-center justify-between gap-2">
                            <span class="truncate flex items-center gap-1.5">
                                <span class="iconify text-emerald-600 text-base shrink-0" data-icon="mdi:file-check"></span>
                                <span class="filename font-semibold truncate"></span>
                                <span class="filesize text-[10px] text-emerald-700 dark:text-emerald-400 shrink-0"></span>
                            </span>
                            <button type="button" onclick="clearUploadedFile('file_foto')" class="text-red-500 hover:text-red-700 text-xs shrink-0 font-bold ml-1">✕</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 6: ALUR BIAYA & PENGIRIMAN FORMULIR -->
            <div class="bg-gradient-to-r from-emerald-900 to-green-950 rounded-2xl shadow-md p-6 sm:p-8 text-white border border-emerald-800">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-emerald-300 font-bold block">
                            Informasi Biaya Pendaftaran Santri Baru
                        </span>
                        <div class="text-2xl sm:text-3xl font-black text-yellow-400 mt-1 font-mono">
                            Rp 200.000
                        </div>
                        <p class="text-xs text-emerald-100 mt-2 max-w-lg leading-relaxed">
                            <strong class="text-white">Alur Pembayaran:</strong> Setelah mengirimkan formulir ini, berkas Anda akan diperiksa oleh Panitia PSB. Pembayaran Midtrans (QRIS, VA Bank) dilakukan pada tahap verifikasi melalui dashboard santri.
                        </p>
                    </div>

                    <div class="w-full md:w-auto shrink-0">
                        <button type="submit"
                                class="w-full md:w-auto px-7 py-3.5 bg-yellow-400 hover:bg-yellow-300 text-gray-950 font-extrabold text-sm sm:text-base rounded-xl shadow-md transition duration-200 flex items-center justify-center gap-2.5">
                            <span class="iconify text-xl" data-icon="mdi:send-check-outline"></span>
                            <span>Kirim Formulir & Ajukan Pendaftaran</span>
                        </button>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-emerald-800/80 flex items-start sm:items-center gap-2 text-xs text-emerald-200">
                    <span class="iconify text-base text-yellow-400 shrink-0 mt-0.5 sm:mt-0" data-icon="mdi:check-decagram-outline"></span>
                    <span>Dengan menekan tombol di atas, saya menyatakan bahwa data dan berkas dokumen yang dilampirkan adalah benar dan sah.</span>
                </div>
            </div>

        </form>

    </div>
</section>

<script>
    const JURUSAN_OPTIONS = {
        'SMP Al-Fattah': [
            { value: 'Reguler & Tahfidz', label: 'Reguler & Tahfidzul Qur\'an (Target 5-10 Juz)' },
            { value: 'Tahfidz Intensif', label: 'Tahfidz Intensif & Bahasa Arab / Inggris' }
        ],
        'SMA Al-Fattah': [
            { value: 'MIPA (Matematika & Ilmu Alam)', label: 'MIPA (Matematika & Ilmu Pengetahuan Alam)' },
            { value: 'IPS (Ilmu Sosial)', label: 'IPS (Ilmu Pengetahuan Sosial & Humaniora)' },
            { value: 'Ilmu Keagamaan (IIK)', label: 'Keagamaan / IIK (Kitab Kuning & Dirasah Islamiyah)' }
        ],
        'SMK Al-Fattah': [
            { value: 'Multimedia & DKV', label: 'Desain Komunikasi Visual (DKV) & Multimedia' },
            { value: 'Teknik Komputer & Jaringan (TKJ)', label: 'Teknik Komputer & Jaringan (TKJ)' },
            { value: 'Rekayasa Perangkat Lunak (RPL)', label: 'Rekayasa Perangkat Lunak (RPL)' }
        ]
    };

    function handleJenjangChange(selectedJurusan = null) {
        const jenjang = document.getElementById('jenjangSelect').value;
        const jurusanSelect = document.getElementById('jurusanSelect');
        const badge = document.getElementById('jenjangBadge');

        jurusanSelect.innerHTML = '';

        if (!jenjang || !JURUSAN_OPTIONS[jenjang]) {
            badge.innerText = 'Pilih jenjang terlebih dahulu';
            jurusanSelect.innerHTML = '<option value="">-- Pilih Jenjang Sekolah Terlebih Dahulu --</option>';
            return;
        }

        badge.innerText = jenjang;
        const options = JURUSAN_OPTIONS[jenjang];

        options.forEach(opt => {
            const el = document.createElement('option');
            el.value = opt.value;
            el.textContent = opt.label;
            if (selectedJurusan && selectedJurusan === opt.value) {
                el.selected = true;
            }
            jurusanSelect.appendChild(el);
        });

        if (!jurusanSelect.value && options.length > 0) {
            jurusanSelect.value = options[0].value;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const currentOldJurusan = @json(old('jurusan', 'Multimedia & DKV'));
        handleJenjangChange(currentOldJurusan);
    });

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    function handleFileUploadNotice(input, fieldKey) {
        const card = document.getElementById('card_' + fieldKey);
        const badge = document.getElementById('badge_' + fieldKey);
        const info = document.getElementById('info_' + fieldKey);

        if (!card || !badge || !info) return;

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxMB = (fieldKey === 'file_foto') ? 3 : 5;
            const maxBytes = maxMB * 1024 * 1024;

            if (file.size > maxBytes) {
                alert(`⚠️ Ukuran file terlalu besar (${formatFileSize(file.size)}). Maksimal ukuran file adalah ${maxMB}MB.`);
                input.value = '';
                clearUploadedFile(fieldKey);
                return;
            }

            // Tampilkan card visual sukses
            card.classList.remove('bg-gray-50', 'dark:bg-gray-750', 'border-gray-200', 'dark:border-gray-600');
            card.classList.add('bg-emerald-50/70', 'dark:bg-emerald-950/30', 'border-emerald-300', 'dark:border-emerald-700');

            badge.classList.remove('hidden');
            badge.classList.add('inline-flex');

            info.classList.remove('hidden');
            info.querySelector('.filename').textContent = file.name;
            info.querySelector('.filesize').textContent = `(${formatFileSize(file.size)})`;
        } else {
            clearUploadedFile(fieldKey);
        }
    }

    function clearUploadedFile(fieldKey) {
        const input = document.getElementById('input_' + fieldKey);
        const card = document.getElementById('card_' + fieldKey);
        const badge = document.getElementById('badge_' + fieldKey);
        const info = document.getElementById('info_' + fieldKey);

        if (input) input.value = '';
        if (card) {
            card.classList.remove('bg-emerald-50/70', 'dark:bg-emerald-950/30', 'border-emerald-300', 'dark:border-emerald-700');
            card.classList.add('bg-gray-50', 'dark:bg-gray-750', 'border-gray-200', 'dark:border-gray-600');
        }
        if (badge) {
            badge.classList.add('hidden');
            badge.classList.remove('inline-flex');
        }
        if (info) {
            info.classList.add('hidden');
        }
    }
</script>
@endsection
