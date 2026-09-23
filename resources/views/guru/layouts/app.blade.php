<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Guru - @yield('title')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <style>
    body {
      background-color: #f8fafc;
    }
  </style>
</head>

<body class="font-sans antialiased text-gray-800" x-data="{ sidebarOpen: false }">

  <!-- Container Utama -->
  <div class="flex min-h-screen relative overflow-x-hidden">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/60 z-40 lg:hidden backdrop-blur-sm"
         style="display: none;"></div>

    <!-- Sidebar Guru Responsive -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-xl lg:shadow-sm flex flex-col z-50 transition-transform duration-300 ease-in-out flex-shrink-0">
      
      <!-- Logo Ponpes & Header Portal Guru -->
      <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
            <div>
              <h1 class="text-base font-extrabold text-green-700 leading-tight">Ponpes Al-Fattah</h1>
              <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                Portal Guru
              </span>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-700">
            <span class="iconify text-2xl" data-icon="mdi:close"></span>
        </button>
      </div>

      <!-- Info Guru Login -->
      <div class="p-4 bg-emerald-50/60 border-b border-emerald-100/80 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
          {{ substr(Auth::user()->name, 0, 1) }}
        </div>
        <div class="overflow-hidden">
          <div class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</div>
          <div class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</div>
        </div>
      </div>

      <!-- Navigasi Guru -->
      <nav class="flex-1 px-4 py-5 space-y-1.5 text-sm overflow-y-auto">

        <!-- Dashboard -->
        <a href="{{ route('guru.dashboard') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('guru.dashboard') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:view-dashboard"></span>
          <span>Dashboard Guru</span>
        </a>

        <div class="pt-4 pb-1">
          <span class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Aktivitas Mengajar</span>
        </div>

        <!-- 1. Input Nilai Siswa/Santri -->
        <a href="{{ route('guru.nilai.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('guru.nilai.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-amber-500" data-icon="mdi:pencil-ruler"></span>
          <span>Input Nilai Santri</span>
        </a>

        <!-- 2. Input Absensi Siswa/Santri -->
        <a href="{{ route('guru.absensi.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('guru.absensi.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-teal-600" data-icon="mdi:calendar-check"></span>
          <span>Input Absensi Santri</span>
        </a>

        <!-- 3. Rekap Nilai Siswa/Santri -->
        <a href="{{ route('guru.rekap.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('guru.rekap.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-indigo-600" data-icon="mdi:file-chart-outline"></span>
          <span>Rekap Nilai Mapel & Kelas</span>
        </a>

        <div class="pt-4 pb-1">
          <span class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Portal Utama</span>
        </div>

        <a href="{{ route('home') }}" target="_blank"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold text-gray-500 hover:bg-gray-100 transition">
          <span class="iconify text-base" data-icon="mdi:open-in-new"></span>
          <span>Lihat Beranda Web</span>
        </a>
      </nav>

      <!-- Footer Sidebar -->
      <div class="p-4 border-t border-gray-100 text-xs text-gray-500 text-center">
        © {{ date('Y') }} Pesantren Al-Fattah
      </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col min-w-0">

      <!-- Header Sticky Navbar Mobile Friendly -->
      <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-3.5 flex justify-between items-center sticky top-0 z-20 shadow-sm">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-600 hover:text-green-700 hover:bg-gray-100 rounded-xl transition">
            <span class="iconify text-2xl" data-icon="mdi:menu"></span>
          </button>
          <div>
            <h2 class="text-base md:text-lg font-bold text-gray-800 truncate">@yield('title')</h2>
          </div>
        </div>

        <div class="flex items-center space-x-3">
          <span class="hidden sm:flex items-center text-xs md:text-sm text-gray-700 font-semibold bg-gray-100 px-3 py-1.5 rounded-xl">
            <span class="iconify text-green-600 mr-1.5 text-base" data-icon="mdi:teach"></span>
            {{ Auth::user()->name ?? 'Guru' }}
          </span>

          <!-- Tombol Logout -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="inline-flex items-center gap-1.5 px-3.5 py-1.5 md:px-4 md:py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-xs md:text-sm shadow transition">
              <span class="iconify text-base" data-icon="mdi:logout"></span>
              <span class="hidden sm:inline">Logout</span>
            </button>
          </form>
        </div>
      </header>

      <!-- Isi Konten Halaman -->
      <main class="flex-1 p-4 md:p-8 overflow-y-auto">
        @yield('content')
      </main>

    </div>
  </div>

</body>
</html>
