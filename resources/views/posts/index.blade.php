@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold text-yellow-600 mb-8">Berita Terbaru</h2>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-yellow-600 dark:text-yellow-400 font-semibold hover:underline">Baca Selengkapnya →</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</section>
@endsection
