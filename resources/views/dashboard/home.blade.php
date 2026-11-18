@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="relative w-full h-[85vh] min-h-[560px] overflow-hidden bg-gray-950">
    <div class="swiper heroSwiper h-full">
        <div class="swiper-wrapper">
            @foreach($heroes as $hero)
                <div class="swiper-slide relative">
                    <!-- Background Image -->
                    <img src="{{ Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/'.$hero->image) }}"
                         loading="lazy"
                         decoding="async"
                         class="absolute inset-0 w-full h-full object-cover brightness-75 transition-transform duration-[2000ms]"
                         alt="{{ $hero->title }}">

                    <!-- Dark Gradient Overlay for Readability -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950/90 via-gray-950/50 to-gray-950/40"></div>

                    <!-- Centered Content -->
                    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6 max-w-5xl mx-auto">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-600/30 text-emerald-300 border border-emerald-400/40 text-xs sm:text-sm font-semibold tracking-wider uppercase mb-4 backdrop-blur-sm">
                            Pondok Pesantren Al-Fattah Tigaraksa
                        </span>

                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4 text-white leading-tight">
                            {{ $hero->title }}
                        </h1>

                        @if($hero->subtitle)
                            <p class="text-base sm:text-lg lg:text-xl text-gray-200 max-w-2xl mb-8 leading-relaxed font-normal">
                                {{ $hero->subtitle }}
                            </p>
                        @endif

                        @if($hero->button_text && $hero->button_link)
                            <div class="flex flex-wrap items-center justify-center gap-4">
                                <a href="{{ ($hero->button_link == '#pendaftaran-cta' || Str::contains(strtolower($hero->button_text), 'daftar')) ? route('pendaftaran.form') : $hero->button_link }}"
                                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-yellow-400 hover:bg-yellow-300 text-gray-950 rounded-xl font-bold text-sm sm:text-base transition duration-200 shadow-md">
                                    <span>{{ $hero->button_text }}</span>
                                    <span class="iconify text-lg" data-icon="mdi:arrow-right"></span>
                                </a>
                                <a href="#tentang"
                                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-white/10 hover:bg-white/20 text-white rounded-xl font-semibold text-sm sm:text-base border border-white/20 transition duration-200 backdrop-blur-sm">
                                    <span>Pelajari Profil</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination & Navigation -->
        <div class="swiper-pagination !bottom-6"></div>
        <div class="swiper-button-prev !text-white/80 hover:!text-yellow-400 transition" aria-label="Slide sebelumnya"></div>
        <div class="swiper-button-next !text-white/80 hover:!text-yellow-400 transition" aria-label="Slide selanjutnya"></div>
    </div>
</section>

<!-- TENTANG KAMI -->
<section id="tentang" class="py-20 px-6 sm:px-8 lg:px-16 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">
        <!-- Visual Image -->
        <div class="relative order-2 md:order-1" data-aos="fade-up">
            <div class="relative rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-md bg-gray-100 dark:bg-gray-800 aspect-[4/3]">
                <img src="{{ asset('images/logo/tentang.jpg') }}"
                     alt="Kegiatan Santri Pondok Pesantren Al-Fattah Tigaraksa"
                     loading="lazy"
                     class="w-full h-full object-cover">
            </div>
            <div class="absolute -bottom-5 -right-5 hidden sm:block bg-emerald-800 text-white p-5 rounded-2xl shadow-lg border border-emerald-700/50 max-w-xs">
                <div class="text-2xl font-black font-mono text-yellow-300">Tafaqquh Fiddin</div>
                <p class="text-xs text-emerald-100 mt-1">Mengintegrasikan kedalaman ilmu syariah dan kemandirian sains teknologi.</p>
            </div>
        </div>

        <!-- Text Content -->
        <div class="order-1 md:order-2" data-aos="fade-up" data-aos-delay="100">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Tentang Lembaga
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mb-5">
                Membina Generasi Qur'ani, Mandiri, dan Berwawasan Luas
            </h2>
            <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed mb-4">
                Pondok Pesantren Al-Fattah berlokasi di Tigaraksa, Kabupaten Tangerang. Kami menyelenggarakan pendidikan Islam terpadu yang memadukan kurikulum nasional terstandar dengan tradisi kepesantrenan salaf dan modern.
            </p>
            <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed mb-6">
                Seluruh santri dibimbing secara intensif dalam program tahfidzul Qur'an, penguasaan kitab kuning (turots), pembiasaan bilingual (Arab & Inggris), serta keterampilan terapan di bidang sains dan teknologi multimedia.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-700">
                    <div class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-400">A</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium mt-0.5">Akreditasi BAN-SM</div>
                </div>
                <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-700">
                    <div class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-400">3</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium mt-0.5">Jenjang (SMP/SMA/SMK)</div>
                </div>
                <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/60 border border-gray-100 dark:border-gray-700">
                    <div class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-400">24 Jam</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium mt-0.5">Pola Asuh Asrama</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JENJANG PENDIDIKAN -->
<section id="jenjang" class="py-20 px-6 sm:px-8 lg:px-16 bg-gray-50/70 dark:bg-gray-900/60 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Pilihan Pendidikan Formal
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                Jenjang Pendidikan Terpadu
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-3 text-base">
                Setiap jenjang sekolah di bawah naungan Yayasan Pondok Pesantren Al-Fattah terintegrasi penuh dengan kurikulum kepesantrenan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- SMP AL-FATTAH -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200/80 dark:border-gray-700 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200 flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="w-14 h-14 flex items-center justify-center bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-400 rounded-xl mb-6">
                        <span class="iconify text-3xl" data-icon="mdi:school-outline"></span>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-md bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 text-xs font-bold uppercase mb-3">
                        Pendidikan Dasar
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">SMP Al-Fattah</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6">
                        Pendidikan menengah pertama dengan sistem boarding school. Fokus pada pembentukan adab, kemandirian pribadi santri, tahfidz Al-Qur'an, dan penuntasan kurikulum dasar nasional.
                    </p>
                </div>
                <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 text-xs text-gray-500 dark:text-gray-400">
                    Program: Reguler & Tahfidzul Qur'an
                </div>
            </div>

            <!-- SMA IPA AL-FATTAH -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200/80 dark:border-gray-700 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="w-14 h-14 flex items-center justify-center bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl mb-6">
                        <span class="iconify text-3xl" data-icon="mdi:flask-outline"></span>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-md bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300 text-xs font-bold uppercase mb-3">
                        Pendidikan Menengah Atas
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">SMA Al-Fattah (MIPA)</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6">
                        Mempersiapkan santri melanjutkan ke perguruan tinggi negeri maupun keagamaan dengan pendalaman sains (MIPA), kajian kitab turots, riset ilmiah dasar, serta kemampuan berbahasa aktif.
                    </p>
                </div>
                <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 text-xs text-gray-500 dark:text-gray-400">
                    Peminatan: MIPA, IPS, & Keagamaan (IIK)
                </div>
            </div>

            <!-- SMK MULTIMEDIA AL-FATTAH -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200/80 dark:border-gray-700 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-14 h-14 flex items-center justify-center bg-purple-50 dark:bg-purple-950/60 text-purple-700 dark:text-purple-400 rounded-xl mb-6">
                        <span class="iconify text-3xl" data-icon="mdi:monitor-cellphone-star"></span>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-md bg-purple-100 dark:bg-purple-900/40 text-purple-800 dark:text-purple-300 text-xs font-bold uppercase mb-3">
                        Pendidikan Kejuruan
                    </span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">SMK Al-Fattah (Multimedia)</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6">
                        Membekali santri keahlian praktis teknologi informasi, desain grafis, animasi, dan produksi konten digital (DKV/RPL/TKJ) agar memiliki daya saing kerja dan jiwa technopreneur Islami.
                    </p>
                </div>
                <div class="pt-4 border-t border-gray-100 dark:border-gray-700/60 text-xs text-gray-500 dark:text-gray-400">
                    Kompetensi: Multimedia, RPL, & Jaringan
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AKREDITASI -->
<section id="akreditasi" class="py-16 px-6 sm:px-8 lg:px-16 bg-gray-800 dark:bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
        <!-- Logo BANSM -->
        <div class="md:col-span-4 flex justify-center md:justify-start" data-aos="fade-right">
            <div class="p-6 bg-white rounded-2xl shadow-md border border-white/20 inline-block">
                <img src="{{ asset('images/logo/bansm.png') }}"
                     alt="Badan Akreditasi Nasional Sekolah/Madrasah (BAN-SM)"
                     class="h-32 sm:h-36 w-auto object-contain">
            </div>
        </div>

        <!-- Akreditasi Details -->
        <div class="md:col-span-8 text-center md:text-left" data-aos="fade-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-yellow-400/20 text-yellow-300 border border-yellow-400/30 text-xs font-bold uppercase mb-3">
                <span class="iconify" data-icon="mdi:certificate-outline"></span>
                <span>Jaminan Mutu Pendidikan</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-3">
                Terakreditasi <span class="text-yellow-400">A (Unggul)</span> BAN-SM
            </h2>
            <p class="text-sm sm:text-base text-gray-200 leading-relaxed max-w-2xl">
                Lembaga pendidikan Pondok Pesantren Al-Fattah Tigaraksa telah terakreditasi oleh Badan Akreditasi Nasional Sekolah/Madrasah (BAN-SM). Penilaian ini menegaskan komitmen kami dalam memenuhi standar sarana prasarana, kompetensi pendidik, dan manajemen kurikulum yang berkualitas.
            </p>
        </div>
    </div>
</section>

<!-- FASILITAS -->
<section id="fasilitas" class="py-20 px-6 sm:px-8 lg:px-16 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Sarana & Prasarana
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                Fasilitas Pondok Pesantren Al-Fattah
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-3 text-base">
                Sarana terpadu untuk menunjang kegiatan ibadah, akademik, serta kenyamanan kehidupan santri di lingkungan asrama.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Fasilitas 1 -->
            <div class="p-6 rounded-2xl bg-gray-50/80 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200" data-aos="fade-up">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:mosque"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Masjid Jami' Pesantren</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Pusat peribadatan shalat lima waktu berjamaah, halaqah tahfidz Al-Qur'an, dan kajian rutin kitab kuning bersama asatidz.
                </p>
            </div>

            <!-- Fasilitas 2 -->
            <div class="p-6 rounded-2xl bg-gray-50/80 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:home-group"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Asrama Putra & Putri Terpisah</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Kawasan asrama dengan tata ruang mandiri, pengawasan wali asrama 24 jam, kamar berventilasi baik, serta loker santri rapi.
                </p>
            </div>

            <!-- Fasilitas 3 -->
            <div class="p-6 rounded-2xl bg-gray-50/80 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:laptop"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Laboratorium Komputer Multimedia</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Perangkat PC modern untuk menunjang pembelajaran TIK, desain multimedia SMK, serta asesmen nasional berbasis komputer (ANBK).
                </p>
            </div>

            <!-- Fasilitas 4 -->
            <div class="p-6 rounded-2xl bg-gray-50/80 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:book-open-page-variant"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Perpustakaan & Ruang Baca</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Koleksi referensi kitab kuning, buku teks pelajaran nasional, ensiklopedia keislaman, serta area baca santri yang tenang.
                </p>
            </div>

            <!-- Fasilitas 5 -->
            <div class="p-6 rounded-2xl bg-gray-50/80 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200" data-aos="fade-up" data-aos-delay="400">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:silverware-fork-knife"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Dapur & Kantin Santri Higienis</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Layanan konsumsi makan sehat dan higienis 3 kali sehari dengan menu gizi seimbang yang dikelola langsung oleh tim dapur pesantren.
                </p>
            </div>

            <!-- Fasilitas 6 -->
            <div class="p-6 rounded-2xl bg-gray-50/80 dark:bg-gray-800/60 border border-gray-200/70 dark:border-gray-700 shadow-sm hover:shadow-md transition duration-200" data-aos="fade-up" data-aos-delay="500">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:soccer"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Lapangan Sarana Olahraga</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Fasilitas olahraga terbuka untuk menjaga kebugaran jasmani santri melalui futsal, bola voli, bulutangkis, dan bela diri.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- KURIKULUM PESANTREN -->
<section id="kurikulum" class="py-20 px-6 sm:px-8 lg:px-16 bg-gray-50/70 dark:bg-gray-900/60 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Struktur Pembelajaran
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                Kurikulum Pesantren Terintegrasi
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-3 text-base">
                Menggabungkan kurikulum nasional, keilmuan keislaman salaf, dan penguatan karakter santri dalam satu ekosistem belajar yang terarah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pilar 1 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200/80 dark:border-gray-700 shadow-sm flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 flex items-center justify-center mb-5">
                        <span class="iconify text-2xl" data-icon="mdi:school-outline"></span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Kurikulum Formal Nasional</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        Mata pelajaran umum terstandar Kemendikbudristek & Kemenag: Matematika, Bahasa Indonesia, Bahasa Inggris, IPA/IPS terpadu, dan Kejuruan IT.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs font-semibold text-emerald-700 dark:text-emerald-400">
                    Standar Kelulusan Nasional
                </div>
            </div>

            <!-- Pilar 2 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200/80 dark:border-gray-700 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 flex items-center justify-center mb-5">
                        <span class="iconify text-2xl" data-icon="mdi:book-open-variant"></span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Kurikulum Diniyah Salaf</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        Kajian kitab turots bertahap: Nahwu-Shorof (Jurumiyah/Imrithi), Fiqih (Safinah/Fathul Qorib), Hadits Arba'in, Aqidah, serta bimbingan Tahfidz Al-Qur'an.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs font-semibold text-emerald-700 dark:text-emerald-400">
                    Sanad Keilmuan Pesantren
                </div>
            </div>

            <!-- Pilar 3 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200/80 dark:border-gray-700 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 flex items-center justify-center mb-5">
                        <span class="iconify text-2xl" data-icon="mdi:trophy-outline"></span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Karakter & Bahasa Aktif</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        Pembiasaan bilingual (Arab & Inggris), latihan pidato (Muhadhoroh 3 Bahasa), kepramukaan, seni hadrah, dan pembinaan kepemimpinan santri.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs font-semibold text-emerald-700 dark:text-emerald-400">
                    Kemandirian & Adab Islami
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM UNGGULAN -->
<section id="program" class="py-20 px-6 sm:px-8 lg:px-16 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Fokus Pengembangan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                Program Unggulan Pesantren
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-3 text-base">
                Program unggulan yang dirancang untuk membangun kompetensi akademis, spiritual, dan keterampilan praktis santri.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- 1. Bilingual -->
            <div class="p-6 rounded-2xl bg-gray-50/70 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700" data-aos="fade-up">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:translate"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Bilingual Language Environment</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Pembiasaan kosakata dan percakapan harian dalam Bahasa Arab dan Bahasa Inggris sebagai bekal komunikasi global santri.
                </p>
            </div>

            <!-- 2. Amaliyah Tadris -->
            <div class="p-6 rounded-2xl bg-gray-50/70 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:teach"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Amaliyah Tadris (Praktik Mengajar)</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Pelatihan metodologi mengajar bagi santri tingkat akhir untuk melatih kepercayaan diri, penguasaan materi, dan adab keguruan.
                </p>
            </div>

            <!-- 3. Matan Kitab -->
            <div class="p-6 rounded-2xl bg-gray-50/70 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:book-open-page-variant-outline"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Hafalan Matan Kitab</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Menghafal matan gramatika Arab dan kaidah keislaman dasar sebagai pondasi pemahaman turots klasik yang kokoh.
                </p>
            </div>

            <!-- 4. Kajian Kitab Kuning -->
            <div class="p-6 rounded-2xl bg-gray-50/70 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-950/60 text-orange-700 dark:text-orange-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:book-education-outline"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Kajian Kitab Kuning Bersanad</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Metode sorogan dan bandongan langsung di bawah bimbingan asatidz lulusan pesantren terkemuka dan universitas Islam.
                </p>
            </div>

            <!-- 5. Life Skill & IT -->
            <div class="p-6 rounded-2xl bg-gray-50/70 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700" data-aos="fade-up" data-aos-delay="400">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-950/60 text-purple-700 dark:text-purple-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:laptop"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Life Skill & Literasi Digital</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Pelatihan desain multimedia, editing video, dan kewirausahaan santri untuk bekal kecakapan hidup di era digital.
                </p>
            </div>

            <!-- 6. Ziarah & Wisata Religi -->
            <div class="p-6 rounded-2xl bg-gray-50/70 dark:bg-gray-800/50 border border-gray-200/80 dark:border-gray-700" data-aos="fade-up" data-aos-delay="500">
                <div class="w-12 h-12 bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-400 rounded-xl flex items-center justify-center mb-4">
                    <span class="iconify text-2xl" data-icon="mdi:map-marker-path"></span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Wisata Religi & Studi Pesantren</h3>
                <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Napak tilas perjuangan dakwah para wali dan ulama nusantara guna menguatkan nilai spiritual serta kecintaan pada tanah air.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- PENDAFTARAN CTA BANNER -->
<section id="pendaftaran-cta" class="py-16 px-6 sm:px-8 lg:px-16 bg-white dark:bg-gray-900">
    <div class="max-w-6xl mx-auto rounded-3xl bg-gradient-to-r from-emerald-800 via-green-800 to-teal-900 text-white p-8 sm:p-12 lg:p-14 border border-emerald-700 shadow-xl" data-aos="zoom-in">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-block px-3.5 py-1 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                Penerimaan Santri Baru (PSB) TA 2026/2027
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mb-4 leading-tight">
                Pendaftaran Santri Baru Telah Dibuka
            </h2>
            <p class="text-sm sm:text-base text-emerald-100 mb-8 leading-relaxed">
                Bergabunglah bersama keluarga besar Pondok Pesantren Al-Fattah Tigaraksa untuk jenjang SMP, SMA, dan SMK. Kuota pendaftaran terbatas untuk menjaga kualitas pembinaan asrama.
            </p>

            <!-- Roadmap 4 Langkah -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-left mb-8 bg-black/20 p-4 rounded-2xl border border-white/10 text-xs">
                <div class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-yellow-400 text-gray-950 font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">1</span>
                    <span>Isi Formulir Online & Berkas</span>
                </div>
                <div class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-white/20 text-white font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">2</span>
                    <span>Verifikasi Berkas Panitia</span>
                </div>
                <div class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-white/20 text-white font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">3</span>
                    <span>Pembayaran Infaq Midtrans</span>
                </div>
                <div class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-white/20 text-white font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">4</span>
                    <span>Cetak Bukti & KTS Santri</span>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('pendaftaran.form') }}"
                   class="inline-flex items-center gap-2.5 px-8 py-4 bg-yellow-400 hover:bg-yellow-300 text-gray-950 font-extrabold rounded-xl shadow-md transition duration-200">
                    <span class="iconify text-xl" data-icon="mdi:pencil-square-outline"></span>
                    <span>Daftar Calon Santri Sekarang</span>
                </a>
                <a href="#kontak"
                   class="inline-flex items-center gap-2 px-6 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition duration-200">
                    <span class="iconify text-lg" data-icon="mdi:whatsapp"></span>
                    <span>Konsultasi Panitia PSB</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- BERITA TERBARU -->
<section id="berita" class="py-20 px-6 sm:px-8 lg:px-16 bg-gray-50/70 dark:bg-gray-900/60 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12" data-aos="fade-up">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                    Kabar Pesantren
                </span>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Berita & Informasi Terbaru
                </h2>
            </div>
            <a href="{{ route('posts.index') }}" class="mt-4 sm:mt-0 text-sm font-bold text-emerald-700 dark:text-emerald-400 hover:underline inline-flex items-center gap-1.5">
                <span>Lihat Seluruh Berita</span>
                <span class="iconify" data-icon="mdi:arrow-right"></span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200/80 dark:border-gray-700 shadow-sm overflow-hidden flex flex-col justify-between" data-aos="fade-up">
                    <div>
                        @if($post->image)
                            <div class="aspect-video w-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/'.$post->image) }}"
                                     class="w-full h-full object-cover"
                                     alt="{{ $post->title }}">
                            </div>
                        @endif
                        <div class="p-6">
                            <span class="text-[11px] font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider block mb-2">
                                {{ $post->created_at ? $post->created_at->translatedFormat('d F Y') : 'Informasi' }}
                            </span>
                            <h3 class="font-bold text-base sm:text-lg mb-2 text-gray-900 dark:text-white line-clamp-2">
                                <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-emerald-700 dark:hover:text-emerald-400 transition">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm line-clamp-3 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                            <span>Baca Selengkapnya</span>
                            <span class="iconify" data-icon="mdi:arrow-right"></span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                    <p class="text-gray-500 text-sm">Belum ada artikel berita yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- TESTIMONI ALUMNI -->
<section id="alumni" class="py-20 px-6 sm:px-8 lg:px-16 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Kiprah Lulusan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                Testimoni Santri & Alumni
            </h2>
            <p class="text-gray-600 dark:text-gray-300 mt-3 text-base">
                Refleksi alumni tentang nilai keteladanan, kedisiplinan, dan bekal hidup yang diperoleh selama belajar di Al-Fattah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($alumnis as $alumni)
                <div class="bg-gray-50/80 dark:bg-gray-800/60 rounded-2xl border border-gray-200/70 dark:border-gray-700 p-6 flex flex-col justify-between" data-aos="fade-up">
                    <div>
                        <div class="text-emerald-600 dark:text-emerald-400 text-3xl font-serif mb-2 leading-none">“</div>
                        <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed italic mb-6">
                            {{ $alumni->kesan_pesan }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        @if($alumni->photo)
                            <img src="{{ Str::startsWith($alumni->photo, 'http') ? $alumni->photo : asset('storage/' . $alumni->photo) }}"
                                 alt="{{ $alumni->name }}"
                                 class="w-11 h-11 rounded-full object-cover border border-emerald-600/40">
                        @else
                            <div class="w-11 h-11 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold flex items-center justify-center text-sm">
                                {{ strtoupper(substr($alumni->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="text-sm font-bold text-gray-900 dark:text-white leading-snug">{{ $alumni->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $alumni->angkatan }} • {{ $alumni->pekerjaan }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- VIDEO KEGIATAN -->
<section id="videos" class="py-20 px-6 sm:px-8 lg:px-16 bg-gray-50/70 dark:bg-gray-900/60 border-b border-gray-100 dark:border-gray-800">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10" data-aos="fade-up">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                    Dokumentasi Santri
                </span>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Video Kegiatan Pesantren
                </h2>
            </div>
            <div class="flex items-center gap-2 mt-4 sm:mt-0">
                <button id="scroll-left"
                        aria-label="Geser daftar video ke kiri"
                        type="button"
                        class="p-2.5 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-emerald-50 hover:text-emerald-700 transition">
                    <span class="iconify text-xl" data-icon="mdi:chevron-left"></span>
                </button>
                <button id="scroll-right"
                        aria-label="Geser daftar video ke kanan"
                        type="button"
                        class="p-2.5 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-emerald-50 hover:text-emerald-700 transition">
                    <span class="iconify text-xl" data-icon="mdi:chevron-right"></span>
                </button>
            </div>
        </div>

        <div id="video-scroll" class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth scrollbar-thin">
            @forelse($videos as $video)
                <div class="snap-start flex-none w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200/80 dark:border-gray-700 overflow-hidden shadow-sm">
                    <div class="aspect-video w-full bg-black">
                        <iframe class="w-full h-full"
                                src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                                title="{{ $video->title }}">
                        </iframe>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-sm sm:text-base text-gray-900 dark:text-white line-clamp-2 mb-2 leading-snug">
                            {{ $video->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-xs line-clamp-2 leading-relaxed">
                            {{ $video->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-10 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700">
                    <p class="text-gray-500 text-sm">Belum ada video kegiatan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- KONTAK & LOKASI -->
<section id="kontak" class="py-20 px-6 sm:px-8 lg:px-16 bg-white dark:bg-gray-900">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-2 block">
                Sekretariat & Informasi
            </span>
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4">
                Hubungi Kami
            </h2>
            <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base leading-relaxed mb-6">
                Untuk pertanyaan mengenai prosedur pendaftaran santri baru, kurikulum, atau kunjungan langsung ke kampus pesantren, silakan hubungi saluran resmi kami.
            </p>

            <div class="space-y-4 mb-6 text-sm">
                <div class="flex items-start gap-3 text-gray-700 dark:text-gray-300">
                    <span class="iconify text-xl text-emerald-700 dark:text-emerald-400 shrink-0 mt-0.5" data-icon="mdi:map-marker-outline"></span>
                    <span>Pondok Pesantren Al-Fattah, Kec. Tigaraksa, Kabupaten Tangerang, Banten.</span>
                </div>
                <div class="flex items-center gap-3 text-gray-700 dark:text-gray-300">
                    <span class="iconify text-xl text-emerald-700 dark:text-emerald-400 shrink-0" data-icon="mdi:whatsapp"></span>
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="hover:underline text-emerald-700 dark:text-emerald-400 font-semibold">
                        +62 812-3456-7890 (Layanan PSB)
                    </a>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="#" aria-label="WhatsApp Pesantren" class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition">
                    <span class="iconify text-xl" data-icon="mdi:whatsapp"></span>
                </a>
                <a href="#" aria-label="Instagram Pesantren" class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition">
                    <span class="iconify text-xl" data-icon="mdi:instagram"></span>
                </a>
                <a href="#" aria-label="YouTube Pesantren" class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition">
                    <span class="iconify text-xl" data-icon="mdi:youtube"></span>
                </a>
            </div>
        </div>

        <div data-aos="fade-left">
            <div class="w-full h-80 sm:h-96 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-md">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3966.287592039571!2d106.4687466!3d-6.2257608!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420133695ebe1f%3A0x699969a7284b1f7e!2sPondok%20Pesantren%20Al%20Fattah%20rumah!5e0!3m2!1sid!2sid!4v1759328948284!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta Lokasi Pondok Pesantren Al-Fattah">
                </iframe>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<style>
    /* Smooth fade-in for lazy images */
    img[loading="lazy"] {
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
    }
    img[loading="lazy"].loaded {
        opacity: 1;
    }

    /* Custom Swiper pagination styling */
    .swiper-pagination-bullet {
        background: #ffffff !important;
        opacity: 0.6;
        width: 8px;
        height: 8px;
        transition: all 0.3s ease;
    }
    .swiper-pagination-bullet-active {
        background: #facc15 !important;
        opacity: 1;
        width: 24px;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Lazy load fade-in
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            img.addEventListener('load', () => img.classList.add('loaded'));
        }
    });

    // Hero Swiper
    new Swiper('.heroSwiper', {
        loop: true,
        speed: 1000,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        grabCursor: true,
        allowTouchMove: true,
    });

    // Video horizontal scroll navigation buttons (Functional control)
    const videoScroll = document.getElementById('video-scroll');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');

    if (videoScroll && scrollLeftBtn && scrollRightBtn) {
        scrollLeftBtn.addEventListener('click', () => {
            videoScroll.scrollBy({ left: -340, behavior: 'smooth' });
        });
        scrollRightBtn.addEventListener('click', () => {
            videoScroll.scrollBy({ left: 340, behavior: 'smooth' });
        });
    }
});
</script>
@endpush
