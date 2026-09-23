<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Terpadu - Pondok Pesantren Al-Fattah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .bg-islamic-pattern {
            background-color: #f0fdf4;
            background-image: radial-gradient(#16a34a 0.75px, transparent 0.75px), radial-gradient(#ca8a04 0.75px, #f0fdf4 0.75px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
        }
    </style>
</head>
<body class="bg-islamic-pattern min-h-screen flex items-center justify-center p-4 md:p-8 font-sans">

    <div class="w-full max-w-lg bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200/60 p-8 md:p-10 fade-in relative overflow-hidden">
        
        <!-- Header Glow Top Decoration -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-green-600 via-emerald-500 to-yellow-500"></div>

        <!-- Tombol Kembali ke Beranda -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-gray-500 hover:text-green-700 transition">
                <span class="iconify text-base" data-icon="mdi:arrow-left"></span>
                Kembali ke Beranda
            </a>
            <span class="text-[11px] font-bold uppercase tracking-wider text-green-700 bg-green-100 px-3 py-1 rounded-full">
                Sistem Terintegrasi
            </span>
        </div>

        <!-- Logo & Judul -->
        <div class="text-center mb-6">
            <div class="inline-block p-2 rounded-2xl bg-gradient-to-br from-green-500/10 to-yellow-500/10 border border-green-200 shadow-sm mb-3">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Al-Fattah" class="h-16 w-16 object-contain mx-auto">
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800">
                Pondok Pesantren <span class="text-green-700">Al-Fattah</span>
            </h1>
            <p class="text-sm text-gray-500 mt-1">Portal Masuk Santri, Guru & Administrator</p>
        </div>

        <!-- Role Badges & Quick Login Helper -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-3 mb-6">
            <div class="text-[11px] font-bold text-gray-500 mb-2 uppercase tracking-wide flex items-center gap-1">
                <span class="iconify text-sm text-green-600" data-icon="mdi:information-outline"></span>
                Pilih Login Otomatis (Demo/Testing):
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                <button type="button" onclick="fillLogin('admin@gmail.com', 'password')"
                        class="px-2 py-1.5 bg-green-50 hover:bg-green-100 border border-green-300 text-green-800 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1 shadow-sm">
                    <span class="iconify" data-icon="mdi:shield-crown"></span> Admin
                </button>
                <button type="button" onclick="fillLogin('yayasan@gmail.com', 'password')"
                        class="px-2 py-1.5 bg-amber-50 hover:bg-amber-100 border border-amber-300 text-amber-800 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1 shadow-sm">
                    <span class="iconify" data-icon="mdi:shield-account"></span> Yayasan
                </button>
                <button type="button" onclick="fillLogin('guru@gmail.com', 'password123')"
                        class="px-2 py-1.5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1 shadow-sm">
                    <span class="iconify" data-icon="mdi:school"></span> Guru
                </button>
                <button type="button" onclick="fillLogin('pendaftar@gmail.com', 'password')"
                        class="px-2 py-1.5 bg-teal-50 hover:bg-teal-100 border border-teal-300 text-teal-800 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1 shadow-sm">
                    <span class="iconify" data-icon="mdi:account-school"></span> Santri
                </button>
            </div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-700 bg-green-100/80 border border-green-300 p-3.5 rounded-xl flex items-center gap-2">
                <span class="iconify text-lg flex-shrink-0" data-icon="mdi:check-circle"></span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 text-sm text-green-700 bg-green-100/80 border border-green-300 p-3.5 rounded-xl flex items-center gap-2">
                <span class="iconify text-lg flex-shrink-0" data-icon="mdi:check-circle"></span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 text-sm text-red-700 bg-red-100/80 border border-red-300 p-3.5 rounded-xl flex items-center gap-2">
                <span class="iconify text-lg flex-shrink-0" data-icon="mdi:alert-circle"></span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email / Username -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                    Alamat Email
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <span class="iconify text-lg" data-icon="mdi:email-outline"></span>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-green-600 focus:ring-2 focus:ring-green-500/20 text-sm transition outline-none"
                           placeholder="nama@email.com" required autofocus>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                    Kata Sandi
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <span class="iconify text-lg" data-icon="mdi:lock-outline"></span>
                    </span>
                    <input type="password" name="password" id="password"
                           class="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-300 focus:border-green-600 focus:ring-2 focus:ring-green-500/20 text-sm transition outline-none"
                           placeholder="••••••••" required>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600">
                        <span id="eyeIcon" class="iconify text-lg" data-icon="mdi:eye-outline"></span>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-gray-600">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-green-600 focus:ring-green-500 border-gray-300">
                    <span>Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-green-700 hover:underline">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full py-3.5 px-4 bg-gradient-to-r from-green-700 to-emerald-600 hover:from-green-800 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-green-700/20 hover:shadow-green-700/30 transition transform hover:-translate-y-0.5 active:translate-y-0 text-sm flex items-center justify-center gap-2 mt-2">
                <span class="iconify text-lg" data-icon="mdi:login"></span>
                <span>Masuk ke Sistem</span>
            </button>
        </form>

        <!-- Pendaftaran Santri Baru CTA -->
        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-600 mb-2">
                Calon Siswa / Santri Baru Belum Memiliki Akun?
            </p>
            <a href="{{ route('pendaftaran.form') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-yellow-50 hover:bg-yellow-100 border border-yellow-300 text-yellow-800 font-bold text-xs rounded-xl transition transform hover:-translate-y-0.5 shadow-sm">
                <span class="iconify text-base text-yellow-600" data-icon="mdi:file-document-edit-outline"></span>
                <span>Form Pendaftaran Santri Baru (Online)</span>
            </a>
        </div>

        <div class="mt-6 text-center text-xs text-gray-400">
            © {{ date('Y') }} Pondok Pesantren Al-Fattah Tigaraksa. All rights reserved.
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', () => {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                eyeIcon.setAttribute('data-icon', isHidden ? 'mdi:eye-off-outline' : 'mdi:eye-outline');
            });
        }

        function fillLogin(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</body>
</html>
