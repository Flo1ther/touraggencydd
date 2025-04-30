@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Список турів</h1>
        <a href="{{ route('tours.create') }}" class="btn btn-primary mb-4">Створити новий тур</a>

        <table class="table-auto w-full">
            <thead>
            <tr>
                <th class="px-4 py-2">Назва</th>
                <th class="px-4 py-2">Опис</th>
                <th class="px-4 py-2">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tours as $tour)
                <tr>
                    <td class="border px-4 py-2">{{ $tour->name }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($tour->description, 50) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('tours.edit', $tour->id) }}" class="btn btn-sm btn-warning">Редагувати</a>
                        <form action="{{ route('tours.destroy', $tour->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
