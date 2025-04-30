@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:text-blue-600">← Назад до списку</a>
            <h1 class="text-2xl font-bold text-blue-700">Редагувати пост</h1>
        </div>

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data"
              class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium">Заголовок</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Текст</label>
                <textarea name="content" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Поточне зображення</label>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Поточне зображення" class="h-40 mb-2 rounded">
                @else
                    <p class="text-gray-500 text-sm">Зображення не завантажено</p>
                @endif
                <input type="file" name="image" class="w-full border rounded px-3 py-2 mt-2">
                <p class="text-xs text-gray-500 mt-1">Опційно. Заміна зображення.</p>
            </div>

            <div class="text-right pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Оновити
                </button>
            </div>
        </form>
    </div>
@endsection
