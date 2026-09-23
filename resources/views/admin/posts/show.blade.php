@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-6">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}" class="w-full h-96 object-cover rounded-lg mb-6">
    @endif
    <div class="text-gray-700 leading-relaxed">
        {!! nl2br(e($post->content)) !!}
    </div>
    <a href="{{ route('home') }}" class="inline-block mt-6 text-yellow-600 hover:underline">← Kembali</a>
</div>
@endsection
