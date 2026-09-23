<nav class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md shadow-md">
    <div class="max-w-8xl mx-auto px-6 lg:px-10">
        <div class="flex justify-between items-center h-28">

         <!-- Logo + Nama -->
<a href="/" class="flex items-center space-x-3">
    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="w-26 h-26 rounded-full shadow-md">
    <span class="text-2xl font-extrabold text-gray-800 tracking-wide">
        PONDOK PESANTREN <br> AL-FATTAHds
    </span>
</a>


            <!-- Menu Desktop -->
<div class="hidden md:flex space-x-6 font-medium">
    <a href="/" class="px-3 py-2 rounded-lg text-gray-700 text-2xl hover:bg-green-50 hover:text-green-600 transition duration-300">
        Beranda
    </a>
    <a href="/profil" class="px-3 py-2 rounded-lg text-gray-700 text-2xl hover:bg-green-50 hover:text-green-600 transition duration-300">
        Profil
    </a>
    <a href="/program" class="px-3 py-2 rounded-lg text-gray-700 text-2xl hover:bg-green-50 hover:text-green-600 transition duration-300">
        Program
    </a>
    <a href="/galeri" class="px-3 py-2 rounded-lg text-gray-700 text-2xl hover:bg-green-50 hover:text-green-600 transition duration-300">
        Galeri
    </a>
    <a href="/kontak" class="px-3 py-2 rounded-lg text-gray-700 text-2xl hover:bg-green-50 hover:text-green-600 transition duration-300">
        Kontak
    </a>
</div>


            <!-- Tombol Pendaftaran -->
            <div class="hidden md:flex">
                <a href="/pendaftaran"
                   class="bg-gradient-to-r from-green-300 to-green-500 text-green text-2xl px-6 py-3 rounded-lg shadow-lg font-semibold
                          hover:opacity-90 transition transform hover:scale-105">
                    Pendaftaran
                </a>
            </div>

            <!-- Hamburger Mobile -->
            <button id="menu-btn" class="md:hidden focus:outline-none text-gray-800">
                <span class="iconify text-3xl" data-icon="mdi:menu"></span>
            </button>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden flex-col bg-white/95 backdrop-blur-md shadow-lg">
        <a href="/" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Beranda</a>
        <a href="/profil" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Profil</a>
        <a href="/program" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Program</a>
        <a href="/galeri" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Galeri</a>
        <a href="/kontak" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Kontak</a>
        <a href="/pendaftaran"
           class="block px-6 py-3 bg-gradient-to-r from-green-400 to-green-500 text-green font-semibold text-center">
            Pendaftaran
        </a>
    </div>
</nav>

<script>
    document.getElementById('menu-btn').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
