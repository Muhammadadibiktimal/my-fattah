{{-- resources/views/admin/posts/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Berita</h1>
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">+ Tambah Berita</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Gambar</th>
                    <th class="p-3 border">Judul</th>
                    <th class="p-3 border">Tanggal</th>
                    <th class="p-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $index => $post)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">{{ $posts->firstItem() + $index }}</td>
                        <td class="p-3 border">
                            @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" class="w-20 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="p-3 border">{{ $post->title }}</td>
                        <td class="p-3 border">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="p-3 border text-center space-x-2">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-lg">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">Belum ada berita</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
