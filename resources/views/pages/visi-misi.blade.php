@extends('layouts.app')

@section('content')
<section class="relative py-16 px-6 md:px-20 max-w-6xl mx-auto">
    <!-- Header Page -->
    <div class="text-center mb-16" data-aos="fade-up">
        <span class="px-4 py-1.5 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 rounded-full text-sm font-semibold tracking-wide uppercase">
            Profil Pesantren
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-green-700 dark:text-green-400 mt-3 mb-4">
            Visi & Misi Al-Fattah
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-green-500 to-yellow-400 mx-auto rounded-full"></div>
    </div>

    <!-- Content Grid -->
    <div class="grid md:grid-cols-2 gap-10">
        <!-- Card Visi -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-10 shadow-xl border border-green-100 dark:border-gray-700 hover:shadow-2xl transition duration-300 flex flex-col justify-between" data-aos="fade-right">
            <div>
                <div class="w-16 h-16 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-2xl flex items-center justify-center mb-6">
                    <span class="iconify text-4xl" data-icon="mdi:eye-outline"></span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Visi Pesantren</h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed italic">
                    “Menjadi pondok pesantren unggulan yang melahirkan generasi berilmu, berakhlak mulia,
                    dan berdaya guna bagi umat, bangsa, serta agama.”
                </p>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center gap-3 text-sm text-green-600 dark:text-green-400 font-semibold">
                <span class="iconify text-xl" data-icon="mdi:check-decagram"></span>
                Terakreditasi A (Unggul) BAN-SM
            </div>
        </div>

        <!-- Card Misi -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-10 shadow-xl border border-green-100 dark:border-gray-700 hover:shadow-2xl transition duration-300" data-aos="fade-left">
            <div class="w-16 h-16 bg-yellow-100 dark:bg-yellow-900/50 text-yellow-600 dark:text-yellow-400 rounded-2xl flex items-center justify-center mb-6">
                <span class="iconify text-4xl" data-icon="mdi:target-variant"></span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Misi Pesantren</h2>
            <ul class="space-y-4 text-gray-600 dark:text-gray-300">
                <li class="flex items-start gap-3">
                    <span class="iconify text-green-500 text-xl flex-shrink-0 mt-1" data-icon="mdi:checkbox-marked-circle"></span>
                    <span>Menanamkan akidah yang kuat dan benar berdasarkan Al-Qur’an dan Sunnah.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="iconify text-green-500 text-xl flex-shrink-0 mt-1" data-icon="mdi:checkbox-marked-circle"></span>
                    <span>Membekali santri dengan ilmu agama yang mendalam dan ilmu pengetahuan umum modern.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="iconify text-green-500 text-xl flex-shrink-0 mt-1" data-icon="mdi:checkbox-marked-circle"></span>
                    <span>Mencetak generasi yang disiplin, mandiri, berkarakter, dan berwawasan luas.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="iconify text-green-500 text-xl flex-shrink-0 mt-1" data-icon="mdi:checkbox-marked-circle"></span>
                    <span>Mengembangkan bakat dan potensi santri melalui berbagai kegiatan ekstrakurikuler dan sosial.</span>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection
