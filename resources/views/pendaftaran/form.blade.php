@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-gradient-to-b from-green-50 via-white to-green-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-green-100 dark:border-gray-700 p-8 mb-8 text-center relative overflow-hidden">
            <!-- Decorative gradient top line -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-green-600 via-yellow-500 to-emerald-600"></div>

            <div class="inline-flex items-center justify-center p-3 rounded-2xl bg-green-50 dark:bg-gray-700 mb-4 shadow-sm border border-green-200/50">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Ponpes Al-Fattah" class="h-16 w-16 object-contain">
            </div>

            <span class="inline-block px-3.5 py-1 bg-green-100 dark:bg-green-950/50 text-green-800 dark:text-green-300 text-xs font-bold rounded-full uppercase tracking-wider mb-2">
                Penerimaan Santri Baru (PSB) TA 2026/2027
            </span>

            <h1 class="text-2xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                Formulir Pendaftaran Siswa / Santri Baru
            </h1>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mt-2 leading-relaxed">
                Pondok Pesantren Al-Fattah Tigaraksa. Silakan lengkapi biodata calon santri, asal sekolah, data orang tua, serta lampirkan berkas dokumen persyaratan di bawah ini.
            </p>

            <!-- Stepper Alur Pendaftaran -->
            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 grid grid-cols-3 gap-2 text-center text-xs">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white font-bold flex items-center justify-center shadow-md">1</div>
                    <span class="font-bold text-green-700 dark:text-green-400 mt-1.5">Lengkapi Formulir & Berkas</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-800 font-bold flex items-center justify-center border border-yellow-300">2</div>
                    <span class="text-gray-500 dark:text-gray-400 mt-1.5">Pembayaran Midtrans (Rp 200rb)</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 font-bold flex items-center justify-center">3</div>
                    <span class="text-gray-400 mt-1.5">Akun Terbit & Verifikasi</span>
                </div>
            </div>
        </div>

        {{-- Notifikasi Error --}}
        @if (isset($errors) && $errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-950/40 border-l-4 border-red-500 p-4 rounded-xl text-red-700 dark:text-red-300 shadow-sm" role="alert">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <span class="iconify text-lg" data-icon="mdi:alert-circle"></span>
                    <span>Mohon lengkapi formulir dengan benar:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Pendaftaran Lengkap --}}
        <form action="{{ route('pendaftaran.bayar') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- SECTION 1: DATA PRIBADI CALON SANTRI -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="p-2.5 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 rounded-xl">
                        <span class="iconify text-2xl" data-icon="mdi:account-school-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">1. Data Diri Calon Santri</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Informasi identitas pribadi calon siswa/santri.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                               placeholder="Nama lengkap sesuai ijazah / akta lahir"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                    </div>

                    <!-- NIK & NISN -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                NIK (Nomor Induk Kependudukan)
                            </label>
                            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16"
                                   placeholder="16 digit NIK santri di KK"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                NISN (Nomor Induk Siswa Nasional)
                            </label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" maxlength="10"
                                   placeholder="10 digit NISN santri"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm font-mono">
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
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                        </div>
                    </div>

                    <!-- Jenis Kelamin, Pilihan Jenjang & Jurusan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Santri Putra)</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Santri Putri)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Jenjang Pendidikan yang Dituju <span class="text-red-500">*</span>
                            </label>
                            <select name="jenjang" id="jenjangSelect" required onchange="handleJenjangChange()"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm font-semibold">
                                <option value="">-- Pilih Jenjang Sekolah --</option>
                                <option value="SMP Al-Fattah" {{ old('jenjang') == 'SMP Al-Fattah' ? 'selected' : '' }}>SMP Al-Fattah (Boarding / Pesantren)</option>
                                <option value="SMA Al-Fattah" {{ old('jenjang') == 'SMA Al-Fattah' ? 'selected' : '' }}>SMA Al-Fattah (Sekolah Menengah Atas)</option>
                                <option value="SMK Al-Fattah" {{ old('jenjang', 'SMK Al-Fattah') == 'SMK Al-Fattah' ? 'selected' : '' }}>SMK Al-Fattah (Sekolah Menengah Kejuruan)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pilihan Jurusan / Peminatan Dinamis -->
                    <div id="jurusanWrapper" class="p-4 bg-green-50/70 dark:bg-gray-700/60 rounded-2xl border border-green-200 dark:border-gray-600 transition-all">
                        <label class="block text-xs font-bold uppercase tracking-wider text-green-900 dark:text-green-300 mb-1.5 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <span class="iconify text-base text-green-600" data-icon="mdi:compass-outline"></span>
                                <span>Peminatan / Jurusan Keahlian <span class="text-red-500">*</span></span>
                            </span>
                            <span id="jenjangBadge" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-200 text-green-800">
                                Sesuai Pilihan Sekolah
                            </span>
                        </label>
                        <select name="jurusan" id="jurusanSelect" required
                                class="w-full px-4 py-3 rounded-xl border border-green-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm font-medium">
                            <!-- Populated dynamically via JS -->
                        </select>
                        <p id="jurusanHelp" class="text-xs text-green-700 dark:text-green-300 mt-1.5 flex items-center gap-1">
                            <span class="iconify" data-icon="mdi:information-outline"></span>
                            <span>Pilih peminatan/konsentrasi jurusan yang sesuai dengan bakat dan minat calon santri.</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: ASAL SEKOLAH -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="p-2.5 bg-yellow-100 dark:bg-yellow-900/50 text-yellow-700 dark:text-yellow-300 rounded-xl">
                        <span class="iconify text-2xl" data-icon="mdi:domain"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">2. Data Asal Sekolah</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Informasi riwayat sekolah sebelumnya.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nama Asal Sekolah / Madrasah
                        </label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                               placeholder="contoh: SDN 1 Tigaraksa / MIS Nurul Falah"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Alamat / Kota Asal Sekolah
                        </label>
                        <input type="text" name="alamat_sekolah" value="{{ old('alamat_sekolah') }}"
                               placeholder="contoh: Kec. Tigaraksa, Kab. Tangerang"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: DATA ORANG TUA / WALI & ALAMAT -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="p-2.5 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 rounded-xl">
                        <span class="iconify text-2xl" data-icon="mdi:account-group-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">3. Data Orang Tua / Wali & Tempat Tinggal</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Informasi orang tua atau wali santri yang dapat dihubungi.</p>
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
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Pekerjaan Ayah
                            </label>
                            <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                                   placeholder="PNS, Karyawan Swasta, Wiraswasta, dll"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
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
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Pekerjaan Ibu
                            </label>
                            <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                                   placeholder="Ibu Rumah Tangga, PNS, Pedagang, dll"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                        </div>
                    </div>

                    <!-- No HP Orang Tua -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nomor WhatsApp / Telepon Orang Tua
                        </label>
                        <input type="text" name="no_hp_ortu" value="{{ old('no_hp_ortu') }}"
                               placeholder="contoh: 081234567890"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                    </div>

                    <!-- Alamat Lengkap -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Alamat Tempat Tinggal Lengkap
                        </label>
                        <textarea name="alamat" rows="3"
                                  placeholder="Jalan, No. Rumah, RT/RW, Dusun/Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 4: KONTAK UTAMA & AKUN LOGIN -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="p-2.5 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 rounded-xl">
                        <span class="iconify text-2xl" data-icon="mdi:card-account-mail-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">4. Kontak Calon Santri (Untuk Pembuatan Akun)</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Email ini akan digunakan untuk pengiriman kredensial akun login santri.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Alamat Email Aktif <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="santri@email.com"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                    </div>

                    <!-- Nomor HP Santri -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                            Nomor WhatsApp / HP Santri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}" required
                               placeholder="contoh: 081234567890"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 outline-none text-sm">
                    </div>
                </div>
            </div>

            <!-- SECTION 5: LAMPIRAN DOKUMEN (UPLOAD BERKAS) -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                <div class="flex items-center gap-3 pb-4 mb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="p-2.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-xl">
                        <span class="iconify text-2xl" data-icon="mdi:file-upload-outline"></span>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">5. Unggah Lampiran Dokumen</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Format file: PDF, JPG, atau PNG (Maksimal 5MB per file).</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Kartu Keluarga -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-200 dark:border-gray-600">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1.5">
                            <span class="iconify text-lg text-emerald-600" data-icon="mdi:file-document-outline"></span>
                            <span>Kartu Keluarga (KK)</span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Scan atau foto jelas KK asli</p>
                        <input type="file" name="file_kk" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer">
                    </div>

                    <!-- Akta Kelahiran -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-200 dark:border-gray-600">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1.5">
                            <span class="iconify text-lg text-emerald-600" data-icon="mdi:certificate-outline"></span>
                            <span>Akta Kelahiran</span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Scan atau foto jelas akta lahir</p>
                        <input type="file" name="file_akta" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer">
                    </div>

                    <!-- Ijazah / SKL -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-200 dark:border-gray-600">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1.5">
                            <span class="iconify text-lg text-emerald-600" data-icon="mdi:school-outline"></span>
                            <span>Ijazah / Surat Keterangan Lulus (SKL)</span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Scan ijazah atau surat kelulusan sementara</p>
                        <input type="file" name="file_ijazah" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer">
                    </div>

                    <!-- Pas Foto -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-200 dark:border-gray-600">
                        <label class="block text-xs font-bold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1.5">
                            <span class="iconify text-lg text-emerald-600" data-icon="mdi:camera-account"></span>
                            <span>Pas Foto Formal Santri (3x4)</span>
                        </label>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mb-2">Latar belakang merah/biru rapi berbusana muslim</p>
                        <input type="file" name="file_foto" accept=".jpg,.jpeg,.png"
                               class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- SECTION 6: BIAYA & SUBMISSION -->
            <div class="bg-gradient-to-br from-green-800 to-emerald-900 rounded-3xl shadow-2xl p-6 sm:p-8 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-green-300 font-bold">Biaya Infaq Formulir Pendaftaran</span>
                        <div class="text-3xl sm:text-4xl font-black text-yellow-400 mt-1 font-mono">Rp 200.000</div>
                        <p class="text-xs text-green-200 mt-1 max-w-md leading-relaxed">
                            Pembayaran resmi menggunakan Payment Gateway Midtrans (QRIS, VA Bank BCA/Mandiri/BRI/BNI, GoPay, OVO).
                        </p>
                    </div>

                    <div class="w-full md:w-auto">
                        <button type="submit"
                                class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-yellow-400 to-amber-500 hover:from-yellow-300 hover:to-amber-400 text-gray-950 font-extrabold text-base rounded-2xl shadow-xl shadow-yellow-500/20 transition transform hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3">
                            <span class="iconify text-2xl" data-icon="mdi:shield-lock-outline"></span>
                            <span>Simpan & Lanjut ke Pembayaran</span>
                        </button>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-green-700/50 flex items-center gap-2 text-xs text-green-200">
                    <span class="iconify text-base text-yellow-400" data-icon="mdi:check-circle"></span>
                    <span>Dengan menekan tombol di atas, saya menyatakan data yang diisikan adalah benar dan dapat dipertanggungjawabkan.</span>
                </div>
            </div>

        </form>

    </div>
</section>

<script>
    const JURUSAN_OPTIONS = {
        'SMP Al-Fattah': [
            { value: 'Reguler & Tahfidz', label: '📖 Reguler & Tahfidzul Qur\'an (Target 5-10 Juz)' },
            { value: 'Tahfidz Intensif', label: '⭐ Tahfidz Intensif & Bahasa Arab / Inggris' }
        ],
        'SMA Al-Fattah': [
            { value: 'MIPA (Matematika & Ilmu Alam)', label: '🔬 MIPA (Matematika & Ilmu Pengetahuan Alam)' },
            { value: 'IPS (Ilmu Sosial)', label: '🌍 IPS (Ilmu Pengetahuan Sosial & Keilmuan Humaniora)' },
            { value: 'Ilmu Keagamaan (IIK)', label: '🕌 Keagamaan / IIK (Kitab Kuning & Dirasah Islamiyah)' }
        ],
        'SMK Al-Fattah': [
            { value: 'Multimedia & DKV', label: '🎬 Desain Komunikasi Visual (DKV) & Multimedia Kreatif' },
            { value: 'Teknik Komputer & Jaringan (TKJ)', label: '💻 Teknik Komputer & Jaringan (TKJ) & Cloud Network' },
            { value: 'Rekayasa Perangkat Lunak (RPL)', label: '⚡ Rekayasa Perangkat Lunak (RPL) / Software Engineering' }
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
</script>
@endsection
