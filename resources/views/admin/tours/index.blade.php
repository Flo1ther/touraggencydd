@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-gray-600 hover:text-blue-600 transition flex items-center">
                    ← Назад
                </a>
                <h1 class="text-3xl font-bold text-blue-700">Список турів</h1>
            </div>
            <a href="{{ route('tours.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Новий тур
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm table-auto">
                <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Назва</th>
                    <th class="px-4 py-3">Локація</th>
                    <th class="px-4 py-3">Ціна</th>
                    <th class="px-4 py-3">Дії</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tours as $tour)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 font-medium">{{ $tour->title }}</td>
                        <td class="px-4 py-2">{{ $tour->location }}</td>
                        <td class="px-4 py-2">{{ number_format($tour->price, 2) }} грн</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('tours.edit', $tour) }}"
                               class="text-indigo-600 hover:underline mr-3">Редагувати</a>
                            <form action="{{ route('tours.destroy', $tour) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Ви впевнені, що хочете видалити цей тур?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Турів поки немає.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
