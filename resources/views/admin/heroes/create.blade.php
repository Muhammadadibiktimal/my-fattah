@extends('admin.layouts.app')

@section('title', 'Tambah Hero')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Hero</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.heroes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border rounded px-3 py-2" >
        </div>

        <div>
            <label class="block font-medium">Subjudul</label>
            <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Gambar</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2" >
        </div>

        <div>
            <label class="block font-medium">Teks Tombol</label>
            <input type="text" name="button_text" value="{{ old('button_text') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium">Link Tombol</label>
            <input type="text" name="button_link" value="{{ old('button_link') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.heroes.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-blue rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
