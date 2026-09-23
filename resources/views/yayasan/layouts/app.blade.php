<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Al-Fattah - @yield('title', 'Pusat Laporan Eksekutif')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen relative overflow-x-hidden">

        <!-- Mobile Overlay Backdrop -->
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

        <!-- Sidebar Ketua Yayasan (Clean White Style seperti Admin) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed lg:static inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-xl lg:shadow-sm flex flex-col z-50 transition-transform duration-300 ease-in-out flex-shrink-0">
            
            <!-- Brand Header -->
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Yayasan" class="h-10 w-10 object-contain" />
                    <div>
                        <h1 class="text-base font-extrabold text-green-700 leading-tight">Yayasan Al-Fattah</h1>
                        <span class="text-[10px] text-emerald-800 bg-emerald-100/70 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Ketua Yayasan</span>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-700">
                    <span class="iconify text-2xl" data-icon="mdi:close"></span>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 text-sm overflow-y-auto">
                <!-- Dashboard Utama -->
                <a href="{{ route('yayasan.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.dashboard') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-xl text-green-600" data-icon="mdi:view-dashboard"></span>
                    <span>Dashboard Eksekutif</span>
                </a>

                <!-- SECTION: PUSAT SELURUH LAPORAN -->
                <div class="pt-5 pb-2">
                    <span class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider flex items-center justify-between">
                        <span>Pusat Laporan Lembaga</span>
                        <span class="px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-700 text-[9px] font-bold">6 Laporan</span>
                    </span>
                </div>

                <!-- 1. Laporan PPDB & Calon Santri -->
                <a href="{{ route('yayasan.laporan.pendaftar') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.laporan.pendaftar') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-lg text-emerald-600" data-icon="mdi:account-school-outline"></span>
                    <span>1. Laporan PPDB & Pendaftar</span>
                </a>

                <!-- 2. Laporan Keuangan Midtrans -->
                <a href="{{ route('yayasan.laporan.keuangan') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.laporan.keuangan') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-lg text-amber-500" data-icon="mdi:cash-multiple"></span>
                    <span>2. Keuangan Midtrans</span>
                </a>

                <!-- 3. Laporan Santri Aktif & Kenaikan -->
                <a href="{{ route('yayasan.laporan.santri') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.laporan.santri') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-lg text-blue-600" data-icon="mdi:account-group"></span>
                    <span>3. Santri & Kenaikan</span>
                </a>

                <!-- 4. Laporan Akademik & Rapor Nilai -->
                <a href="{{ route('yayasan.laporan.nilai') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.laporan.nilai') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-lg text-purple-600" data-icon="mdi:certificate"></span>
                    <span>4. Nilai & Rapor Akademik</span>
                </a>

                <!-- 5. Laporan Presensi & Kehadiran -->
                <a href="{{ route('yayasan.laporan.absensi') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.laporan.absensi') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-lg text-teal-600" data-icon="mdi:calendar-check-outline"></span>
                    <span>5. Presensi Kehadiran</span>
                </a>

                <!-- 6. Laporan Dewan Guru & Rombel -->
                <a href="{{ route('yayasan.laporan.guru') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-semibold transition text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('yayasan.laporan.guru') ? 'bg-green-50 text-green-700 font-bold border-l-4 border-green-600' : '' }}">
                    <span class="iconify text-lg text-pink-600" data-icon="mdi:teach"></span>
                    <span>6. Laporan Dewan Guru</span>
                </a>
            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-gray-100 text-xs text-gray-500 text-center">
              © {{ date('Y') }} Pesantren Al-Fattah
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar Header Sticky -->
            <header class="bg-white border-b border-gray-200 px-4 md:px-8 py-3.5 flex items-center justify-between shadow-sm sticky top-0 z-20">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-600 hover:text-green-700 hover:bg-gray-100 rounded-xl transition">
                        <span class="iconify text-2xl" data-icon="mdi:menu"></span>
                    </button>
                    <div>
                        <h2 class="text-base md:text-lg font-bold text-gray-800 leading-tight truncate">@yield('title')</h2>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <span class="hidden sm:flex items-center text-xs md:text-sm text-gray-700 font-semibold bg-gray-100 px-3 py-1.5 rounded-xl">
                        <span class="iconify text-green-600 mr-1.5 text-base" data-icon="mdi:shield-check"></span>
                        {{ Auth::user()->name ?? 'Ketua Yayasan' }}
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

            <!-- Content Area -->
            <main class="flex-1 p-4 md:p-8 space-y-6">
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs font-bold flex items-center gap-2 shadow-sm">
                        <span class="iconify text-lg text-emerald-600" data-icon="mdi:check-circle"></span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    </div>
</body>
</html>
