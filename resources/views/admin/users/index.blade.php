@extends('admin.layouts.app')

@section('title', 'Daftar User')

@section('content')
<div x-data="{ search: '' }" class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
        <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-2">
            <span class="iconify text-green-600" data-icon="mdi:account-multiple-outline"></span>
            Daftar User
        </h2>

        {{-- Input Pencarian --}}
        <div class="relative w-full md:w-1/3">
            <input type="text" x-model="search" placeholder="Cari nama atau email..."
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 pl-10 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="absolute left-3 top-2.5 text-gray-400 w-5 h-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    @if($users->isEmpty())
        <div class="text-center py-10 text-gray-500">
            <p class="text-lg">Tidak ada data user yang ditemukan.</p>
        </div>
    @else
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full bg-white text-gray-700">
                <thead class="bg-green-100 text-green-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama</th>
                        <th class="px-4 py-3 text-left font-semibold">No. HP</th>
                        <th class="px-4 py-3 text-left font-semibold">Email</th>
                        <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())"
                            class="border-t hover:bg-gray-50 transition-all duration-200">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->phone ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3 flex justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg shadow-sm transition transform hover:-translate-y-0.5">
                                   Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg shadow-sm transition transform hover:-translate-y-0.5">
                                        Hapus
                                    </button>
                                </form>
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
