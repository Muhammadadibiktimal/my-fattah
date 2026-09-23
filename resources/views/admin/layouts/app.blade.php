<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - @yield('title')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <!-- Iconify -->
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800" x-data="{ sidebarOpen: false }">

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

    <!-- Sidebar Responsive -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-xl lg:shadow-sm flex flex-col z-50 transition-transform duration-300 ease-in-out flex-shrink-0">
      
      <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h1 class="text-xl font-extrabold text-green-600 tracking-tight flex items-center gap-2">
            <span class="iconify text-2xl text-green-600" data-icon="mdi:shield-crown"></span>
            <span>Al-Fattah Admin</span>
        </h1>
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-700">
            <span class="iconify text-2xl" data-icon="mdi:close"></span>
        </button>
      </div>

      <!-- Navigasi Sidebar -->
      <nav class="flex-1 px-4 py-6 space-y-2 text-sm overflow-y-auto">

        <!-- Dashboard Admin -->
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:view-dashboard"></span>
          <span>Dashboard Utama</span>
        </a>

        <!-- VERIFIKASI DOKUMEN & PSB -->
        <div class="pt-3 pb-1">
          <span class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Validasi & PSB Online</span>
        </div>

        <a href="{{ route('admin.pendaftar.verifikasi') }}"
          class="flex items-center justify-between px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.pendaftar.verifikasi') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <div class="flex items-center gap-3">
            <span class="iconify text-xl text-indigo-600" data-icon="mdi:check-decagram"></span>
            <span>Verifikasi Dokumen</span>
          </div>
          <span class="px-2 py-0.5 text-[10px] bg-indigo-100 text-indigo-700 font-bold rounded-full">Validator</span>
        </a>

        <a href="{{ route('admin.pendaftar.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.pendaftar.index') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:format-list-bulleted"></span>
          <span>Semua Pendaftar</span>
        </a>

        <!-- PEMBAYARAN MIDTRANS -->
        <a href="{{ route('admin.transaksi.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.transaksi.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-emerald-600" data-icon="mdi:credit-card-fast-outline"></span>
          <span>Pembayaran Midtrans</span>
        </a>

        <a href="{{ route('admin.pendaftar.arsip') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.pendaftar.arsip') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:archive-outline"></span>
          <span>Arsip Keputusan</span>
        </a>

        <!-- DATA AKADEMIK & KESISWAAN -->
        <div class="pt-4 pb-1">
          <span class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kesiswaan & Akademik</span>
        </div>

        <a href="{{ route('admin.santri.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.santri.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:account-school-outline"></span>
          <span>Data Santri Aktif</span>
        </a>

        <a href="{{ route('admin.guru.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.guru.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:teach"></span>
          <span>Data Dewan Guru</span>
        </a>

        <a href="{{ route('admin.kelas.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.kelas.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:google-classroom"></span>
          <span>Data Kelas (Rombel)</span>
        </a>

        <!-- 3 MENU MAPEL (SMP, SMA, SMK) -->
        <a href="{{ route('admin.mapel.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.mapel.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:book-open-page-variant-outline"></span>
          <span>Mapel (SMP, SMA, SMK)</span>
        </a>

        <!-- KELOLA KONTEN WEBSITE -->
        <div class="pt-4 pb-1">
          <span class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kelola Konten Web</span>
        </div>

        <a href="{{ route('admin.heroes.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.heroes.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:image-multiple-outline"></span>
          <span>Banner Hero Slide</span>
        </a>

        <a href="{{ route('admin.posts.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.posts.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:newspaper-variant-outline"></span>
          <span>Berita & Pengumuman</span>
        </a>

        <a href="{{ route('admin.videos.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.videos.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:video-outline"></span>
          <span>Video Youtube</span>
        </a>

        <a href="{{ route('admin.alumnis.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.alumnis.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:account-group-outline"></span>
          <span>Testimoni Alumni</span>
        </a>

        <!-- MANAJEMEN AKUN -->
        <div class="pt-4 pb-1">
          <span class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Manajemen Pengguna</span>
        </div>

        <a href="{{ route('admin.users.index') }}"
          class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.users.*') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:account-key-outline"></span>
          <span>Kelola Pengguna / Akun</span>
        </a>
      </nav>

      <!-- Footer Sidebar -->
      <div class="p-4 border-t border-gray-100 text-xs text-gray-500 text-center">
        © {{ date('Y') }} Pesantren Al-Fattah
      </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col min-w-0">

      <!-- Navbar Header Sticky -->
      <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-3.5 flex justify-between items-center sticky top-0 z-20 shadow-sm">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-600 hover:text-green-700 hover:bg-gray-100 rounded-xl transition">
            <span class="iconify text-2xl" data-icon="mdi:menu"></span>
          </button>
          <h2 class="text-base md:text-lg font-bold text-gray-800 truncate">@yield('title')</h2>
        </div>

        <div class="flex items-center space-x-3">
          <span class="hidden sm:flex items-center text-xs md:text-sm text-gray-700 font-semibold bg-gray-100 px-3 py-1.5 rounded-xl">
            <span class="iconify text-green-600 mr-1.5 text-base" data-icon="mdi:account-circle-outline"></span>
            {{ Auth::user()->name ?? 'Admin' }}
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

      <!-- Isi Konten -->
      <main class="flex-1 overflow-y-auto p-4 md:p-8 bg-gray-50">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 md:p-8 transition">
          @yield('content')
        </div>
      </main>

    </div>
  </div>

</body>
</html>
