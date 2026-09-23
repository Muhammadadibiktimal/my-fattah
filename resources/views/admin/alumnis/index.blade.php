@extends('admin.layouts.app')


@section('title', 'Data Alumni')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Daftar Alumni</h2>
            <a href="{{ route('admin.alumnis.create') }}"
               class="px-4 py-2 bg-blue-600 text-gray-200 rounded-lg hover:bg-blue-700 transition">
                + Tambah Alumni
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Foto</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Angkatan</th>
                        <th class="px-4 py-2 border">Pekerjaan</th>
                        <th class="px-4 py-2 border">Kesan & Pesan</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alumnis as $alumni)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">
                                @if($alumni->photo)
                                    <img src="{{ asset('storage/' . $alumni->photo) }}"
                                         alt="{{ $alumni->name }}"
                                         class="h-16 w-16 object-cover rounded-full">
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border font-semibold">{{ $alumni->name }}</td>
                            <td class="px-4 py-2 border">{{ $alumni->angkatan ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $alumni->pekerjaan ?? '-' }}</td>
                            <td class="px-4 py-2 border max-w-xs truncate">{{ $alumni->kesan_pesan }}</td>
                            <td class="px-4 py-2 border text-center space-x-2">
                                <a href="{{ route('admin.alumnis.edit', $alumni->id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('admin.alumnis.destroy', $alumni->id) }}"
                                      method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus alumni ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Belum ada data alumni.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $alumnis->links() }} {{-- pagination --}}
        </div>
    </div>
@endsection
