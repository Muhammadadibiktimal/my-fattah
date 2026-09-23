@extends('layouts.app')

@section('content')
<!-- HERO SECTION (Optimized + Modern Design) -->
<section class="relative w-full h-[90vh] overflow-hidden bg-black">
    <div class="swiper heroSwiper h-full">
        <div class="swiper-wrapper">
            @foreach($heroes as $hero)
                <div class="swiper-slide relative">
                    <!-- Background Image -->
                    <img src="{{ Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/'.$hero->image) }}"
                         loading="lazy"
                         decoding="async"
                         class="absolute inset-0 w-full h-full object-cover brightness-70 transition-transform duration-[2500ms] scale-105 hover:scale-110"
                         alt="{{ $hero->title }}">

                    <!-- Dark Overlay -->
                    <div class="absolute inset-0 bg-black/60"></div>

                    <!-- Centered Text -->
                    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
                        <h1 class="text-3xl md:text-6xl font-bold tracking-wide mb-4 text-white drop-shadow-lg">
                            {{ $hero->title }}
                        </h1>

                        @if($hero->subtitle)
                            <p class="text-base md:text-xl text-gray-200 max-w-2xl mb-8 leading-relaxed">
                                {{ $hero->subtitle }}
                            </p>
                        @endif

                        @if($hero->button_text && $hero->button_link)
                            <a href="{{ ($hero->button_link == '#pendaftaran-cta' || Str::contains(strtolower($hero->button_text), 'daftar')) ? route('pendaftaran.form') : $hero->button_link }}"
                               class="px-8 py-3 bg-white text-black rounded-full font-semibold hover:bg-yellow-400 transition-all duration-300 shadow-lg hover:shadow-yellow-400/40">
                                {{ $hero->button_text }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination & Navigation -->
        <div class="swiper-pagination !bottom-6"></div>
        <div class="swiper-button-prev !text-white/70 hover:!text-yellow-400 transition"></div>
        <div class="swiper-button-next !text-white/70 hover:!text-yellow-400 transition"></div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="relative py-28 px-6 md:px-20 bg-gradient-to-b from-green-50 via-green-100 to-green-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 overflow-hidden">
    <!-- Blob -->
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-green-400/40 rounded-full mix-blend-overlay blur-[120px] animate-pulse"></div>
    <div class="absolute -bottom-20 right-0 w-[28rem] h-[28rem] bg-yellow-300/30 rounded-full mix-blend-overlay blur-[150px] animate-pulse"></div>

    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
        <img src="{{ asset('images/logo/tentang.jpg') }}" alt="Tentang Kami" class="rounded-3xl shadow-xl hover:scale-105 transition-transform duration-500" data-aos="zoom-in">
        <div data-aos="fade-left">
            <h2 class="text-4xl font-extrabold mb-4 text-green-700 dark:text-green-400">Tentang Kami</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                Sekolah kami berkomitmen memberikan pendidikan berkualitas dengan mengedepankan nilai-nilai islami,
                disiplin, dan inovasi.
            </p>
        </div>
    </div>
</section>

<!-- JENJANG PENDIDIKAN -->
<section id="jenjang" class="py-28 px-6 md:px-20 bg-gradient-to-bl from-white to-green-50 dark:from-gray-900 dark:to-gray-800 relative overflow-hidden">
    <div class="max-w-6xl mx-auto text-center mb-14" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-green-700 dark:text-green-400">Jenjang Pendidikan</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Pondok Pesantren Al-Fattah membina santri dari berbagai jenjang pendidikan formal yang terintegrasi dengan pendidikan pesantren.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-10 relative z-10">
        <!-- SMP AL-FATTAH -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-10 shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-blue-100 dark:bg-blue-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-blue-600" data-icon="mdi:school"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">SMP Al-Fattah</h3>
            <p class="text-gray-600 dark:text-gray-300">Jenjang pendidikan menengah pertama yang menanamkan dasar ilmu pengetahuan dan akhlak Islami melalui sistem boarding school.</p>
        </div>

        <!-- SMA IPA AL-FATTAH -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-10 shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="150">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-green-100 dark:bg-green-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-green-600" data-icon="mdi:flask-outline"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">SMA Al-Fattah (IPA)</h3>
            <p class="text-gray-600 dark:text-gray-300">Fokus pada pengembangan sains dan teknologi dengan pendekatan Islami, membentuk generasi ilmuwan berakhlak Qur’ani.</p>
        </div>

        <!-- SMK MULTIMEDIA AL-FATTAH -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-10 shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="300">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-purple-100 dark:bg-purple-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-purple-600" data-icon="mdi:monitor-cellphone-star"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">SMK Al-Fattah (Multimedia)</h3>
            <p class="text-gray-600 dark:text-gray-300">Program keahlian di bidang teknologi informasi dan desain digital, mencetak santri kreatif dan berdaya saing di era industri 4.0.</p>
        </div>
    </div>

    <!-- Bagian tambahan -->
    <div class="text-center mt-16" data-aos="fade-up">
        <p class="text-gray-700 dark:text-gray-300 text-lg max-w-3xl mx-auto">
            Seluruh jenjang pendidikan di Pondok Pesantren <span class="font-semibold text-green-700 dark:text-green-400">Al-Fattah</span>
            terintegrasi dengan sistem pendidikan pesantren yang menekankan keseimbangan antara ilmu pengetahuan umum dan nilai-nilai keislaman.
        </p>
    </div>
</section>

<!-- AKREDITASI -->
<section id="akreditasi"
    class="relative py-28 px-6 md:px-20 bg-gradient-to-br from-green-400 via-emerald-500 to-green-600 dark:from-gray-900 dark:to-gray-800 text-white overflow-hidden">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/30 dark:bg-black/70 backdrop-blur-[2px]"></div>

    <!-- Decorative Glow -->
    <div class="absolute top-10 left-1/3 w-72 h-72 bg-green-200/40 rounded-full blur-[100px] opacity-70 animate-pulse"></div>
    <div class="absolute bottom-10 right-1/4 w-60 h-60 bg-emerald-300/40 rounded-full blur-[120px] opacity-60 animate-pulse"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <!-- Left: Logo -->
        <div class="flex justify-center" data-aos="zoom-in">
            <div class="relative">
                <img src="{{ asset('images/logo/bansm.png') }}"
                     alt="Logo BANSM"
                     class="w-64 h-64 md:w-72 md:h-72 object-contain rounded-3xl shadow-2xl transform hover:scale-105 transition duration-500 ease-in-out">
                <div class="absolute inset-0 rounded-3xl bg-green-400/10 blur-2xl"></div>
            </div>
        </div>

        <!-- Right: Text -->
        <div class="text-center md:text-left" data-aos="fade-up">
            <div class="flex justify-center md:justify-start mb-6">
                <div class="w-20 h-20 rounded-full bg-yellow-400/20 flex items-center justify-center shadow-lg border border-yellow-300/20">
                    <span class="iconify text-yellow-300 text-5xl" data-icon="mdi:certificate"></span>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4 text-yellow-300 drop-shadow-md">
                Akreditasi Sekolah
            </h2>
            <p class="text-lg leading-relaxed text-gray-100 max-w-md mx-auto md:mx-0">
                Sekolah kami telah resmi terakreditasi
                <span class="font-bold text-yellow-400">A (Unggul)</span>
                oleh <span class="font-semibold text-white">Badan Akreditasi Nasional (BAN-SM)</span>.
                Pencapaian ini menjadi bukti komitmen kami dalam memberikan pendidikan berkualitas terbaik.
            </p>
        </div>
    </div>
</section>

<!-- FASILITAS -->
<section id="fasilitas" class="relative py-24 px-6 md:px-20 bg-gradient-to-br from-emerald-50 via-white to-emerald-100 dark:from-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-100 overflow-hidden">

    <!-- Background decorative -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-200/40 rounded-full blur-[120px] opacity-60"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-400/30 rounded-full blur-[140px] opacity-50"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold mb-4 text-emerald-600 dark:text-emerald-400" data-aos="fade-up">
            🏫 Fasilitas Pondok Pesantren Al Fattah
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="100">
            Kami menyediakan berbagai fasilitas untuk menunjang kegiatan belajar, ibadah, dan kehidupan santri agar tetap nyaman, aman, dan produktif setiap hari.
        </p>

        <!-- Grid Fasilitas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="200">

            <!-- Card 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                <div class="w-16 h-16 mx-auto bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center mb-5">
                    <span class="iconify text-4xl" data-icon="mdi:mosque"></span>
                </div>
                <h3 class="text-xl font-bold mb-3">Masjid & Musholla</h3>
                <p class="text-gray-600 dark:text-gray-300">Tempat ibadah utama yang luas, bersih, dan nyaman untuk kegiatan shalat berjamaah dan kajian rutin.</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                <div class="w-16 h-16 mx-auto bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center mb-5">
                    <span class="iconify text-4xl" data-icon="mdi:book-open-page-variant"></span>
                </div>
                <h3 class="text-xl font-bold mb-3">Perpustakaan</h3>
                <p class="text-gray-600 dark:text-gray-300">Koleksi kitab, buku pelajaran, dan literatur keislaman tersedia untuk mendukung pembelajaran santri.</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                <div class="w-16 h-16 mx-auto bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center mb-5">
                    <span class="iconify text-4xl" data-icon="mdi:home-group"></span>
                </div>
                <h3 class="text-xl font-bold mb-3">Asrama Santri</h3>
                <p class="text-gray-600 dark:text-gray-300">Asrama bersih dan terpisah antara santri putra dan putri, dilengkapi fasilitas dasar dan keamanan 24 jam.</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                <div class="w-16 h-16 mx-auto bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center mb-5">
                    <span class="iconify text-4xl" data-icon="mdi:food"></span>
                </div>
                <h3 class="text-xl font-bold mb-3">Dapur & Kantin Santri</h3>
                <p class="text-gray-600 dark:text-gray-300">Menyediakan makanan bergizi setiap hari dengan menu sehat dan higienis, diolah oleh tim dapur pesantren.</p>
            </div>

            <!-- Card 5 -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                <div class="w-16 h-16 mx-auto bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center mb-5">
                    <span class="iconify text-4xl" data-icon="mdi:soccer"></span>
                </div>
                <h3 class="text-xl font-bold mb-3">Lapangan & Area Olahraga</h3>
                <p class="text-gray-600 dark:text-gray-300">Area terbuka untuk kegiatan olahraga seperti sepak bola, badminton, basket, dan voli.</p>
            </div>

            <!-- Card 6 -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                <div class="w-16 h-16 mx-auto bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-2xl flex items-center justify-center mb-5">
                    <span class="iconify text-4xl" data-icon="mdi:desktop-classic"></span>
                </div>
                <h3 class="text-xl font-bold mb-3">Laboratorium Komputer</h3>
                <p class="text-gray-600 dark:text-gray-300">Mendukung pembelajaran teknologi dan komputerisasi bagi santri dalam menghadapi era digital.</p>
            </div>
        </div>
    </div>
</section>


<!-- KURIKULUM -->
<section id="kurikulum" class="relative py-28 px-6 md:px-20 bg-gradient-to-b from-green-50 via-green-100 to-green-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 overflow-hidden">

    <!-- Decorative Glow -->
    <div class="absolute top-10 right-10 w-[25rem] h-[25rem] bg-green-300/30 rounded-full blur-[150px] animate-pulse"></div>
    <div class="absolute bottom-10 left-10 w-[18rem] h-[18rem] bg-green-400/20 rounded-full blur-[120px] animate-pulse-slow"></div>

    <div class="max-w-6xl mx-auto text-center relative z-10" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold mb-6 text-green-700 dark:text-green-400">
            Kurikulum Pesantren
        </h2>
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-14 leading-relaxed">
            Kurikulum Pondok Pesantren Al-Fattah Tigaraksa mengintegrasikan
            <span class="font-semibold text-green-600 dark:text-green-300">ilmu agama</span>,
            <span class="font-semibold text-green-600 dark:text-green-300">ilmu umum</span>,
            dan <span class="font-semibold text-green-600 dark:text-green-300">ekstrakurikuler</span>
            agar santri tumbuh menjadi generasi yang <span class="italic">cerdas, berkarakter, dan berakhlak mulia.</span>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Umum -->
            <div class="group relative p-10 rounded-3xl bg-white/60 dark:bg-gray-800/70 backdrop-blur-lg border border-green-100 dark:border-gray-700 shadow-lg transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:border-green-300">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-green-100/40 to-transparent dark:from-green-900/20 opacity-0 group-hover:opacity-100 transition-all duration-700"></div>

                <div class="flex justify-center mb-5">
                    <i data-lucide="graduation-cap" class="w-16 h-16 text-green-600 group-hover:text-green-400 transition-transform duration-500 group-hover:scale-110"></i>
                </div>
                <h3 class="text-2xl font-bold text-green-700 mb-3">Ilmu Umum</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Matematika, Bahasa Indonesia, IPA, IPS, PPKn, dan keterampilan umum yang menunjang akademik.
                </p>
                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-green-400 to-green-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            </div>

            <!-- Agama -->
            <div class="group relative p-10 rounded-3xl bg-white/60 dark:bg-gray-800/70 backdrop-blur-lg border border-green-100 dark:border-gray-700 shadow-lg transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:border-green-300" data-aos-delay="200">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-green-100/40 to-transparent dark:from-green-900/20 opacity-0 group-hover:opacity-100 transition-all duration-700"></div>

                <div class="flex justify-center mb-5">
                    <i data-lucide="moon-star" class="w-16 h-16 text-green-700 group-hover:text-green-400 transition-transform duration-500 group-hover:scale-110"></i>
                </div>
                <h3 class="text-2xl font-bold text-green-700 mb-3">Ilmu Agama</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Tahfidz Qur’an, Fiqih, Aqidah, Bahasa Arab, Hadits, dan pembinaan akhlak islami.
                </p>
                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-green-400 to-green-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            </div>

            <!-- Ekstrakurikuler -->
            <div class="group relative p-10 rounded-3xl bg-white/60 dark:bg-gray-800/70 backdrop-blur-lg border border-green-100 dark:border-gray-700 shadow-lg transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:border-green-300" data-aos-delay="400">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-green-100/40 to-transparent dark:from-green-900/20 opacity-0 group-hover:opacity-100 transition-all duration-700"></div>

                <div class="flex justify-center mb-5">
                    <i data-lucide="trophy" class="w-16 h-16 text-green-500 group-hover:text-green-400 transition-transform duration-500 group-hover:scale-110"></i>
                </div>
                <h3 class="text-2xl font-bold text-green-600 mb-3">Ekstrakurikuler</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Pramuka, Hadrah, Paskibra, Tilawah, Taekwondo, Paduan Suara, dan Marcing Band.
                </p>
                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-green-400 to-green-600 rounded-full opacity-0 group-hover:opacity-100 transition-all"></div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM UNGGULAN -->
<section id="program" class="py-28 px-6 md:px-20 bg-gradient-to-tr from-green-50 to-green-100 dark:from-gray-900 dark:to-gray-800 relative overflow-hidden">
    <div class="max-w-6xl mx-auto text-center mb-14" data-aos="fade-up">
        <h2 class="text-4xl font-extrabold text-green-700 dark:text-green-400">Program Unggulan</h2>
        <p class="text-gray-600 dark:text-gray-300">Program unggulan yang membentuk generasi berilmu, berakhlak, dan berdaya saing global.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-10 relative z-10">
        <!-- Bilingual Language -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-blue-100 dark:bg-blue-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-blue-500" data-icon="mdi:translate"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">Bilingual Language</h3>
            <p class="text-gray-600 dark:text-gray-300">Meningkatkan kemampuan berbahasa Arab dan Inggris sebagai bekal komunikasi global.</p>
        </div>

        <!-- Amaliyah Tadris -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="100">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-green-100 dark:bg-green-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-green-500" data-icon="mdi:teach"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">Amaliyah Tadris</h3>
            <p class="text-gray-600 dark:text-gray-300">Pelatihan praktik mengajar bagi siswa untuk menumbuhkan kepercayaan diri dan kompetensi pedagogik.</p>
        </div>

        <!-- Hafalan Matan Kitab -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="200">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-yellow-100 dark:bg-yellow-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-yellow-500" data-icon="mdi:book-open-variant"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">Hafalan Matan Kitab</h3>
            <p class="text-gray-600 dark:text-gray-300">Menanamkan kecintaan terhadap ilmu melalui hafalan matan kitab klasik sebagai dasar keilmuan Islam.</p>
        </div>

        <!-- Kajian Kitab Kuning -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="300">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-orange-100 dark:bg-orange-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-orange-500" data-icon="mdi:book-education"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">Kajian Kitab Kuning</h3>
            <p class="text-gray-600 dark:text-gray-300">Mendalami pemahaman agama melalui kajian kitab kuning bersama guru dan ustadz berpengalaman.</p>
        </div>

        <!-- Life Skill Program -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="400">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-purple-100 dark:bg-purple-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-purple-500" data-icon="mdi:hammer-wrench"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">Life Skill Program</h3>
            <p class="text-gray-600 dark:text-gray-300">Membekali siswa dengan keterampilan hidup seperti wirausaha, teknologi, dan kemandirian.</p>
        </div>

        <!-- Ziarah Wali -->
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl shadow-xl hover:scale-105 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="500">
            <div class="w-20 h-20 mx-auto flex items-center justify-center bg-red-100 dark:bg-red-900/50 rounded-full mb-6">
                <span class="iconify text-5xl text-red-500" data-icon="mdi:map-marker-path"></span>
            </div>
            <h3 class="text-xl font-semibold mb-3">Wisata Religi</h3>
            <p class="text-gray-600 dark:text-gray-300">Menguatkan spiritualitas siswa melalui kegiatan Wisata Religi dan napak tilas perjuangan para wali.</p>
        </div>
    </div>
</section>
<!-- PENDAFTARAN CTA BANNER -->
<section id="pendaftaran-cta" class="relative py-16 px-6 md:px-20 bg-gradient-to-r from-green-700 via-emerald-600 to-green-800 text-white overflow-hidden my-12 mx-4 md:mx-16 rounded-3xl shadow-2xl">
    <!-- Abstract Blobs -->
    <div class="absolute -top-10 -left-10 w-72 h-72 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
    <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-yellow-400/20 rounded-full blur-2xl animate-pulse"></div>

    <div class="relative z-10 max-w-4xl mx-auto text-center flex flex-col items-center">
        <span class="px-4 py-1.5 bg-yellow-400/20 text-yellow-300 border border-yellow-300/30 rounded-full text-sm font-semibold mb-4 tracking-wide uppercase">
            Penerimaan Santri Baru (PSB)
        </span>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 drop-shadow-md" data-aos="fade-up">
            Bergabunglah Bersama Pondok Pesantren Al-Fattah
        </h2>
        <p class="text-base md:text-lg text-green-100 mb-8 max-w-2xl leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Membentuk generasi Qur’ani yang berilmu, berakhlak mulia, dan berdaya saing global. Pendaftaran dibuka untuk jenjang SMP, SMA, dan SMK.
        </p>
        <a href="{{ route('pendaftaran.form') }}"
           class="inline-flex items-center gap-3 px-8 py-3.5 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold rounded-full shadow-lg hover:shadow-yellow-400/50 transition transform hover:-translate-y-1"
           data-aos="zoom-in" data-aos-delay="200">
            <span class="iconify text-xl" data-icon="mdi:pencil-square"></span>
            Daftar Santri Baru Sekarang
        </a>
    </div>
</section>
<!-- BERITA -->
<section id="berita" class="py-28 px-6 md:px-20 bg-gradient-to-b from-green-50 via-white to-green-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
    <div class="absolute top-10 left-10 w-72 h-72 bg-green-300/30 rounded-full blur-[120px] animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-yellow-300/20 rounded-full blur-[120px] animate-pulse"></div>

    <div class="max-w-6xl mx-auto text-center mb-16 relative z-10" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-extrabold text-green-700 dark:text-green-400 mb-3">Berita Terbaru</h2>
        <div class="w-24 h-1 mx-auto bg-gradient-to-r from-green-400 to-yellow-400 rounded-full"></div>
    </div>

    <div class="grid md:grid-cols-3 gap-10 relative z-10">
        @forelse($posts as $post)
            <div class="group bg-white dark:bg-gray-800 rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up">
                @if($post->image)
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/'.$post->image) }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $post->title }}">
                @endif
                <div class="p-6 text-left">
                    <h3 class="font-bold text-lg mb-3 text-gray-800 dark:text-gray-200 group-hover:text-green-600 transition">{{ $post->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 font-semibold hover:underline">
                        Baca Selengkapnya
                        <span class="iconify" data-icon="mdi:arrow-right"></span>
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-600 dark:text-gray-300">Belum ada berita terbaru.</p>
        @endforelse
    </div>
</section>

<!-- ALUMNI -->
<section id="alumni" class="py-28 px-6 md:px-20 bg-gradient-to-br from-green-50 via-white to-green-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-green-400/20 rounded-full blur-[120px] animate-pulse"></div>
    <div class="max-w-6xl mx-auto text-center mb-16 relative z-10" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-extrabold text-green-700 dark:text-green-400">Testimoni Alumni</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-4 max-w-2xl mx-auto">Cerita inspiratif dari para alumni yang telah sukses di berbagai bidang.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 relative z-10">
        @foreach($alumnis as $alumni)
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2 flex flex-col items-center text-center" data-aos="fade-up">
                @if($alumni->photo)
                    <img src="{{ Str::startsWith($alumni->photo, 'http') ? $alumni->photo : asset('storage/' . $alumni->photo) }}" class="w-24 h-24 rounded-full border-4 border-green-500 object-cover shadow-md mb-4">
                @endif
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $alumni->name }}</h3>
                <p class="text-sm text-gray-500">{{ $alumni->angkatan }} • {{ $alumni->pekerjaan }}</p>
                <p class="mt-4 text-gray-700 dark:text-gray-300 italic leading-relaxed">“{{ $alumni->kesan_pesan }}”</p>
            </div>
        @endforeach
    </div>
</section>


<!-- VIDEO SECTION -->
<section id="videos" class="relative py-24 px-6 md:px-20 bg-gradient-to-b from-green-50 via-green-100 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 overflow-hidden">
  <!-- Background floating shapes (dekorasi halus) -->
  <div class="absolute -top-10 -right-10 w-72 h-72 bg-green-400/20 dark:bg-green-600/10 rounded-full blur-3xl"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-yellow-400/10 dark:bg-yellow-500/10 rounded-full blur-3xl"></div>

  <div class="max-w-6xl mx-auto text-center mb-16" data-aos="fade-up">
    <h2 class="text-4xl md:text-5xl font-extrabold text-green-700 dark:text-green-400 tracking-tight drop-shadow-sm">
      Video Kegiatan
    </h2>
    <div class="w-28 h-1 mx-auto bg-gradient-to-r from-green-400 to-blue-500 rounded-full mt-4 shadow-md"></div>
    <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-2xl mx-auto text-lg">
      Dokumentasi kegiatan santri dan aktivitas Pondok Pesantren Al-Fattah yang penuh makna dan semangat.
    </p>
  </div>

  <div class="relative">
    <!-- Scroll Snap Container -->
    <div id="video-scroll"
         class="flex space-x-8 overflow-x-auto pb-10 snap-x snap-mandatory scroll-smooth scrollbar-thin scrollbar-thumb-green-400 scrollbar-track-transparent">
      @forelse($videos as $video)
        <article class="snap-center flex-none w-80 bg-white/80 dark:bg-gray-800/70 backdrop-blur-lg rounded-3xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 overflow-hidden transition-transform duration-500 hover:shadow-2xl hover:scale-[1.05] group relative">

          <!-- Video thumbnail -->
          <div class="relative overflow-hidden rounded-t-3xl">
            <iframe
              class="w-full h-48 md:h-52 transition-transform duration-500 group-hover:scale-110"
              src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
              title="{{ $video->title }}">
            </iframe>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-t-3xl pointer-events-none"></div>
          </div>

          <!-- Content -->
          <div class="p-6">
            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-gray-100 line-clamp-2 leading-snug group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
              {{ $video->title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 leading-relaxed">
              {{ $video->description }}
            </p>
          </div>

          <!-- Glow border -->
          <div class="absolute inset-0 rounded-3xl ring-2 ring-green-400/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        </article>
      @empty
        <p class="w-full text-center text-gray-600 dark:text-gray-300 italic">Belum ada video ditambahkan.</p>
      @endforelse
    </div>

    <!-- Navigation Buttons -->
    <button
      id="scroll-left"
      aria-label="Scroll video list left"
      class="absolute top-1/2 -left-3 md:-left-8 transform -translate-y-1/2 bg-white/40 dark:bg-gray-800/50 backdrop-blur-md hover:bg-green-600/90 text-green-700 dark:text-green-300 hover:text-white p-3 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-green-400/50 transition-all duration-300 hover:scale-110"
      type="button">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <button
      id="scroll-right"
      aria-label="Scroll video list right"
      class="absolute top-1/2 -right-3 md:-right-8 transform -translate-y-1/2 bg-white/40 dark:bg-gray-800/50 backdrop-blur-md hover:bg-green-600/90 text-green-700 dark:text-green-300 hover:text-white p-3 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-green-400/50 transition-all duration-300 hover:scale-110"
      type="button">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>
</section>


<!-- KONTAK -->
<section id="kontak" class="py-28 px-6 md:px-20 bg-gradient-to-tr from-green-100 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-green-300/20 rounded-full blur-[120px] animate-pulse"></div>
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div data-aos="fade-right">
            <h2 class="text-4xl font-extrabold mb-6 text-green-700 dark:text-green-400">Hubungi Kami</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">Butuh informasi lebih lanjut? Tim kami siap membantu melalui media sosial atau kunjungi lokasi kami.</p>
            <div class="flex gap-5">
                <a href="#" class="w-14 h-14 flex items-center justify-center rounded-full bg-white dark:bg-gray-800 shadow-lg text-blue-600 hover:bg-blue-600 hover:text-white transition"><span class="iconify text-3xl" data-icon="mdi:facebook"></span></a>
                <a href="#" class="w-14 h-14 flex items-center justify-center rounded-full bg-white dark:bg-gray-800 shadow-lg text-green-500 hover:bg-green-500 hover:text-white transition"><span class="iconify text-3xl" data-icon="mdi:whatsapp"></span></a>
                <a href="#" class="w-14 h-14 flex items-center justify-center rounded-full bg-white dark:bg-gray-800 shadow-lg text-pink-500 hover:bg-pink-500 hover:text-white transition"><span class="iconify text-3xl" data-icon="mdi:instagram"></span></a>
            </div>
        </div>
        <div data-aos="fade-left">
            <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Lokasi Kami</h3>
            <div class="w-full h-[350px] rounded-3xl overflow-hidden shadow-lg">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3966.287592039571!2d106.4687466!3d-6.2257608!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420133695ebe1f%3A0x699969a7284b1f7e!2sPondok%20Pesantren%20Al%20Fattah%20rumah!5e0!3m2!1sid!2sid!4v1759328948284!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>            </div>
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
        transition: opacity 1s ease-in-out;
    }
    img[loading="lazy"].loaded {
        opacity: 1;
    }

    /* Pagination dots customization */
    .swiper-pagination-bullet {
        background: white !important;
        opacity: 0.7;
    }
    .swiper-pagination-bullet-active {
        background: #facc15 !important; /* yellow-400 */
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Lazy load fade-in
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        img.addEventListener('load', () => img.classList.add('loaded'));
    });

    // Elegant Hero Swiper
    new Swiper('.heroSwiper', {
        loop: true,
        speed: 1200,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        grabCursor: true,
        allowTouchMove: true,
    });
});
</script>
@endpush


