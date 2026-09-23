@extends('admin.layouts.app')

@section('title', 'Kelola Data Guru')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600 text-3xl" data-icon="mdi:teach"></span>
                <span>Data Guru & Pengajar</span>
            </h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data dewan guru dan akun guru untuk input nilai serta absensi santri.</p>
        </div>

        <button onclick="document.getElementById('modalTambahGuru').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl text-sm font-bold shadow-md shadow-green-600/20 transition">
            <span class="iconify text-lg" data-icon="mdi:plus-circle"></span>
            <span>+ Tambah Guru Baru</span>
        </button>
    </div>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded-xl border border-green-200 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Guru -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs">
                    <tr>
                        <th class="py-3.5 px-4 text-left">Nama Guru</th>
                        <th class="py-3.5 px-4 text-left">Email Login</th>
                        <th class="py-3.5 px-4 text-left">No. HP / WA</th>
                        <th class="py-3.5 px-4 text-center">Hak Akses (Role)</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($gurus as $guru)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3.5 px-4 font-semibold text-gray-900 flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                    {{ substr($guru->name, 0, 1) }}
                                </div>
                                <span>{{ $guru->name }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-gray-600 font-mono text-xs">{{ $guru->email }}</td>
                            <td class="py-3.5 px-4 text-gray-600">{{ $guru->phone ?? '-' }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold">
                                    Guru (Nilai & Absensi)
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-400 italic">
                                Belum ada data guru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah Guru -->
<div id="modalTambahGuru" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-gray-100">
        <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Tambah Akun Guru Baru</h3>
            <button onclick="document.getElementById('modalTambahGuru').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <span class="iconify text-2xl" data-icon="mdi:close"></span>
            </button>
        </div>

        <form action="{{ route('admin.guru.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nama Lengkap & Gelar</label>
                <input type="text" name="name" placeholder="contoh: Ustadz Ahmad, S.Pd.I" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Alamat Email (Untuk Login)</label>
                <input type="email" name="email" placeholder="guru@email.com" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Password Login</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Nomor WhatsApp / HP</label>
                <input type="text" name="phone" placeholder="08..." class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modalTambahGuru').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-xl text-xs font-semibold hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl text-xs font-bold hover:bg-green-700 transition">
                    Simpan Akun Guru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
