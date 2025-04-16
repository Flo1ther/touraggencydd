@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Пости</h1>

        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Створити новий пост</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Назва</th>
                <th>Slug</th>
                <th>Дата створення</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Редагувати</a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Ви впевнені?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
