<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Eksekutif - @yield('title', 'Kepala Sekolah')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body class="bg-gray-50 font-sans antialiased">
  <div class="flex min-h-screen">
    <!-- Sidebar Kepala Sekolah (Clean White Style seperti Admin) -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">
      <div class="p-6 border-b border-gray-100 flex items-center gap-3">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Al-Fattah" class="h-10 w-10 object-contain" />
        <div>
          <h1 class="text-lg font-extrabold text-green-600 tracking-tight leading-tight">Al-Fattah</h1>
          <span class="text-[10px] text-gray-400 font-bold tracking-wider uppercase">Portal Kepsek</span>
        </div>
      </div>

      <!-- Navigasi Kepsek -->
      <nav class="flex-1 px-4 py-6 space-y-3 text-sm">
        <div class="pb-1">
          <span class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Laporan & Eksekutif</span>
        </div>

        <a href="{{ route('kepsek.dashboard') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('kepsek.dashboard') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
          <span class="iconify text-xl text-green-600" data-icon="mdi:chart-box-outline"></span>
          <span>Laporan Ringkasan</span>
        </a>

        <a href="{{ route('kepsek.laporan.exportExcel') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700">
          <span class="iconify text-xl text-green-600" data-icon="mdi:file-excel-box-outline"></span>
          <span>Export Data Excel</span>
        </a>
      </nav>

      <!-- Footer Sidebar -->
      <div class="p-4 border-t border-gray-100 text-xs text-gray-400 text-center">
        © 2025 Pesantren Al-Fattah
      </div>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col">
      <!-- Navbar Header -->
      <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">
        <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>

        <div class="flex items-center space-x-4">
          <span class="flex items-center text-gray-700 font-medium text-sm">
            <span class="iconify text-green-600 mr-2 text-lg" data-icon="mdi:account-tie"></span>
            {{ Auth::user()->name ?? 'Kepala Sekolah' }}
          </span>

          <!-- Tombol Logout -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold rounded-lg
                     hover:from-red-600 hover:to-red-700 shadow-md hover:shadow-lg transition duration-200">
              <span class="iconify text-white text-sm" data-icon="mdi:logout"></span>
              Logout
            </button>
          </form>
        </div>
      </header>

      <!-- Isi Konten -->
      <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8 transition-all duration-300 hover:shadow-lg">
          @yield('content')
        </div>
      </main>
    </div>
  </div>
</body>
</html>
