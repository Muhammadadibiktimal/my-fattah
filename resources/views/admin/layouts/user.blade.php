<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Al Fattah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-10 rounded-full">
                        <span class="font-bold text-gray-800 text-lg">Al Fattah</span>
                    </a>
                </div>

                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('user.data') }}" class="text-gray-700 hover:text-green-600">Lengkapi Data</a>
                    <a href="{{ route('user.status') }}" class="text-gray-700 hover:text-green-600">Status</a>
                    <a href="{{ route('user.bukti') }}" class="text-gray-700 hover:text-green-600">Cetak Bukti</a>
                </div>

                <!-- Dropdown Profil -->
                <div class="flex items-center space-x-3">
                    <span class="hidden sm:block text-gray-700">👋 {{ Auth::user()->name }}</span>
                    <div class="relative group">
                        <button class="flex items-center focus:outline-none">
                            <img src="{{ asset('images/logo/logo.png') }}" class="h-10 w-10 rounded-full border">
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-md hidden group-hover:block">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
