@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-blue-50 p-6">
    <div class="bg-white/80 backdrop-blur-xl shadow-2xl rounded-2xl w-full max-w-lg p-8 transform transition-all duration-500 hover:scale-[1.01]">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-8">Edit Data User</h2>

        {{-- ✅ Notifikasi Error --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg animate-fade-in-down">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mt-2 ml-4 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ✅ Form Edit User --}}
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="group">
                <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200 group-hover:shadow-md" required>
            </div>

            {{-- Nomor Telepon --}}
            <div class="group">
                <label class="block text-gray-700 font-semibold mb-1">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200 group-hover:shadow-md" placeholder="Masukkan nomor telepon">
            </div>

            {{-- Email --}}
            <div class="group">
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200 group-hover:shadow-md" required>
            </div>

            {{-- Password --}}
            <div class="group">
                <label class="block text-gray-700 font-semibold mb-1">Password Baru <span class="text-sm text-gray-500">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200 group-hover:shadow-md">
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.users.index') }}"
                    class="px-5 py-2.5 bg-gray-500 text-white font-semibold rounded-xl hover:bg-gray-600 transition-all duration-200 transform hover:-translate-y-0.5">
                    ← Kembali
                </a>

                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all duration-200 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ✅ Popup Notifikasi --}}
@if (session('success') || session('error'))
<div id="popupNotification" class="fixed inset-0 flex items-center justify-center bg-black/30 backdrop-blur-sm z-50 animate-fade-in">
    <div class="bg-white rounded-2xl shadow-2xl px-8 py-6 text-center transform scale-95 animate-pop-up w-80">
        @if (session('success'))
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 text-green-500" width="50" height="50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h3 class="text-lg font-semibold text-green-700">{{ session('success') }}</h3>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 text-red-500" width="50" height="50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <h3 class="text-lg font-semibold text-red-700">{{ session('error') }}</h3>
        @endif
    </div>
</div>

<script>
    // Tutup popup otomatis setelah 2,5 detik
    setTimeout(() => {
        const popup = document.getElementById('popupNotification');
        if (popup) {
            popup.classList.add('opacity-0', 'scale-90', 'transition-all', 'duration-500');
            setTimeout(() => popup.remove(), 500);
        }
    }, 2500);
</script>
@endif

{{-- Animasi Tailwind Custom --}}
<style>
    @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
    @keyframes fade-in-down { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pop-up { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
    .animate-fade-in { animation: fade-in 0.4s ease-out; }
    .animate-fade-in-down { animation: fade-in-down 0.4s ease-out; }
    .animate-pop-up { animation: pop-up 0.3s ease-out; }
</style>
@endsection
