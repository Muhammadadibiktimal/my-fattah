@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Video</h1>
    <a href="{{ route('admin.videos.create') }}" class="bg-blue-500 text-blue px-4 py-2 rounded">Tambah Video</a>

    <table class="w-full mt-6 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">Judul</th>
                <th class="p-3 border">Link</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
                <tr>
                    <td class="p-3 border">{{ $video->title }}</td>
                    <td class="p-3 border">{{ $video->link }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('admin.videos.edit', $video) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $videos->links() }}
</div>
@endsection
