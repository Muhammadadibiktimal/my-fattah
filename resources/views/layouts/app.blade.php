<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ config('app.name', 'Al-Fattah') }}</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config = { darkMode: 'class' }</script>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

  {{-- Tambahkan stack styles di sini --}}
  @stack('styles')
</head>

<body class="antialiased bg-white dark:bg-gray-900 dark:text-gray-100 transition-colors duration-500">

<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full backdrop-blur-md bg-white/50 dark:bg-gray-800/50 shadow-md z-50 border-b border-white/20 dark:border-gray-700/20 transition-all duration-500">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
      <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Al-Fattah" class="h-14 w-14 object-contain transform group-hover:scale-105 transition-all duration-300" />
      <span class="text-xl md:text-2xl font-extrabold text-green-600 dark:text-green-400 select-none leading-tight">
        PONDOK PESANTREN <br>Al-Fattah
      </span>
    </a>

    <!-- Desktop Menu -->
    <div class="hidden md:flex items-center space-x-8 font-semibold text-gray-800 dark:text-gray-200 text-lg">
      <a href="{{ route('home') }}" class="relative group">
        Beranda
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-yellow-600 dark:bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
      </a>

      <!-- Dropdown -->
      <div class="relative group">
        <button class="flex items-center space-x-1 hover:text-yellow-600 dark:hover:text-yellow-400 transition">
          <span>Tentang</span>
          <span class="iconify" data-icon="mdi:chevron-down" style="font-size: 18px;"></span>
        </button>
        <div class="absolute left-0 mt-3 w-52 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-xl rounded-xl opacity-0 group-hover:opacity-100 group-hover:translate-y-2 transform transition-all duration-300 invisible group-hover:visible">
          <a href="{{ route('visi-misi') }}" class="block px-5 py-3 rounded-lg hover:bg-yellow-100/50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400">Visi & Misi</a>
          <a href="{{ route('sejarah') }}" class="block px-5 py-3 rounded-lg hover:bg-yellow-100/50 dark:hover:bg-gray-700 hover:text-yellow-600 dark:hover:text-yellow-400">Sejarah</a>
        </div>
      </div>

      <a href="{{ route('posts.index') }}" class="relative group">
        Berita
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-yellow-600 dark:bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
      </a>

      <!-- Login Menu -->
      <a href="{{ route('login') }}" class="relative group flex items-center gap-1.5 text-green-700 dark:text-green-400 hover:text-green-800">
        <span class="iconify" data-icon="mdi:login" style="font-size: 20px;"></span>
        <span>Login</span>
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-green-600 dark:bg-green-400 transition-all duration-300 group-hover:w-full"></span>
      </a>
    </div>

    <!-- Actions -->
    <div class="flex items-center space-x-3">
      <!-- Tombol CTA Daftar Calon Siswa/Santri Baru -->
      <a href="{{ route('pendaftaran.form') }}"
         class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold text-sm hover:from-green-700 hover:to-emerald-700 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
        <span class="iconify" data-icon="mdi:account-plus-outline" style="font-size: 18px;"></span>
        <span>Daftar Santri Baru</span>
      </a>

      @auth
        @if(Auth::user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-green-700 text-white font-semibold text-sm hover:bg-green-800 transition duration-300 shadow-md">
            <span class="iconify" data-icon="mdi:shield-crown-outline"></span>
            <span>Dashboard Admin</span>
          </a>
        @elseif(Auth::user()->role === 'guru')
          <a href="{{ route('guru.dashboard') }}" class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-700 text-white font-semibold text-sm hover:bg-emerald-800 transition duration-300 shadow-md">
            <span class="iconify" data-icon="mdi:school-outline"></span>
            <span>Dashboard Guru</span>
          </a>
        @elseif(Auth::user()->role === 'kepsek')
          <a href="{{ route('kepsek.dashboard') }}" class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-700 text-white font-semibold text-sm hover:bg-teal-800 transition duration-300 shadow-md">
            <span class="iconify" data-icon="mdi:account-tie"></span>
            <span>Dashboard Kepsek</span>
          </a>
        @else
          <a href="{{ route('user.dashboard') }}" class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-green-600 text-white font-semibold text-sm hover:bg-green-700 transition duration-300 shadow-md">
            <span class="iconify" data-icon="mdi:account-circle-outline"></span>
            <span>Dashboard Santri</span>
          </a>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="hidden md:inline-block">
          @csrf
          <button type="submit" title="Logout" class="p-2 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-950/30 dark:text-red-400 transition">
            <span class="iconify" data-icon="mdi:logout" style="font-size: 20px;"></span>
          </button>
        </form>
      @endauth

      <!-- Dark Mode -->
      <button id="dark-toggle" class="p-2 rounded-lg hover:bg-yellow-100/60 dark:hover:bg-gray-700 transition">
        <span id="theme-icon" class="iconify" data-icon="mdi:weather-night" style="font-size: 26px; color:#D97706;"></span>
      </button>

      <!-- Hamburger -->
      <button id="mobile-menu-button" aria-label="Toggle menu" class="md:hidden p-2 rounded-lg hover:bg-yellow-100/60 dark:hover:bg-gray-700 transition">
        <span id="hamburger-icon" class="iconify" data-icon="mdi:menu" style="font-size: 30px; color: #D97706;"></span>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden flex-col gap-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-lg rounded-b-2xl p-4">
    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg hover:bg-yellow-100/50 dark:hover:bg-gray-700 transition">Beranda</a>

    <div>
      <button id="mobile-tentang-toggle" class="flex items-center justify-between w-full px-4 py-3 hover:bg-yellow-100/50 dark:hover:bg-gray-700 transition font-semibold rounded-lg">
        <span>Tentang</span>
        <span id="tentang-icon" class="iconify transform transition-transform duration-300" data-icon="mdi:chevron-down" style="font-size: 24px;"></span>
      </button>
      <div id="mobile-tentang-menu" class="hidden flex-col gap-2 mt-2 pl-4">
        <a href="{{ route('visi-misi') }}" class="block px-4 py-2 rounded-lg hover:bg-yellow-100/50 dark:hover:bg-gray-700 transition">Visi & Misi</a>
        <a href="{{ route('sejarah') }}" class="block px-4 py-2 rounded-lg hover:bg-yellow-100/50 dark:hover:bg-gray-700 transition">Sejarah</a>
      </div>
    </div>

    <a href="{{ route('posts.index') }}" class="block px-4 py-3 rounded-lg hover:bg-yellow-100/50 dark:hover:bg-gray-700 transition">Berita</a>

    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg hover:bg-green-100/50 dark:hover:bg-gray-700 text-green-700 dark:text-green-400 font-semibold transition">
      🔐 Login (Santri, Admin & Guru)
    </a>

    <a href="{{ route('pendaftaran.form') }}" class="block px-4 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-lg text-center shadow-md">
      📝 Form Pendaftaran Santri Baru
    </a>

    @auth
      @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 bg-green-700 text-white font-semibold hover:bg-green-800 transition rounded-lg text-center shadow-md">
          Dashboard Admin
        </a>
      @elseif(Auth::user()->role === 'guru')
        <a href="{{ route('guru.dashboard') }}" class="block px-4 py-3 bg-emerald-700 text-white font-semibold hover:bg-emerald-800 transition rounded-lg text-center shadow-md">
          Dashboard Guru
        </a>
      @elseif(Auth::user()->role === 'kepsek')
        <a href="{{ route('kepsek.dashboard') }}" class="block px-4 py-3 bg-teal-700 text-white font-semibold hover:bg-teal-800 transition rounded-lg text-center shadow-md">
          Dashboard Kepsek
        </a>
      @else
        <a href="{{ route('user.dashboard') }}" class="block px-4 py-3 bg-green-600 text-white font-semibold hover:bg-green-700 transition rounded-lg text-center shadow-md">
          Dashboard Santri
        </a>
      @endif

      <form method="POST" action="{{ route('logout') }}" class="pt-1">
        @csrf
        <button type="submit" class="w-full px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg text-center hover:bg-red-700 transition">
          Logout
        </button>
      </form>
    @endauth
  </div>
</nav>

<main class="pt-28 min-h-screen">
  @yield('content')
</main>

{{-- Global Footer --}}
@include('partials.footer')

{{-- Script utama bawaan layout --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
  const html = document.documentElement;
  const mobileMenuBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const hamburgerIcon = document.getElementById('hamburger-icon');
  const tentangToggle = document.getElementById('mobile-tentang-toggle');
  const tentangMenu = document.getElementById('mobile-tentang-menu');
  const tentangIcon = document.getElementById('tentang-icon');
  const darkToggle = document.getElementById('dark-toggle');
  const themeIcon = document.getElementById('theme-icon');

  if (!mobileMenuBtn || !mobileMenu || !hamburgerIcon || !darkToggle || !themeIcon) {
    console.warn("⚠️ Elemen penting navbar tidak ditemukan. Pastikan ID-nya sesuai.");
    return;
  }

  mobileMenuBtn.addEventListener('click', () => {
    const isHidden = mobileMenu.classList.toggle('hidden');
    hamburgerIcon.setAttribute('data-icon', isHidden ? 'mdi:menu' : 'mdi:close');
  });

  if (tentangToggle && tentangMenu && tentangIcon) {
    tentangToggle.addEventListener('click', () => {
      const isHidden = tentangMenu.classList.toggle('hidden');
      tentangIcon.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
    });
  }

  const setTheme = (mode) => {
    if (mode === 'dark') {
      html.classList.add('dark');
      themeIcon.setAttribute('data-icon', 'mdi:white-balance-sunny');
      localStorage.setItem('theme', 'dark');
    } else {
      html.classList.remove('dark');
      themeIcon.setAttribute('data-icon', 'mdi:weather-night');
      localStorage.setItem('theme', 'light');
    }
  };

  if (
    localStorage.theme === 'dark' ||
    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
  ) {
    setTheme('dark');
  } else {
    setTheme('light');
  }

  darkToggle.addEventListener('click', () => {
    const isDark = html.classList.contains('dark');
    setTheme(isDark ? 'light' : 'dark');
  });
});
</script>

{{-- Swiper dan script lain dari child view --}}
@stack('scripts')

</body>
</html>
