@extends('admin.layouts.app')

@section('title', 'Arsip Pendaftar')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            📦 Arsip Pendaftar
        </h2>

        {{-- Form Pencarian --}}
        <form action="{{ route('admin.pendaftar.arsip') }}" method="GET" class="flex items-center gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau NIK..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-60"
            >
            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition"
            >
                🔍 Cari
            </button>
        </form>
    </div>

    {{-- Tabel Data --}}
    @if($pendaftar->count() > 0)
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">Nama</th>
                        <th class="py-3 px-4 text-left font-semibold">NIK</th>
                        <th class="py-3 px-4 text-left font-semibold">Status</th>
                        <th class="py-3 px-4 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pendaftar as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $item->nama_lengkap }}</td>
                            <td class="py-3 px-4">{{ $item->nik }}</td>
                            <td class="py-3 px-4">
                                @if($item->status == 'Terverifikasi')
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span> Terverifikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-1"></span> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.pendaftar.show', $item->id) }}"
                                   class="text-blue-600 hover:text-blue-800 font-medium text-sm transition">
                                   Lihat Detail
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tombol Backup --}}
        <div class="mt-6 flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.pendaftar.export') }}"
               id="backupBtn"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow-md transition flex items-center gap-2">
               💾 Backup ke Excel
            </a>
<a href="{{ route('admin.pendaftar.exportPdf') }}"
   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
   📄 Backup PDF
</a>

            <p id="backupMsg" class="hidden text-gray-600 text-sm italic">⏳ Membuat file backup, harap tunggu...</p>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $pendaftar->appends(['search' => request('search')])->links() }}
        </div>
    @else
        <p class="text-gray-600 mt-4">Tidak ada pendaftar ditemukan.</p>
    @endif
</div>

{{-- Alpine.js untuk efek loading --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

{{-- Script kecil untuk efek loading tombol backup --}}
<script>
document.getElementById('backupBtn').addEventListener('click', function() {
    const msg = document.getElementById('backupMsg');
    msg.classList.remove('hidden');
    setTimeout(() => msg.classList.add('hidden'), 5000);
});
</script>
@endsection
