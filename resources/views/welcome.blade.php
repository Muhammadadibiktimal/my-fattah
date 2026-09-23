@extends('layouts.app')

@section('content')
    <!-- Hero Section (Dynamic) -->
    <section class="relative w-full h-[90vh] overflow-hidden">
        <div class="swiper h-full">
            <div class="swiper-wrapper">
                @foreach($heroes as $hero)
                    <div class="swiper-slide relative">
                        <!-- Background Image -->
                        <img src="{{ asset('storage/'.$hero->image) }}"
                             class="w-full h-[90vh] object-cover"
                             alt="{{ $hero->title }}">

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black/50"></div>

                        <!-- Text Content -->
                        <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white z-10">
                            <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $hero->title }}</h1>
                            @if($hero->subtitle)
                                <p class="text-lg md:text-xl mb-6">{{ $hero->subtitle }}</p>
                            @endif
                            @if($hero->button_text && $hero->button_link)
                                <a href="{{ $hero->button_link }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-3 rounded-lg">
                                    {{ $hero->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Swiper Navigation -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="py-16 px-6 md:px-20 bg-gray-50">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <img src="https://picsum.photos/500/350" alt="Tentang Kami" class="rounded-2xl shadow-lg">
            <div>
                <h2 class="text-3xl font-bold mb-4">Tentang Kami</h2>
                <p class="text-gray-600 leading-relaxed">
                    Sekolah kami berkomitmen untuk memberikan pendidikan berkualitas dengan mengedepankan nilai-nilai islami,
                    disiplin, dan inovasi. Kami membimbing siswa agar menjadi generasi unggul dalam ilmu dan akhlak.
                </p>
            </div>
        </div>
    </section>

    <!-- Program -->
    <section id="program" class="py-16 px-6 md:px-20">
        <div class="max-w-6xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold">Program Unggulan</h2>
            <p class="text-gray-600">Beberapa program utama yang kami jalankan</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition">
                <span class="iconify text-5xl text-yellow-500 mb-4" data-icon="mdi:book-open-variant"></span>
                <h3 class="text-xl font-semibold mb-2">Tahfidz Qur’an</h3>
                <p class="text-gray-600">Program unggulan untuk mencetak penghafal Al-Qur’an yang berkualitas.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition">
                <span class="iconify text-5xl text-green-500 mb-4" data-icon="mdi:school"></span>
                <h3 class="text-xl font-semibold mb-2">Pendidikan Formal</h3>
                <p class="text-gray-600">Kurikulum nasional yang dipadukan dengan pendidikan karakter islami.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition">
                <span class="iconify text-5xl text-blue-500 mb-4" data-icon="mdi:account-group"></span>
                <h3 class="text-xl font-semibold mb-2">Kegiatan Sosial</h3>
                <p class="text-gray-600">Meningkatkan kepedulian siswa melalui berbagai kegiatan sosial.</p>
            </div>
        </div>
    </section>

    <!-- Berita -->
    <section id="berita" class="py-16 px-6 md:px-20 bg-gray-50">
        <div class="max-w-6xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold">Berita Terbaru</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach (range(1,3) as $i)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                    <img src="https://picsum.photos/400/250?random={{ $i }}" class="w-full h-48 object-cover" alt="Berita">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">Judul Berita {{ $i }}</h3>
                        <p class="text-gray-600 text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-yellow-500 font-semibold hover:underline">Baca Selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-16 px-6 md:px-20">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
            <p class="text-gray-600 mb-8">Silakan hubungi kami untuk informasi lebih lanjut</p>
            <div class="flex justify-center gap-6">
                <a href="#" class="text-5xl text-blue-600 hover:text-blue-800">
                    <span class="iconify" data-icon="mdi:facebook"></span>
                </a>
                <a href="#" class="text-5xl text-green-500 hover:text-green-700">
                    <span class="iconify" data-icon="mdi:whatsapp"></span>
                </a>
                <a href="#" class="text-5xl text-pink-500 hover:text-pink-700">
                    <span class="iconify" data-icon="mdi:instagram"></span>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endpush
