@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Video Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.videos.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-2">Judul Video</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border rounded-lg p-3 focus:ring focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-2">Link YouTube</label>
            <input type="url" name="link" value="{{ old('link') }}"
                   placeholder="https://www.youtube.com/watch?v=xxxxxxx"
                   class="w-full border rounded-lg p-3 focus:ring focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block font-semibold mb-2">Deskripsi (opsional)</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded-lg p-3 focus:ring focus:ring-yellow-400">{{ old('description') }}</textarea>
        </div>

        <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-3 rounded-lg shadow">
            Simpan
        </button>
    </form>
</div>
@endsection
