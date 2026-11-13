@extends('admin.layouts.app')

@section('title', 'Tambah Pengguna Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-100">
        <div>
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600 text-2xl" data-icon="mdi:account-plus"></span>
                Tambah Akun Pengguna
            </h2>
            <p class="text-xs text-gray-500 mt-1">Daftarkan akun baru untuk Admin, Guru, Kepala Sekolah, Yayasan, atau Santri.</p>
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

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   placeholder="Contoh: Ust. Ahmad Fauzi, S.Pd"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 text-sm outline-none">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                Alamat Email <span class="text-red-500">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   placeholder="email@alfattah.sch.id"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 text-sm outline-none">
        </div>

        <!-- Role / Hak Akses -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                    Role / Hak Akses <span class="text-red-500">*</span>
                </label>
                <select name="role" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 text-sm outline-none font-medium">
                    <option value="">-- Pilih Peran Akun --</option>
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru (Pendidik)</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Santri / Siswa</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="kepsek" {{ old('role') == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                    <option value="yayasan" {{ old('role') == 'yayasan' ? 'selected' : '' }}>Ketua Yayasan</option>
                </select>
            </div>

            <!-- No HP -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                    No. Handphone (WhatsApp)
                </label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       placeholder="081234567890"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 text-sm outline-none">
            </div>
        </div>

        <!-- Password -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1">
                Kata Sandi (Minimal 6 karakter) <span class="text-red-500">*</span>
            </label>
            <input type="password" name="password" required
                   placeholder="••••••••"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 text-sm outline-none">
        </div>

        <!-- Tombol Submit -->
        <div class="pt-4 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl text-sm font-bold shadow-md transition transform hover:-translate-y-0.5">
                Simpan & Terbitkan Akun
            </button>
        </div>
    </form>
</div>
@endsection

