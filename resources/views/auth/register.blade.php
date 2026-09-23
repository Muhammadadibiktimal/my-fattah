<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Pesantren Al Fattah</title>
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
            background: linear-gradient(45deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-100 via-blue-50 to-purple-100 flex justify-center items-center min-h-screen font-sans py-10">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md fade-in relative">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-6">
            <div class="bg-gradient-to-tr from-blue-200 to-purple-200 p-3 rounded-full shadow-md">
                <img src="{{ asset('images/logo/logo.png') }}"
                     alt="Logo Al-Fattah"
                     class="h-24 w-24 object-contain rounded-full border-4 border-white shadow-lg" />
            </div>
            <h1 class="text-3xl font-bold mt-4 logo-gradient">Pesantren Al Fattah</h1>
            <p class="text-gray-500 text-sm mt-1">Daftar Akun Santri Baru</p>
        </div>

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                       placeholder="Masukkan nama lengkap" required autofocus>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                       placeholder="Masukkan email" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
                <input type="password" name="password" id="password"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                       placeholder="Masukkan kata sandi" required>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Ulangi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                       placeholder="Ulangi kata sandi" required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-xl hover:scale-[1.02] transition transform duration-300 mt-2">
                Daftar Akun Santri
            </button>
        </form>

        <!-- Link ke Login -->
        <div class="text-center mt-5">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline font-semibold">Masuk di sini</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="text-center mt-4">
            <p class="text-xs text-gray-500">© 2025 Pesantren Al Fattah. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
