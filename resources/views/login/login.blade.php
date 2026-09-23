<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pesantren Al Fattah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .logo-gradient {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-50 to-purple-100 flex justify-center items-center min-h-screen font-sans">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md fade-in relative">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-6">
            <div class="bg-gradient-to-tr from-blue-200 to-purple-200 p-3 rounded-full shadow-md">
                <img src="{{ asset('images/logo/logo.png') }}"
                     alt="Logo Al-Fattah"
                     class="h-24 w-24 object-contain rounded-full border-4 border-white shadow-lg" />
            </div>
            <h1 class="text-3xl font-bold mt-4 logo-gradient">Pesantren Al Fattah</h1>
        </div>

        <!-- Form login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                       placeholder="Masukkan email" required autofocus>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 pr-10"
                           placeholder="Masukkan kata sandi" required>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                        <!-- Mata tertutup -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3l18 18M10.477 10.477A3 3 0 0113.5 13.5m0 0A3 3 0 0110.5 10.5m3 3l4.5 4.5M9.88 9.88L4.21 4.21M15.75 15.75l4.04 4.04" />
                        </svg>
                        <!-- Mata terbuka -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember -->
            <div class="flex items-center mb-2">
                <input type="checkbox" name="remember" id="remember"
                       class="mr-2 w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                <label for="remember" class="text-sm text-gray-700">Ingat saya</label>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-xl hover:scale-[1.02] transition transform duration-300">
                Masuk
            </button>
        </form>

        <!-- Error -->
        @if ($errors->any())
            <div class="mt-4 text-red-600 text-sm">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Link Lupa Password -->
        <div class="text-center mt-5">
            <p class="text-sm text-gray-600">
                Lupa kata sandi?
                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Klik di sini</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="text-center mt-3">
            <p class="text-xs text-gray-500">© 2025 Pesantren Al Fattah. Semua hak dilindungi.</p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        togglePassword.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', !isHidden);
            eyeClosed.classList.toggle('hidden', isHidden);
        });
    </script>
</body>
</html>
