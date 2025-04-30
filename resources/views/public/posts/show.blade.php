@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10 px-6 text-gray-100">
        <a href="{{ route('public.posts.index') }}" class="text-blue-400 hover:underline mb-4 inline-block">← Назад до блогу</a>
        <h1 class="text-4xl font-bold text-white mb-4">{{ $post->title }}</h1>
        <p class="text-gray-400 text-sm mb-6">{{ $post->created_at->format('d.m.Y') }}</p>

        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mb-6 rounded shadow">
        @endif

        <div class="prose prose-invert max-w-none">
            {!! $post->content !!}
        </div>
    </div>
@endsection
