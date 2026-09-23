@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-16">
    <!-- Header -->
    <div class="text-center mb-14" data-aos="fade-up">
        <span class="px-4 py-1.5 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 rounded-full text-sm font-semibold tracking-wide uppercase">
            Jejak Langkah
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-green-700 dark:text-green-400 mt-3 mb-4">
            Sejarah Pondok Pesantren Al-Fattah
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-yellow-400 mx-auto rounded-full"></div>
    </div>

    <!-- Main Content -->
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <!-- Gambar -->
        <div class="relative overflow-hidden rounded-3xl shadow-xl group" data-aos="fade-right">
            <img src="{{ asset('images/logo/sejarah.jpg') }}"
                 alt="Sejarah Pondok Pesantren Al-Fattah"
                 class="w-full h-[420px] object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-80"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <p class="font-bold text-lg">Didirikan Tahun 2010</p>
                <p class="text-sm text-gray-200">Tigaraksa, Kabupaten Tangerang</p>
            </div>
        </div>

        <!-- Narasi Teks -->
        <div class="space-y-5 text-gray-700 dark:text-gray-300 text-lg leading-relaxed" data-aos="fade-left">
            <p>
                Pondok Pesantren <span class="font-bold text-green-700 dark:text-green-400">Al-Fattah</span> berdiri pada tahun <span class="font-semibold">2010</span> di atas tanah wakaf dari <span class="italic font-medium">KH. Abdul Fattah bin Sulaeman</span>.
            </p>
            <p>
                Sejak awal berdiri, lembaga ini berkembang menjadi salah satu sekolah dan pesantren favorit di Kabupaten Tangerang, yang saat ini dipimpin oleh <span class="font-semibold text-gray-900 dark:text-white">KH. Iskandar Zulkarnaen, M.M.Pd.</span>
            </p>
            <p>
                Dengan memadukan pendidikan ilmu agama dan ilmu umum formal, Al-Fattah terus melahirkan alumni-alumni berkualitas yang berkiprah di perguruan tinggi ternama, dunia kerja, dan pengabdian masyarakat.
            </p>

            <div class="pt-4 flex items-center gap-4 text-green-700 dark:text-green-400 font-semibold">
                <div class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-900/50 flex items-center justify-center">
                    <span class="iconify text-2xl" data-icon="mdi:history"></span>
                </div>
                <span>Lebih dari 15 Tahun Mengabdi Membina Santri</span>
            </div>
        </div>
    </div>

    <!-- Kutipan -->
    <div class="mt-16 bg-gradient-to-r from-green-50 to-emerald-100 dark:from-gray-800 dark:to-gray-900 p-8 rounded-3xl text-center border border-green-200 dark:border-gray-700 shadow-md" data-aos="zoom-in">
        <p class="text-xl font-medium italic text-green-800 dark:text-green-300">
            “Membangun generasi berilmu, bertakwa, dan berakhlak mulia untuk kemajuan umat dan bangsa.”
        </p>
    </div>
</section>
@endsection
