@extends('admin.layouts.app')

@section('title', 'Edit Data Pengguna')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-100">
        <div>
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-blue-600 text-2xl" data-icon="mdi:account-edit"></span>
                Edit Akun Pengguna
            </h2>
            <p class="text-xs text-gray-500 mt-1">Perbarui nama, kontak, email, password, atau hak akses akun pengguna.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
            @foreach ($errors->all() as $err)
                <p>• {{ $err }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nama Lengkap -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                Alamat Email <span class="text-red-500">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
        </div>

        <!-- Role & No HP -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                    Role / Hak Akses <span class="text-red-500">*</span>
                </label>
                <select name="role" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm outline-none font-medium">
                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru (Pendidik)</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Santri / Siswa</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="kepsek" {{ old('role', $user->role) == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                    <option value="yayasan" {{ old('role', $user->role) == 'yayasan' ? 'selected' : '' }}>Ketua Yayasan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                    No. Handphone (WhatsApp)
                </label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       placeholder="081234567890"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
            </div>
        </div>

        <!-- Password Baru (Opsional) -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                Password Baru <span class="text-xs font-normal text-gray-400 lowercase">(kosongkan jika tidak ingin mengganti)</span>
            </label>
            <input type="password" name="password"
                   placeholder="••••••••"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-sm outline-none">
        </div>

        <!-- Tombol Submit -->
        <div class="pt-4 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-md transition transform hover:-translate-y-0.5">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
