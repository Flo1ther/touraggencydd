@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-700">Пости блогу</h1>
            <a href="{{ route('admin.posts.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">+ Новий пост</a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Заголовок</th>
                    <th class="px-4 py-2">Автор</th>
                    <th class="px-4 py-2">Опубліковано</th>
                    <th class="px-4 py-2">Дії</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->author->name ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $post->created_at->format('d.m.Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-500 hover:underline">Редагувати</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-block mb-4 text-blue-600 hover:underline">
            &larr; Назад
        </a>

    </div>
@endsection
