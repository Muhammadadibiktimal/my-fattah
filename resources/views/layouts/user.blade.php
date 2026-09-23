<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Santri - @yield('title', 'Dashboard')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">
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

    <!-- Sidebar Santri (Clean White Style seperti Admin) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-xl lg:shadow-sm flex flex-col z-50 transition-transform duration-300 ease-in-out flex-shrink-0">
      <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Al-Fattah" class="h-10 w-10 object-contain" />
          <div>
            <h1 class="text-base font-extrabold text-green-600 tracking-tight leading-tight">Al-Fattah</h1>
            <span class="text-[10px] text-gray-400 font-bold tracking-wider uppercase">Portal Santri</span>
          </div>
        </div>
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-700">
            <span class="iconify text-2xl" data-icon="mdi:close"></span>
        </button>
      </div>

      @php
        $santriUser = \App\Models\Santri::where('user_id', Auth::id())->first();
        $pendaftarUser = \App\Models\Pendaftar::where('email', Auth::user()->email ?? '')->first();
        $isSantriAktif = $santriUser || ($pendaftarUser && ($pendaftarUser->status == 'Terverifikasi' || $pendaftarUser->status_bayar == 'settlement'));
      @endphp

      <!-- Navigasi Santri -->
      <nav class="flex-1 px-4 py-6 space-y-1.5 text-sm overflow-y-auto">
        @if($isSantriAktif)
          <div class="pb-1 pt-1">
            <span class="px-4 text-[10px] font-bold text-emerald-800 bg-emerald-100/70 px-2 py-0.5 rounded-full uppercase tracking-wider">
              Akademik Santri Aktif
            </span>
          </div>

          <a href="{{ route('user.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.dashboard') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-green-600" data-icon="mdi:view-dashboard"></span>
            <span>Beranda Santri</span>
          </a>

          <a href="{{ route('user.jadwal') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.jadwal') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-emerald-600" data-icon="mdi:calendar-clock"></span>
            <span>Jadwal & Kelas</span>
          </a>

          <a href="{{ route('user.kehadiran') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.kehadiran') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-teal-600" data-icon="mdi:calendar-check-outline"></span>
            <span>Kehadiran</span>
          </a>

          <a href="{{ route('user.nilai') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.nilai') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-amber-500" data-icon="mdi:certificate"></span>
            <span>Nilai & Rapor</span>
          </a>

          <a href="{{ route('user.pembayaran') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.pembayaran') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-blue-600" data-icon="mdi:credit-card-check-outline"></span>
            <span>Status Pembayaran</span>
          </a>

          <div class="pb-1 pt-4">
            <span class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
              Biodata & Dokumen
            </span>
          </div>

          <a href="{{ route('user.biodata') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.biodata') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-indigo-600" data-icon="mdi:card-account-details-outline"></span>
            <span>Biodata & Berkas</span>
          </a>

          <a href="{{ route('user.bukti') }}"
            class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.bukti') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-purple-600" data-icon="mdi:badge-account-outline"></span>
            <span>Kartu Santri</span>
          </a>
        @else
          <div class="pb-1">
            <span class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tahapan Pendaftaran</span>
          </div>

          <a href="{{ route('user.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.dashboard') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-green-600" data-icon="mdi:view-dashboard"></span>
            <span>Beranda Pendaftaran</span>
          </a>

          <a href="{{ route('user.data') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.data') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-green-600" data-icon="mdi:square-edit-outline"></span>
            <span>Lengkapi Data</span>
          </a>

          <a href="{{ route('user.status') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.status') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-green-600" data-icon="mdi:list-status"></span>
            <span>Status Seleksi</span>
          </a>

          <a href="{{ route('user.bukti') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('user.bukti') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
            <span class="iconify text-xl text-green-600" data-icon="mdi:printer"></span>
            <span>Cetak Bukti</span>
          </a>
        @endif
      </nav>

      <!-- Footer Sidebar -->
      <div class="p-4 border-t border-gray-100 text-xs text-gray-400 text-center">
        © 2026 Pesantren Al-Fattah
      </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col min-w-0">
      <!-- Navbar Header -->
      <header class="bg-white border-b border-gray-200 px-4 md:px-6 py-3.5 flex justify-between items-center sticky top-0 z-20 shadow-sm">
        <div class="flex items-center gap-3">
          <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-600 hover:text-emerald-700 hover:bg-gray-100 rounded-xl transition">
            <span class="iconify text-2xl" data-icon="mdi:menu"></span>
          </button>
          <h2 class="text-base md:text-xl font-bold text-gray-800">@yield('title')</h2>
        </div>

        <div class="flex items-center space-x-3">
          <span class="hidden sm:flex items-center text-xs md:text-sm text-gray-700 font-semibold bg-gray-100 px-3 py-1.5 rounded-xl">
            <span class="iconify text-green-600 mr-1.5 text-base" data-icon="mdi:account-circle-outline"></span>
            {{ Auth::user()->name ?? 'Santri' }}
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
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 md:p-8 transition-all duration-300 hover:shadow-lg">
          @yield('content')
        </div>
      </main>
    </div>
  </div>
</body>
</html>
