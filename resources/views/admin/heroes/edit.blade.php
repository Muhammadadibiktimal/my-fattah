@extends('admin.layouts.app')

@section('title', 'Edit Hero')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Hero</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.heroes.update', $hero) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title', $hero->title) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">Subjudul</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $hero->subtitle) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Gambar</label>
            @if($hero->image)
                <img src="{{ asset('storage/'.$hero->image) }}" class="h-24 mb-2 rounded">
            @endif
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
            <p class="text-sm text-gray-500">Kosongkan jika tidak ingin mengganti gambar</p>
        </div>

        <div>
            <label class="block font-medium">Teks Tombol</label>
            <input type="text" name="button_text" value="{{ old('button_text', $hero->button_text) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Link Tombol</label>
            <input type="text" name="button_link" value="{{ old('button_link', $hero->button_link) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.heroes.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
        </div>
    </form>
</div>
@endsection
