{{-- resources/views/admin/posts/create.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Tambah Berita</h1>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Judul --}}
        <div>
            <label class="block font-medium mb-2">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konten --}}
        <div>
            <label class="block font-medium mb-2">Konten</label>
            <textarea name="content" rows="6"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div>
            <label class="block font-medium mb-2">Gambar</label>
            <input type="file" name="image" accept="image/*"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection
