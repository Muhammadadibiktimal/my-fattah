@extends('admin.layouts.app')

@section('title', 'Kelola Pengguna Sistem')

@section('content')
<div x-data="{ search: '' }" class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <span class="iconify text-green-600" data-icon="mdi:account-group"></span>
                Kelola Pengguna Sistem
            </h2>
            <p class="text-xs text-gray-500 mt-1">Daftar semua akun terdaftar (Admin, Yayasan, Kepala Sekolah, Guru, dan Santri).</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            {{-- Tombol Tambah Pengguna --}}
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold text-xs rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                <span class="iconify text-base" data-icon="mdi:account-plus"></span>
                <span>Tambah Pengguna Baru</span>
            </a>

            {{-- Input Pencarian --}}
            <div class="relative w-full sm:w-64">
                <input type="text" x-model="search" placeholder="Cari nama, email, role..."
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 pl-10 focus:outline-none focus:ring-2 focus:ring-green-400 text-xs transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-3 top-2.5 text-gray-400 w-5 h-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Filter Berdasarkan Role --}}
    <div class="flex flex-wrap items-center gap-2 mb-5 pb-4 border-b border-gray-100 text-xs">
        <span class="font-bold text-gray-500 mr-1">Filter Role:</span>
        <a href="{{ route('admin.users.index') }}"
           class="px-3 py-1.5 rounded-lg font-semibold transition {{ empty($roleFilter) ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Semua ({{ \App\Models\User::count() }})
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
           class="px-3 py-1.5 rounded-lg font-semibold transition {{ $roleFilter == 'admin' ? 'bg-green-700 text-white' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
            Admin
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'yayasan']) }}"
           class="px-3 py-1.5 rounded-lg font-semibold transition {{ $roleFilter == 'yayasan' ? 'bg-amber-700 text-white' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
            Yayasan
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'kepsek']) }}"
           class="px-3 py-1.5 rounded-lg font-semibold transition {{ $roleFilter == 'kepsek' ? 'bg-blue-700 text-white' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}">
            Kepala Sekolah
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'guru']) }}"
           class="px-3 py-1.5 rounded-lg font-semibold transition {{ $roleFilter == 'guru' ? 'bg-purple-700 text-white' : 'bg-purple-50 text-purple-700 hover:bg-purple-100' }}">
            Guru
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'user']) }}"
           class="px-3 py-1.5 rounded-lg font-semibold transition {{ $roleFilter == 'user' ? 'bg-emerald-700 text-white' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
            Santri / Siswa
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3.5 bg-green-50 border border-green-200 text-green-800 rounded-xl text-xs flex items-center gap-2">
            <span class="iconify text-base text-green-600" data-icon="mdi:check-circle"></span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs flex items-center gap-2">
            <span class="iconify text-base text-red-600" data-icon="mdi:alert-circle"></span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($users->isEmpty())
        <div class="text-center py-12 text-gray-500">
            <span class="iconify text-5xl mx-auto mb-2 text-gray-300" data-icon="mdi:account-off"></span>
            <p class="text-base font-semibold">Tidak ada pengguna pada kategori ini.</p>
        </div>
    @else
        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
            <table class="min-w-full bg-white text-gray-700 text-xs">
                <thead class="bg-gray-50 text-gray-600 font-bold uppercase tracking-wider border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Nama Pengguna</th>
                        <th class="px-4 py-3 text-left">Role / Akses</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">No. HP</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $index => $u)
                        @php
                            $roleBadges = [
                                'admin' => ['label' => 'Admin', 'class' => 'bg-green-100 text-green-800 border-green-200'],
                                'yayasan' => ['label' => 'Yayasan', 'class' => 'bg-amber-100 text-amber-800 border-amber-200'],
                                'kepsek' => ['label' => 'Kepala Sekolah', 'class' => 'bg-blue-100 text-blue-800 border-blue-200'],
                                'guru' => ['label' => 'Guru', 'class' => 'bg-purple-100 text-purple-800 border-purple-200'],
                                'user' => ['label' => 'Santri / Siswa', 'class' => 'bg-emerald-100 text-emerald-800 border-emerald-200'],
                            ];
                            $badge = $roleBadges[$u->role] ?? ['label' => $u->role, 'class' => 'bg-gray-100 text-gray-800 border-gray-200'];
                        @endphp
                        <tr x-show="search === '' || '{{ strtolower($u->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($u->email) }}'.includes(search.toLowerCase()) || '{{ strtolower($u->role) }}'.includes(search.toLowerCase())"
                            class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-gray-400 font-mono">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-bold text-gray-900">
                                {{ $u->name }}
                                @if(auth()->id() == $u->id)
                                    <span class="ml-1 text-[10px] text-emerald-600 font-semibold">(Anda)</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-bold border {{ $badge['class'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-mono text-gray-600">{{ $u->email }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $u->phone ?? '-' }}</td>
                            <td class="px-4 py-3 flex justify-center items-center gap-2">
                                <a href="{{ route('admin.users.edit', $u->id) }}"
                                   class="px-2.5 py-1 bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 font-semibold rounded-lg transition text-xs">
                                   Edit
                                </a>

                                @if(auth()->id() != $u->id)
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus akun pengguna {{ $u->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-2.5 py-1 bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 font-semibold rounded-lg transition text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- Import Alpine.js untuk live search --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
