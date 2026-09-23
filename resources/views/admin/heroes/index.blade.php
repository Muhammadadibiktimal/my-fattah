@extends('admin.layouts.app')

@section('title', 'Hero Section')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-extrabold text-gray-900">Hero Section</h1>
    <a href="{{ route('admin.heroes.create') }}"
       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white font-semibold px-5 py-2 rounded-lg shadow transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Hero
    </a>
</div>

{{-- Flash message --}}
@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto bg-white shadow-lg rounded-lg">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-6 py-3 text-gray-700 font-semibold uppercase tracking-wider">Judul</th>
                <th class="px-6 py-3 text-gray-700 font-semibold uppercase tracking-wider">Subjudul</th>
                <th class="px-6 py-3 text-gray-700 font-semibold uppercase tracking-wider">Gambar</th>
                <th class="px-6 py-3 text-gray-700 font-semibold uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($heroes as $hero)
            <tr class="border-b border-gray-200 hover:bg-blue-50 transition-colors duration-200 cursor-pointer">
                <td class="px-6 py-4 text-gray-800 font-medium">{{ $hero->title }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $hero->subtitle }}</td>
                <td class="px-6 py-4">
                    <img src="{{ asset('storage/'.$hero->image) }}" alt="{{ $hero->title }}" class="h-20 w-auto rounded-lg shadow-md object-cover">
                </td>
                <td class="px-6 py-4 flex space-x-4">
                    <a href="{{ route('admin.heroes.edit', $hero) }}"
                       class="flex items-center text-blue-600 hover:text-blue-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                        </svg>
                        Edit
                    </a>

                    <form action="{{ route('admin.heroes.destroy', $hero) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus hero ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="flex items-center text-red-600 hover:text-red-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">
                    Belum ada data hero.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
